import { Component, inject } from '@angular/core';
import { ApiService } from '../../services/api.service';
import { FormsModule } from '@angular/forms';

@Component({
  selector: 'app-registro-aula',
  standalone: true,
  imports: [FormsModule],
  templateUrl: './registro-aula.component.html',
  styleUrl: './registro-aula.component.css'
})
export class RegistroAulaComponent {
  private api=inject(ApiService);
  formData:any={};
  
  ngOnInit(){
    this.formData={}
  }
  

  onSubmit(){
    this.api.createAula(this.formData).subscribe((data:any)=>{
      console.log(data);
    })
  }
}
