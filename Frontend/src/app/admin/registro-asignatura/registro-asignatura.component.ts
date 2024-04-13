import { Component, inject } from '@angular/core';
import { ApiService } from '../../services/api.service';
import { FormsModule } from '@angular/forms';

@Component({
  selector: 'app-registro-asignatura',
  standalone: true,
  imports: [FormsModule],
  templateUrl: './registro-asignatura.component.html',
  styleUrl: './registro-asignatura.component.css'
})
export class RegistroAsignaturaComponent {
  private api=inject(ApiService);
  formData:any={};
  
  ngOnInit(){
    this.formData={}
  }
  

  onSubmit(){
    this.api.createAsignatura(this.formData).subscribe((data:any)=>{
      console.log(data);
    })
  }
}
