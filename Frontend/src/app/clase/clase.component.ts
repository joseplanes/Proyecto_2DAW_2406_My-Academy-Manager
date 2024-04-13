import { Component, inject } from '@angular/core';
import { ApiService } from '../services/api.service';
import { RouterModule, Router,ActivatedRoute,Params } from '@angular/router';
import { UserService } from '../services/user.service';
import { CommonModule } from '@angular/common';
import { DomSanitizer, SafeHtml } from '@angular/platform-browser';
import { PatronClasePipe } from '../pipes/patron-clase.pipe';


@Component({
  selector: 'app-clase',
  standalone: true,
  imports: [RouterModule, PatronClasePipe],
  templateUrl: './clase.component.html',
  styleUrl: './clase.component.css'
})
export class ClaseComponent {
  private api=inject(ApiService)
  private userService=inject(UserService)
  public token:any;
  public identity:any;
  public clases:any;
 

  patron: string = '';
  roles:string='';

  constructor(private router: Router, private route: ActivatedRoute, private sanitizer: DomSanitizer) {
    this.loadUser();
    if(this.identity.rol=='admin'){
      this.getClases();
    }else{
      this.router.navigate(['/asistencia']);
    }
  }
  loadUser(){
    this.token=this.userService.getToken();
    this.identity=this.userService.getIdentity();
  }
  getSafeHtml(html: any) {
    return this.sanitizer.bypassSecurityTrustHtml(html);
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
}
