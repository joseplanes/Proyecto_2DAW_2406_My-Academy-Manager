import { Component, inject, OnInit } from '@angular/core';
import { ActivatedRoute} from '@angular/router';
import { ApiService } from '../services/api.service';
import { AlumnoCardComponent } from '../alumno-card/alumno-card.component';
import { DiasPipe } from '../pipes/dias.pipe';
import { HoraPipe } from '../pipes/hora.pipe';
import { PatronAlumnoPipe } from '../pipes/patron-alumno.pipe';



@Component({
  selector: 'app-clase-detalle',
  standalone: true,
  imports: [AlumnoCardComponent, DiasPipe, HoraPipe, PatronAlumnoPipe],
  templateUrl: './clase-detalle.component.html',
  styleUrl: './clase-detalle.component.css'
})
export class ClaseDetalleComponent  implements OnInit{
 
  
  claseinfo=<any>[];
  claseId: number = 0;
  patron:string='';
  
  constructor(private route: ActivatedRoute, private api: ApiService) {}
  ngOnInit(): void {
    this.claseinfo=[];
    const id = this.route.snapshot.params["id"];
    const claseId = id ? +id : 0;
    console.log(claseId);
    this.claseId=claseId;
    this.getClassInfo(claseId);
  }
  

  getClassInfo(claseId:number){
    this.api.getClase(claseId).subscribe((JSON:any)=>{
      this.claseinfo=JSON;
    });
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
