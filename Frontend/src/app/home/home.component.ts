import { CommonModule } from '@angular/common';
import { Component , OnInit, inject} from '@angular/core';
import { RouterModule, RouterOutlet, Router,ActivatedRoute,Params  } from '@angular/router';
import { ApiService } from '../services/api.service';
import { UserService } from '../services/user.service';
import { DomSanitizer, SafeHtml } from '@angular/platform-browser';
import { PatronClasePipe } from '../pipes/patron-clase.pipe';
import { HoraPipe } from '../pipes/hora.pipe';

@Component({
  selector: 'app-home',
  standalone: true,
  imports: [RouterModule, RouterOutlet, CommonModule, HoraPipe],
  templateUrl: './home.component.html',
  styleUrl: './home.component.css'
})
export class HomeComponent implements OnInit {

  monthYear: string = '';
  days: any[] = [];
  private weekdays: string[] = ['lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado', 'domingo'];
  currentYear: number = new Date().getFullYear(); // Inicializado
  currentMonth: number = new Date().getMonth(); // Inicializado

  constructor(private router: Router, private route: ActivatedRoute, private sanitizer: DomSanitizer) {
    this.loadUser();
    if(this.identity.rol=='alumno'||this.identity.rol=='profesor'|| this.identity.rol=='admin'){
      this.getMisClasesHoy();
    }
  }
  getMisClasesHoy(){
    return this.api.getMisClasesHoy(this.token).subscribe(
      (response:any)=>{
        let clases = response.data;
        this.clases = JSON.parse(clases);
        
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

  ngOnInit(): void {
    this.generateCalendar();
  }

  generateCalendar(): void {
    const today = new Date();
    const currentMonth = this.currentMonth; // Accede a la propiedad en lugar de obtenerla de today.getMonth()
    const currentYear = this.currentYear; // Accede a la propiedad en lugar de obtenerla de today.getFullYear()

    this.updateCalendar(currentYear, currentMonth);
  }

  updateCalendar(year: number, month: number): void {
    const firstDayOfMonth = new Date(year, month, 1);
    const daysInMonth = new Date(year, month + 1, 0).getDate();

    const dateString = firstDayOfMonth.toLocaleDateString('es-ES', {
      weekday: 'long',
      year: 'numeric',
      month: 'long',
      day: 'numeric',
    });

    const paddingDays = this.weekdays.indexOf(dateString.split(', ')[0]);

    this.monthYear = `${firstDayOfMonth.toLocaleDateString('es-ES', { month: 'long' })} ${year}`;
    this.days = [];

    for (let i = 1; i <= paddingDays + daysInMonth; i++) {
      if (i > paddingDays) {
        this.days.push(i - paddingDays);
      } else {
        this.days.push('');
      }
    }
  }

  previousMonth(): void {
    if (this.currentMonth === 0) {
      this.currentYear--;
      this.currentMonth = 11;
    } else {
      this.currentMonth--;
    }

    this.updateCalendar(this.currentYear, this.currentMonth);
  }

  nextMonth(): void {
    if (this.currentMonth === 11) {
      this.currentYear++;
      this.currentMonth = 0;
    } else {
      this.currentMonth++;
    }

    this.updateCalendar(this.currentYear, this.currentMonth);
  }

  private api=inject(ApiService)
  private userService=inject(UserService)
  public token:any;
  public identity:any;
  public clases:any;
}

