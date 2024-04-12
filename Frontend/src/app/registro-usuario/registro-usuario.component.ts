import { Component, inject } from '@angular/core';
import { ApiService } from '../services/api.service';
import { FormsModule } from '@angular/forms';

@Component({
  selector: 'app-registro-usuario',
  standalone: true,
  imports: [FormsModule],
  templateUrl: './registro-usuario.component.html',
  styleUrl: './registro-usuario.component.css'
})
export class RegistroUsuarioComponent {
  private api=inject(ApiService);
  formData:any={};
  clases= <any>[];
 ngOnInit(){ 
    this.formData={
      clases: []
    };
  
    this.clases=[];

    this.getClasesBasic();
  }
  getClasesBasic(){
    return this.api.getClasesBasic().subscribe((JSON:any)=>{
      this.clases=JSON})
  }

  onSubmit(){
    const selectedClases = Object.keys(this.formData.clases)
    .filter(key => this.formData.clases[key])
    .map(Number);
    const formDataToSend = {
      ...this.formData,
      clases: selectedClases
  };
    console.log(this.formData);
    this.api.createUsuario(formDataToSend).subscribe((data:any)=>{
      console.log(data);
    })
  }

}
