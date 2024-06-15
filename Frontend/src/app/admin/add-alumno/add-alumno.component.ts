import { Component, inject } from '@angular/core';
import { ApiService } from '../../services/api.service';
import { FormsModule } from '@angular/forms';
import { UserService } from '../../services/user.service';
import { RouterModule, Router,ActivatedRoute,Params } from '@angular/router';
import { DiasPipe } from '../../pipes/dias.pipe';

@Component({
  selector: 'app-add-alumno',
  standalone: true,
  imports: [FormsModule, DiasPipe, RouterModule],
  templateUrl: './add-alumno.component.html',
  styleUrl: './add-alumno.component.css'
})
export class AddAlumnoComponent {
  private api=inject(ApiService)
  private userService=inject(UserService)
  public token:any;
  public identity:any;
  formData:any={};
  public status:string='';
  public message:string='';
  public claseId:number=0;
  public alumnos:any=[];
  public infoclase:any=null;


  constructor(private router: Router, private route: ActivatedRoute) {
    this.loadUser();
    if(this.identity.rol=='admin'){
      this.formData={
        alumnos: []
      }
      const id = this.route.snapshot.params["id"];
      const claseId = id ? +id : 0;
      this.claseId=claseId;
      this.getClase();
      this.getNoAlumnos();

    }else{
      this.router.navigate(['/inicio']);
    }
  }
  loadUser(){
    this.token=this.userService.getToken();
    this.identity=this.userService.getIdentity();
  }

  getNoAlumnos(){
    this.api.getNoAlumnos(this.token,this.claseId).subscribe(
      (response:any ) => {
          let alumnos = response.data;
          this.alumnos=JSON.parse(alumnos);
      },
      error => {
        this.status = 'error';
        this.message = error.message;
      }
    );
  }

  getClase(){
    this.api.getClase(this.claseId,this.token).subscribe(
      (response:any ) => {
        let info=response.data;
         let infoclase = JSON.parse(info);
          this.infoclase=infoclase[0].asignatura.nombre;
      },
      error => {
        this.status = 'error';
        console.log(error);
      }
    );
  
  }

  goBack(){
    this.router.navigate(['/clase',this.claseId]);
  }
  
  onSubmit(createasignatura: any) {
    const selectedDias = Object.keys(this.formData.alumnos)
    .filter(key => this.formData.alumnos[key])
    .map(Number);
    const formDataToSend = {
      ...this.formData,
      alumnos: selectedDias
  };
    this.api.addAlumno(this.token, this.claseId ,formDataToSend).subscribe(
      (response:any ) => {
        if(response && response.status == 'success'){
          this.status = 'success';
          this.message = response.message;
          this.router.navigate(['/clase',this.claseId]);
          
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
