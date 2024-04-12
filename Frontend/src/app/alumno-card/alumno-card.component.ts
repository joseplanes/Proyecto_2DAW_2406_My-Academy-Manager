import { Component, Input } from '@angular/core';

@Component({
  selector: 'app-alumno-card',
  standalone: true,
  imports: [],
  templateUrl: './alumno-card.component.html',
  styleUrl: './alumno-card.component.css'
})
export class AlumnoCardComponent {
  @Input() alumno: any;

}
