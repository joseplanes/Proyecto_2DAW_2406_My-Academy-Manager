import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class ApiService {

  private baseUrl = 'http://localhost:8000/'; 

  private usuarios=<any>[]

 


  constructor(private http: HttpClient) { 
      
  }


  
  
  getClasesBasic(){
    return this.http.get(this.baseUrl+"clasebasic");
  }

  getClase(id:number){
    return this.http.get(this.baseUrl+`clase/${id}`);
    
  }



  getUsuarios(token:any){
    let headers = new HttpHeaders().set('Content-Type', 'application/x-www-form-urlencoded')
                                   .set('Authorization', token);

    return this.http.get(this.baseUrl+'list/usuarios', {headers: headers});
  }

  getClases(token:any){
    let headers = new HttpHeaders().set('Content-Type', 'application/x-www-form-urlencoded')
                                   .set('Authorization', token);

    return this.http.get(this.baseUrl+'list/clases', {headers: headers});
  }

  getAsignaturas(){
    return this.http.get(this.baseUrl+"asignaturas");
  }

  getProfesores(){
    return this.http.get(this.baseUrl+"profesores");
  }

  getAulas(){
    return this.http.get(this.baseUrl+"aulas");
  }
  
  getDias(){
    return this.http.get(this.baseUrl+"dias");
  }




  createAula(data:any){
    return this.http.post(this.baseUrl+"aulas/crear",data);
  }

  createUsuario(data:any){
    return this.http.post(this.baseUrl+"usuarios/crear",data);
  }

  createClase(data:any){
    return this.http.post(this.baseUrl+"clase/crear",data);
  }

  createAsignatura(data:any){
    return this.http.post(this.baseUrl+"asignaturas/crear",data);
  }

  
}
