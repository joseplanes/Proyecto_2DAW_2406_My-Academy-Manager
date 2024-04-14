import { Component, inject } from '@angular/core';
import { ApiService } from '../../services/api.service';
import { FormsModule } from '@angular/forms';
import { UserService } from '../../services/user.service';
import { RouterModule, Router,ActivatedRoute,Params } from '@angular/router';
import { DiasPipe } from '../../pipes/dias.pipe';

@Component({
  selector: 'app-registroclase',
  standalone: true,
  imports: [FormsModule, DiasPipe, RouterModule],
  templateUrl: './registro-clase.component.html',
  styleUrl: './registro-clase.component.css'
})
export class RegistroclaseComponent {
  private api=inject(ApiService)
  private userService=inject(UserService)
  public token:any;
  public identity:any;
  formData:any={};
  public status:string='';
  public message:string='';
  
  asignaturas=<any>[];
  profesores=<any>[];
  aulas=<any>[];
  dias=<any>[];

  constructor(private router: Router, private route: ActivatedRoute) {
    this.loadUser();
    if(this.identity.rol=='admin'){
      this.formData={
        dias: []
      }
      this.getAsignaturas();
      this.getProfesores();
      this.getAulas();
      this.getDias();

    }else{
      this.router.navigate(['/asistencia']);
    }
  }
  loadUser(){
    this.token=this.userService.getToken();
    this.identity=this.userService.getIdentity();
  }
  getProfesores(){
    return this.api.getProfesores(this.token).subscribe(
      (response:any)=>{
        let profesores=response.data;
        this.profesores=JSON.parse(profesores);
      },
      error =>{
        console.log(error);
      }
    );
  }
  getAulas(){
    return this.api.getAulas(this.token).subscribe(
      (response:any)=>{
        let aulas=response.data;
        this.aulas=JSON.parse(aulas);
      },
      error =>{
        console.log(error);
      }
    );
  }
  

  getDias(){
    return this.api.getDias(this.token).subscribe(
      (response:any)=>{
        let dias=response.data;
        this.dias=JSON.parse(dias);
      },
      error =>{
        console.log(error);
      }
    );
  }
  getAsignaturas(){
    return this.api.getAsignaturas(this.token).subscribe(
      (response:any)=>{
        let asignaturas=response.data;
        this.asignaturas=JSON.parse(asignaturas);
      },
      error =>{
        console.log(error);
      }
    );
  }
  
  onSubmit(createasignatura: any) {
    const selectedDias = Object.keys(this.formData.dias)
    .filter(key => this.formData.dias[key])
    .map(Number);
    const formDataToSend = {
      ...this.formData,
      dias: selectedDias
  };

    this.api.createClase(this.token, formDataToSend).subscribe(
      (response:any ) => {
        if(response && response.status == 'success'){
          this.status = 'success';
          this.message = response.message;
          
        }else{
          this.status = 'error';
          this.message = response.message;
        }
      },
      error => {
        this.status = 'error';
        console.log(error);
      }
    );
  }

}
