import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';


@Injectable({
  providedIn: 'root'
})
export class UserService {

  private baseUrl = 'http://localhost:8000/'; 
  public identity:any;
  public token:any;

  constructor( public _http: HttpClient) { }

  prueba(){
    return 'Hola mundo desde un servicio de Angular';
  }

  login(user:any, gettoken: boolean | null = null){
    if(gettoken != null){
      user.gettoken = 'true';
    }
    let json = JSON.stringify(user);
    let params = 'json='+json;

    let headers = new HttpHeaders().set('Content-Type', 'application/x-www-form-urlencoded');

    return this._http.post(this.baseUrl+'usuarios/login', params, {headers: headers});
  }

  update(token:any, user:any){
    let json = JSON.stringify(user);
    let params = 'json='+json;

    let headers = new HttpHeaders().set('Content-Type', 'application/x-www-form-urlencoded')
                                   .set('Authorization', token);

    return this._http.put(this.baseUrl+'usuarios/editar', params, {headers: headers});
  }

  getIdentity() {
    let identityString = localStorage.getItem('identity');
    if (identityString !== null) {
      let identity = JSON.parse(identityString);
      
      this.identity = identity;
    } else {
      this.identity = null;
    }
    return this.identity;
  }

  getToken() {
    let token = localStorage.getItem('token');
    if (token !== undefined && token) {
      this.token = token;
    } else {
      this.token = null;
    }
    return this.token;
  }
  

}
