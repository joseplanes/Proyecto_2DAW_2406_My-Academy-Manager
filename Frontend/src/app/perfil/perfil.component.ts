import { Component,inject } from '@angular/core';
import { Router, ActivatedRoute, Params } from '@angular/router';
import { User } from '../models/user';
import { UserService } from '../user.service';
import { FormsModule } from '@angular/forms';


@Component({
  selector: 'app-perfil',
  standalone: true,
  imports: [FormsModule],
  templateUrl: './perfil.component.html',
  styleUrl: './perfil.component.css'
})
export class PerfilComponent {
  private userService=inject(UserService);
  public user: User;
  public identity: any;
  public status:string='';
  public token: any;

  constructor(private _router: Router, private _route: ActivatedRoute) {
    this.identity = this.userService.getIdentity();
    this.token = this.userService.getToken();
    this.user = new User(this.identity.sub, this.identity.nombre, this.identity.apellidos, this.identity.email, '', this.identity.fecha_nacimiento.date, this.identity.rol, this.identity.dni);
    this.status = '';
      
    
  }
  ngOnInit(){
    
  
  }
  onSubmit(useredirForm: any) {
     this.userService.update(this.token,this.user).subscribe(
      (response:any ) => {
        if(response && response.status == 'success'){
          this.status = 'success';
          setTimeout(() => {
            this._router.navigate(['/logout/1']);
          }, 2000);
        }else{
          this.status = 'error';
        }
      },
      error => {
        this.status = 'error';
        console.log(error);
      }
    );

   
    
  }


}


