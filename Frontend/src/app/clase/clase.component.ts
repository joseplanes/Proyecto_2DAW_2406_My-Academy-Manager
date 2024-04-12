import { Component, inject } from '@angular/core';
import { ApiService } from '../api.service';
import { DomSanitizer, SafeHtml } from '@angular/platform-browser';
import { RouterModule } from '@angular/router';
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
  patron: string = '';
  clases= <any>[];
  ngOnInit(){
    this.clases=[];
    this.getClases();
  }
  getSafeHtml(html: any) {
    return this.sanitizer.bypassSecurityTrustHtml(html);
  }

  constructor(private sanitizer: DomSanitizer) { }

  getClases(){
    return this.api.getClases().subscribe((JSON:any)=>{
      this.clases=JSON})
  }
}
