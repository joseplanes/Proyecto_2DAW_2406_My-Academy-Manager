import { Component, inject } from '@angular/core';
import { ApiService } from '../services/api.service';
import { FormsModule } from '@angular/forms';
import { UserService } from '../services/user.service';
import { RouterModule, Router,ActivatedRoute,Params } from '@angular/router';
import { CommonModule } from '@angular/common';
import { HoraPipe } from '../pipes/hora.pipe';

@Component({
  selector: 'app-registro-asistencia',
  standalone: true,
  imports: [FormsModule, RouterModule,HoraPipe],
  templateUrl: './registro-asistencia.component.html',
  styleUrl: './registro-asistencia.component.css'
})
export class RegistroAsistenciaComponent {
  private api=inject(ApiService)
  private userService=inject(UserService)
  public token:any;
  public identity:any;
  formData:any={};
  public status:string='';
  public message:string='';
  submitting: boolean = false;
  hoy: string = new Date().toISOString().split('T')[0];

  clases=<any>[];
  
  
  constructor(private router: Router, private route: ActivatedRoute) {
    this.loadUser();
    if(this.identity.rol=='profesor'){
      this.formData={
        fecha: this.hoy,
        alumnos: []
      }
      this.getClases();
    }else{
      this.router.navigate(['/inicio']);
    }
  }
  loadUser(){
    this.token=this.userService.getToken();
    this.identity=this.userService.getIdentity();
  }

  getClases(){
    return this.api.getMisClases(this.token).subscribe(
      (response:any)=>{
        let clases = response.data;
        this.clases = JSON.parse(clases);
      },
      error =>{
        console.log(error);
      }
    );
  }

  obtenerAlumnosDeClase(claseId: number) {
    let alumnos;
    for (let i = 0; i < this.clases.length; i++) {
      if (this.clases[i].id == claseId) {
        alumnos = this.clases[i].alumnos;
      }
    }
    return alumnos;
  }
  
  onSubmit(createaula: any) {
    if (this.submitting) {
      return;
    }
    this.submitting = true;
    const selectedAlumnos = Object.keys(this.formData.alumnos)
    .filter(key => this.formData.alumnos[key])
    .map(Number);
    const formDataToSend = {
      ...this.formData,
      alumnos: selectedAlumnos
  };
    this.api.createAsistencia(this.token, formDataToSend).subscribe(
      (response:any ) => {
        if(response && response.status == 'success'){
          this.status = 'success';
          this.message = response.message;
          
        }else{
          this.status = 'error';
          this.message = response.message;
        }
        this.submitting = false;
      },
      error => {
        this.status = 'error';
        console.log(error);
        this.submitting = false;
      }
    );
    
  }
  maxDate(): string {
  
    const today = new Date();
    const dd = String(today.getDate()).padStart(2, '0');
    const mm = String(today.getMonth() + 1).padStart(2, '0'); // Enero es 0
    const yyyy = today.getFullYear();
  
    return `${yyyy}-${mm}-${dd}`;
  }
}
