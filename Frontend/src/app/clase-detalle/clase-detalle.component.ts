import { Component, inject,  } from '@angular/core';
import { RouterModule, Router,ActivatedRoute,Params} from '@angular/router';
import { ApiService } from '../services/api.service';
import { AlumnoCardComponent } from '../alumno-card/alumno-card.component';
import { DiasPipe } from '../pipes/dias.pipe';
import { HoraPipe } from '../pipes/hora.pipe';
import { PatronAlumnoPipe } from '../pipes/patron-alumno.pipe';
import { UserService } from '../services/user.service';
import { CommonModule } from '@angular/common';
import { DomSanitizer, SafeHtml } from '@angular/platform-browser';
import { PatronClasePipe } from '../pipes/patron-clase.pipe';


@Component({
  selector: 'app-clase-detalle',
  standalone: true,
  imports: [AlumnoCardComponent, DiasPipe, HoraPipe, PatronAlumnoPipe,RouterModule],
  templateUrl: './clase-detalle.component.html',
  styleUrl: './clase-detalle.component.css'
})
export class ClaseDetalleComponent {
 
  private api=inject(ApiService)
  private userService=inject(UserService)
  public token:any;
  public identity:any;
  public claseinfo:any;
  claseId: number = 0;
  patron:string='';
  
  constructor(private router: Router, private route: ActivatedRoute, private sanitizer: DomSanitizer) {
    this.loadUser();
    if(this.identity.rol=='admin'||this.identity.rol=='profesor'||this.identity.rol=='alumno'){
      const id = this.route.snapshot.params["id"];
      const claseId = id ? +id : 0;
      this.claseId=claseId;
      
      this.getClase();
    }else{
      this.router.navigate(['/']);
    }
  }

  eliminarAlumno(id:any){
    this.api.deleteAlumno(this.token,this.claseId,id).subscribe(
      (response:any)=>{
        this.getClase();
      },
      error =>{
        console.log(error);
      }
    );
  }

  getClase(){
    return this.api.getClase(this.claseId,this.token).subscribe(
      (response:any)=>{
        let clases = response.data;
        this.claseinfo = JSON.parse(clases);
      },
      error =>{
        console.log(error);
      }
    );
  }

  loadUser(){
    this.token=this.userService.getToken();
    this.identity=this.userService.getIdentity();
  }
    
  infoclick: boolean = true;
  alumnosclick: boolean = false;
  profclick: boolean = false;

  calumno(){
    this.infoclick=false;
    this.alumnosclick=true;
    this.profclick=false;

    let x = document.getElementById("alum");
    x?.classList.add("bg-custom-green");
    let y = document.getElementById("prof");
    y?.classList.remove("bg-custom-green");
    let z = document.getElementById("inf");
    z?.classList.remove("bg-custom-green");
  
  }
  cprof(){
    this.infoclick=false;
    this.alumnosclick=false;
    this.profclick=true;

    let x = document.getElementById("prof");
    x?.classList.add("bg-custom-green");
    let y = document.getElementById("alum");
    y?.classList.remove("bg-custom-green");
    let z = document.getElementById("inf");
    z?.classList.remove("bg-custom-green");
  }
  cinfo(){
    this.infoclick=true;
    this.alumnosclick=false;
    this.profclick=false;
    let x = document.getElementById("inf");
    x?.classList.add("bg-custom-green");
    let y = document.getElementById("alum");
    y?.classList.remove("bg-custom-green");
    let z = document.getElementById("prof");
    z?.classList.remove("bg-custom-green");

  }
  cambiarestado(campo:boolean){
    if(campo==true){
      campo=false;
    }else{
      campo=true;
    }
  }
}
