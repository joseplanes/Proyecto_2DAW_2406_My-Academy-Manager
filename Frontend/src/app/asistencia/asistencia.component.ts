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

  constructor(private router: Router, private route: ActivatedRoute, private sanitizer: DomSanitizer) {
    this.loadUser();
    if(this.identity.rol=='alumno'){
      this.getFaltas();
    }else{
      this.router.navigate(['/inicio']);
    }
  }

  loadUser(){
    this.token=this.userService.getToken();
    this.identity=this.userService.getIdentity();
  }

  getFaltas(){
    return this.api.getMisFaltas(this.token).subscribe(
      (response:any)=>{
        let faltas = response.data;
        this.faltas = JSON.parse(faltas);
        this.faltasAgrupadas = this.agruparPorDia(this.faltas);
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

