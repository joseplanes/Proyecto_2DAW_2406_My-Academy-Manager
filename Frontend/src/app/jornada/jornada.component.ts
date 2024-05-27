import { Component, inject } from '@angular/core';
import { ApiService } from '../services/api.service';
import { RouterModule, Router,ActivatedRoute,Params } from '@angular/router';
import { UserService } from '../services/user.service';
import { DomSanitizer, SafeHtml } from '@angular/platform-browser';
import { CommonModule, DatePipe } from '@angular/common';
import { HoraPipe } from '../pipes/hora.pipe';
import { FormControl, FormsModule } from '@angular/forms';
import { MonthFilterPipe } from '../pipes/month-filter.pipe';

@Component({
  selector: 'app-jornada',
  standalone: true,
  imports: [DatePipe, CommonModule, RouterModule,HoraPipe, FormsModule,MonthFilterPipe],
  templateUrl: './jornada.component.html',
  styleUrl: './jornada.component.css'
})
export class JornadaComponent {
  private api=inject(ApiService)
  private userService=inject(UserService)
  public token:any;
  public identity:any;
  public jornadas:any;

  months = [
    { name: 'Todos', value: '0'},
    { name: 'Enero', value: '01' },
    { name: 'Febrero', value: '02' },
    { name: 'Marzo', value: '03' },
    { name: 'Abril', value: '04' },
    { name: 'Mayo', value: '05' },
    { name: 'Junio', value: '06' },
    { name: 'Julio', value: '07' },
    { name: 'Agosto', value: '08' },
    { name: 'Septiembre', value: '09' },
    { name: 'Octubre', value: '10' },
    { name: 'Noviembre', value: '11' },
    { name: 'Diciembre', value: '12' }
  ];
  
  selectedMonth: number=0;
  selectedMonthAsString: string = ("0" + this.selectedMonth).slice(-2);

  constructor(private router: Router, private route: ActivatedRoute, private sanitizer: DomSanitizer) {
    this.loadUser();
    if(this.identity.rol=='profesor'){
      this.getJornadas();
    }else{
      this.router.navigate(['/inicio']);
    }
  }

  loadUser(){
    this.token=this.userService.getToken();
    this.identity=this.userService.getIdentity();
  }

  getJornadas(){
    return this.api.getMisJornadas(this.token).subscribe(
      (response:any)=>{
        let jornadas = response.data;
        this.jornadas = JSON.parse(jornadas);
      },
      error =>{
        console.log(error);
      }
    );
  }
  getPDF() {
    this.api.getMisJornadasPDF(this.token).subscribe(
      (response: Blob) => { 
        let fileURL = URL.createObjectURL(response);
        window.open(fileURL);
      },
      error => {
        console.log(error);
      }
    );
  }
}
