import { Component, inject } from '@angular/core';
import { ApiService } from '../../services/api.service';
import { FormsModule } from '@angular/forms';
import { UserService } from '../../services/user.service';
import { RouterModule, Router,ActivatedRoute,Params } from '@angular/router';

@Component({
  selector: 'app-registro-usuario',
  standalone: true,
  imports: [FormsModule,RouterModule],
  templateUrl: './registro-usuario.component.html',
  styleUrl: './registro-usuario.component.css'
})
export class RegistroUsuarioComponent {
  private api=inject(ApiService)
  private userService=inject(UserService)
  public token:any;
  public identity:any;
  formData:any={};
  clases= <any>[];
  public status:string='';
  public message:string='';

  constructor(private router: Router, private route: ActivatedRoute) {
    this.loadUser();
    if(this.identity.rol=='admin'){
      this.getClases();
      this.formData={
        clases: []
      };
    }else{
      this.router.navigate(['/inicio']);
    }
  }
  loadUser(){
    this.token=this.userService.getToken();
    this.identity=this.userService.getIdentity();
  }

  getClases(){
    return this.api.getClases(this.token).subscribe(
      (response:any)=>{
        let clases = response.data;
        this.clases = JSON.parse(clases);
      },
      error =>{
        console.log(error);
      }
    );
  }
  
  goBack(){
    this.router.navigate(['/usuario']);
  }

  onSubmit(useredirForm: any) {
    const selectedClases = Object.keys(this.formData.clases)
    .filter(key => this.formData.clases[key])
    .map(Number);
    const formDataToSend = {
      ...this.formData,
      clases: selectedClases
    };

    this.userService.create(this.token,formDataToSend).subscribe(
     (response:any ) => {
       if(response && response.status == 'success'){
         this.status = 'success';
         this.message = response.message;
         this.router.navigate(['/usuario']);
         
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
