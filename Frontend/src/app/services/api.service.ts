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

  getMisClases(token:any){
    let headers = new HttpHeaders().set('Content-Type', 'application/x-www-form-urlencoded')
                                   .set('Authorization', token);

    return this.http.get(this.baseUrl+'list/misclases', {headers: headers});
  }
  getMisClasesHoy(token:any){
    let headers = new HttpHeaders().set('Content-Type', 'application/x-www-form-urlencoded')
                                   .set('Authorization', token);

    return this.http.get(this.baseUrl+'list/misclaseshoy', {headers: headers});
  }

  getClases(token:any){
    let headers = new HttpHeaders().set('Content-Type', 'application/x-www-form-urlencoded')
                                   .set('Authorization', token);

    return this.http.get(this.baseUrl+'list/clases', {headers: headers});
  }
  createClase(token:any, clase:any){
    let json = JSON.stringify(clase);
    let params = 'json='+json;

    let headers = new HttpHeaders().set('Content-Type', 'application/x-www-form-urlencoded')
                                   .set('Authorization', token);

    return this.http.post(this.baseUrl+'admin/clase/crear', params, {headers: headers});
  }

 

  getAsignaturas(token:any){
    let headers = new HttpHeaders().set('Content-Type', 'application/x-www-form-urlencoded')
                                   .set('Authorization', token);

    return this.http.get(this.baseUrl+'list/asignaturas', {headers: headers});
  }

  createAsignatura(token:any, asignatura:any){
    let json = JSON.stringify(asignatura);
    let params = 'json='+json;

    let headers = new HttpHeaders().set('Content-Type', 'application/x-www-form-urlencoded')
                                   .set('Authorization', token);

    return this.http.post(this.baseUrl+'admin/asignaturas/crear', params, {headers: headers});
  }

  createAula(token:any, aula:any){
    let json = JSON.stringify(aula);
    let params = 'json='+json;

    let headers = new HttpHeaders().set('Content-Type', 'application/x-www-form-urlencoded')
                                   .set('Authorization', token);

    return this.http.post(this.baseUrl+'admin/aulas/crear', params, {headers: headers});
  }

  getProfesores(token:any){
    let headers = new HttpHeaders().set('Content-Type', 'application/x-www-form-urlencoded')
                                   .set('Authorization', token);

    return this.http.get(this.baseUrl+'list/profesores', {headers: headers});
  }

  getAulas(token:any){
    let headers = new HttpHeaders().set('Content-Type', 'application/x-www-form-urlencoded')
                                   .set('Authorization', token);

    return this.http.get(this.baseUrl+'list/aulas', {headers: headers});
  }
  
  getDias(token:any){
    let headers = new HttpHeaders().set('Content-Type', 'application/x-www-form-urlencoded')
                                   .set('Authorization', token);

    return this.http.get(this.baseUrl+'list/dias', {headers: headers});
  }

  
}
