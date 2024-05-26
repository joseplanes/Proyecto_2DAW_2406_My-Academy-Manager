import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class ApiService {

  private baseUrl = 'http://localhost:8000/api/'; 

  private usuarios=<any>[]

  constructor(private http: HttpClient) { 
      
  }

  getMiJornada(token:any){
    let headers = new HttpHeaders().set('Content-Type', 'application/x-www-form-urlencoded')
                                   .set('Authorization', token);
    return this.http.get(this.baseUrl+`list/mijornadalaboral`, {headers: headers});
    
  }
  setInicioJornada(token:any){
    let headers = new HttpHeaders().set('Content-Type', 'application/x-www-form-urlencoded')
                                   .set('Authorization', token);
    return this.http.get(this.baseUrl+`list/iniciojornada`, {headers: headers});
    
  }

  setFinJornada(token:any){
    let headers = new HttpHeaders().set('Content-Type', 'application/x-www-form-urlencoded')
                                   .set('Authorization', token);
    return this.http.get(this.baseUrl+`list/finjornada`, {headers: headers});
    
  }


  getClase(id:number, token:any){
    let headers = new HttpHeaders().set('Content-Type', 'application/x-www-form-urlencoded')
                                   .set('Authorization', token);
    return this.http.get(this.baseUrl+`list/clase/${id}`, {headers: headers});
    
  }

  getMisMensajes(token:any){
    let headers = new HttpHeaders().set('Content-Type', 'application/x-www-form-urlencoded')
                                   .set('Authorization', token);
    return this.http.get(this.baseUrl+`list/mismensajes`, {headers: headers});
    
  }
  getMisMensajesUnicos(remi:number, token:any){
    let headers = new HttpHeaders().set('Content-Type', 'application/x-www-form-urlencoded')
                                   .set('Authorization', token);
    return this.http.get(this.baseUrl+`list/mismensajes/${remi}`, {headers: headers});
    
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
  createAsistencia(token:any, asistencia:any){
    let json = JSON.stringify(asistencia);
    let params = 'json='+json;

    let headers = new HttpHeaders().set('Content-Type', 'application/x-www-form-urlencoded')
                                   .set('Authorization', token);

    return this.http.post(this.baseUrl+'list/asistencia', params, {headers: headers});
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

  getMisFaltas(token:any){
    let headers = new HttpHeaders().set('Content-Type', 'application/x-www-form-urlencoded')
                                   .set('Authorization', token);

    return this.http.get(this.baseUrl+'list/misfaltas', {headers: headers});
  }

  getMisNotas(token:any){
    let headers = new HttpHeaders().set('Content-Type', 'application/x-www-form-urlencoded')
                                   .set('Authorization', token);

    return this.http.get(this.baseUrl+'list/misnotas', {headers: headers});
  }
  getMisNotasPDF(token:any){
    let headers = new HttpHeaders().set('Authorization', token);

    return this.http.get(this.baseUrl+'pdf/misnotas', {headers: headers, responseType: 'blob'});
  }
  createCalificaciones(token:any, calificaciones:any){
    let json = JSON.stringify(calificaciones);
    let params = 'json='+json;

    let headers = new HttpHeaders().set('Content-Type', 'application/x-www-form-urlencoded')
                                   .set('Authorization', token);

    return this.http.post(this.baseUrl+'list/calificaciones', params, {headers: headers});
  }

  enviarMensaje(token:any, mensaje:any){
    let json = JSON.stringify(mensaje);
    let params = 'json='+json;

    let headers = new HttpHeaders().set('Content-Type', 'application/x-www-form-urlencoded')
                                   .set('Authorization', token);

    return this.http.post(this.baseUrl+'list/mismensajes/crear', params, {headers: headers});
  }

  
}
