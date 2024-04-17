import { Component, inject } from '@angular/core';
import { ApiService } from '../services/api.service';
import { FormsModule } from '@angular/forms';
import { UserService } from '../services/user.service';
import { RouterModule, Router,ActivatedRoute,Params } from '@angular/router';

@Component({
  selector: 'app-registro-asistencia',
  standalone: true,
  imports: [FormsModule, RouterModule],
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

  asignaturas=<any>[];
  profesores=<any>[];
  aulas=<any>[];
  dias=<any>[];
  
  constructor(private router: Router, private route: ActivatedRoute) {
    this.loadUser();
    if(this.identity.rol=='profesor'){
      this.formData={
        alumnos: []
      }
    }else{
      this.router.navigate(['/asistencia']);
    }
  }
  loadUser(){
    this.token=this.userService.getToken();
    this.identity=this.userService.getIdentity();
  }
  
  onSubmit(createaula: any) {
    this.api.createAsistencia(this.token, this.formData).subscribe(
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
