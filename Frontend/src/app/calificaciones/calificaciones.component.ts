import { Component, inject } from '@angular/core';
import { ApiService } from '../services/api.service';
import { RouterModule, Router,ActivatedRoute,Params } from '@angular/router';
import { UserService } from '../services/user.service';
import { DomSanitizer, SafeHtml } from '@angular/platform-browser';
import { CommonModule, DatePipe } from '@angular/common';


@Component({
  selector: 'app-calificaciones',
  standalone: true,
  imports: [RouterModule, DatePipe, CommonModule],
  templateUrl: './calificaciones.component.html',
  styleUrl: './calificaciones.component.css'
})
export class CalificacionesComponent {
  private api=inject(ApiService)
  private userService=inject(UserService)
  public token:any;
  public identity:any;
  public notas:any;

  constructor(private router: Router, private route: ActivatedRoute, private sanitizer: DomSanitizer) {
    this.loadUser();
    if(this.identity.rol=='alumno'){
      this.getNotas();
    }else{
      this.router.navigate(['/inicio']);
    }
  }

  loadUser(){
    this.token=this.userService.getToken();
    this.identity=this.userService.getIdentity();
  }

  getNotas(){
    return this.api.getMisNotas(this.token).subscribe(
      (response:any)=>{
        let notas = response.data;
        this.notas = JSON.parse(notas);
      },
      error =>{
        console.log(error);
      }
    );
  }
}

