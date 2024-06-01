import { Component, inject } from '@angular/core';
import { ApiService } from '../services/api.service';
import { RouterModule, Router,ActivatedRoute,Params } from '@angular/router';
import { UserService } from '../services/user.service';
import { DomSanitizer, SafeHtml } from '@angular/platform-browser';
import { CommonModule, DatePipe } from '@angular/common';


@Component({
  selector: 'app-asistencia',
  standalone: true,
  imports: [RouterModule, DatePipe, CommonModule],
  templateUrl: './asistencia.component.html',
  styleUrl: './asistencia.component.css'
})
export class AsistenciaComponent {
  private api=inject(ApiService)
  private userService=inject(UserService)
  public token:any;
  public identity:any;
  public faltas:any;
  public faltasAgrupadas:any;
  public clases:any;

  constructor(private router: Router, private route: ActivatedRoute, private sanitizer: DomSanitizer) {
    this.loadUser();
    if(this.identity.rol=='alumno'){
      this.getFaltas();
      this.getClases();
      this.contarFaltas();
    }else{
      this.router.navigate(['/inicio']);
    }
  }
  subirFalta(nombreAsignatura: string) {
    if (this.faltasPorAsignatura[nombreAsignatura] === 0) {
      this.faltasPorAsignatura[nombreAsignatura] = 1;
    }else{
    this.faltasPorAsignatura[nombreAsignatura]++;
    }
  }

  faltasPorAsignatura: { [key: string]: number } = {};

  loadUser(){
    this.token=this.userService.getToken();
    this.identity=this.userService.getIdentity();
  }

  contarFaltas() {
    if (this.faltas && this.faltas.length > 0) {
      this.faltas.forEach((falta:any) => {
        let nombreAsignatura = falta.clase.asignatura.nombre;
        if (this.faltasPorAsignatura[nombreAsignatura] !== undefined) {
          this.subirFalta(nombreAsignatura);
        }
      });
    }
  } 

  getClases(){
    return this.api.getMisClases(this.token).subscribe(
      (response:any)=>{
        let clases = response.data;
        this.clases = JSON.parse(clases);
        for (let i = 0; i < this.clases.length; i++) {
          this.faltasPorAsignatura[this.clases[i].asignatura.nombre] = 0;
        }
        if (this.faltas) {
          this.contarFaltas();
        }
      },
      error =>{
        console.log(error);
      }
    );
  }

  getFaltas(){
    return this.api.getMisFaltas(this.token).subscribe(
      (response:any)=>{
        let faltas = response.data;
        this.faltas = JSON.parse(faltas);
        this.faltasAgrupadas = this.agruparPorDia(this.faltas);

        if (this.clases) {
          this.contarFaltas();
        }
      },
      error =>{
        console.log(error);
      }
    );
  }
  agruparPorDia(faltas: any[]): any[] {
    const grupos: any[] = [];
    faltas.forEach(falta => {
      const fecha = new Date(falta.fecha).toLocaleDateString('es-ES', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
      const grupoExistente = grupos.find(grupo => grupo.fecha === fecha);
      
      // Si el grupo ya existe, agrega la falta a ese grupo
      if (grupoExistente) {
        grupoExistente.faltas.push(falta);
      } else {
        // Si el grupo no existe, crea uno nuevo
        grupos.push({ fecha: fecha, faltas: [falta] });
      }
    });

    return grupos;
  }
}

