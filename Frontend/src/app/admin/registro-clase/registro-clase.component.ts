import { Component, inject } from '@angular/core';
import { ApiService } from '../../services/api.service';
import { FormsModule } from '@angular/forms';
import { DiasPipe } from '../../pipes/dias.pipe';

@Component({
  selector: 'app-registroclase',
  standalone: true,
  imports: [FormsModule, DiasPipe],
  templateUrl: './registro-clase.component.html',
  styleUrl: './registro-clase.component.css'
})
export class RegistroclaseComponent {
  private api=inject(ApiService);
  formData:any={};
  asignaturas=<any>[];
  profesores=<any>[];
  aulas=<any>[];
  dias=<any>[];

  ngOnInit(){
    this.formData={
      dias: []
    }
    this.getAsignaturas();
    this.getProfesores();
    this.getAulas();
    this.getDias();
  }
  getAsignaturas(){
    return this.api.getAsignaturas().subscribe((data:any)=>{ this.asignaturas=data;})
  }

  getProfesores(){  
    return this.api.getProfesores().subscribe((data:any)=>{ this.profesores=data;})
  }
  getAulas(){
    return this.api.getAulas().subscribe((data:any)=>{ this.aulas=data;})
  }

  getDias(){
    return this.api.getDias().subscribe((data:any)=>{ this.dias=data;})
  }

  onSubmit(){

    const selectedDias = Object.keys(this.formData.dias)
    .filter(key => this.formData.dias[key])
    .map(Number);
    const formDataToSend = {
      ...this.formData,
      dias: selectedDias
  };
    console.log(this.formData);
    this.api.createClase(formDataToSend).subscribe((data:any)=>{
      console.log(data);
    })
  }

}
