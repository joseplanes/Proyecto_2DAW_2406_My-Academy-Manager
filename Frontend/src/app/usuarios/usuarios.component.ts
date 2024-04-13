import { Component, inject } from '@angular/core';
import { ApiService } from '../services/api.service';
import { UsuarioCardComponent } from '../usuario-card/usuario-card.component';
import { PatronPipe } from '../pipes/patron.pipe';
import { FormsModule } from '@angular/forms';
import { RouterModule, Router,ActivatedRoute,Params } from '@angular/router';
import { UserService } from '../services/user.service';
import { CommonModule } from '@angular/common';


@Component({
  selector: 'app-usuarios',
  standalone: true,
  imports: [UsuarioCardComponent, PatronPipe, FormsModule, RouterModule, CommonModule],
  templateUrl: './usuarios.component.html',
  styleUrl: './usuarios.component.css'
})
export class UsuariosComponent {
  private api=inject(ApiService)
  private userService=inject(UserService)
  public token:any;
  public identity:any;
  public usuarios:any;

  patron: string = '';
  roles:string='';

  constructor(private router: Router, private route: ActivatedRoute) {
    this.loadUser();
    if(this.identity.rol=='admin'){
      this.getUsuarios();
    }else{
      this.router.navigate(['/asistencia']);
    }
  }
  loadUser(){
    this.token=this.userService.getToken();
    this.identity=this.userService.getIdentity();
  }

  getUsuarios(){
    return this.api.getUsuarios(this.token).subscribe(
      (response:any)=>{
        let usuarios=response.data;
        this.usuarios=JSON.parse(usuarios);
      },
      error =>{
        console.log(error);
      }
    );
  }

  

}
