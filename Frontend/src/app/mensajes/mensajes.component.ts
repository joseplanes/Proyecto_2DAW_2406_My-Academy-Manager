import { Component, inject } from '@angular/core';
import { ApiService } from '../services/api.service';
import { RouterModule, Router,ActivatedRoute,Params } from '@angular/router';
import { UserService } from '../services/user.service';
import { DomSanitizer, SafeHtml } from '@angular/platform-browser';
import { CommonModule, DatePipe } from '@angular/common';
import { ModalService } from '../services/ModalService.service';
import { ListaModalComponent } from '../lista-modal/lista-modal.component';

@Component({
  selector: 'app-mensajes',
  standalone: true,
  imports: [RouterModule, CommonModule, DatePipe,ListaModalComponent],
  templateUrl: './mensajes.component.html',
  styleUrl: './mensajes.component.css'
})
export class MensajesComponent {
  
  private api=inject(ApiService)
  private userService=inject(UserService)
  public modalService=inject(ModalService)
  public token:any;
  public identity:any;
  public mensajes:any;
  public mensajesunicos:any;
  public mostrarmensaje:boolean=false;
  public isFlex:boolean=false;
  public remi:any={remitente:{id:'0',nombre:'',apellidos:''}};
  public remimm:any={remitente:{id:'',nombre:'',apellidos:''}};
  input:string='';
  public status:string='';
  public numremi:number=0;
  public remimodal:any;
  public messageenvio:string='';

  isRemitente(remi:number){
    if(remi==this.identity.sub){
      return true;
    }else{
      return false;
    }
  }

  constructor(private router: Router, private route: ActivatedRoute, private sanitizer: DomSanitizer) {
    this.loadUser();
    if(this.identity.rol=='alumno'||this.identity.rol=='profesor'||this.identity.rol=='admin'){
      this.getMensajesInicio();
    }else{
      this.router.navigate(['/inicio']);
    }
  }

  abrirModal(): void {
    this.modalService.abrirModal();
  }

  loadUser(){
    this.token=this.userService.getToken();
    this.identity=this.userService.getIdentity();
  }

  getMensajesInicio(){
    return this.api.getMisMensajes(this.token).subscribe(
      (response:any)=>{
        let mensajes = response.data;
        this.mensajes = JSON.parse(mensajes);
      },
      error =>{
        console.log(error);
      }
    );
  }
  getMensajesUnicos(remi:number){
    return this.api.getMisMensajesUnicos(remi, this.token).subscribe(
      (response:any)=>{
        let mensajesunicos = response.data;
        this.mensajesunicos = JSON.parse(mensajesunicos);
        this.mostrarmensaje=true;
        this.numremi=remi;
      },
      error =>{
        console.log(error);
      }
    );
  }

  seleccionarRemi(){
    this.isFlex=!this.isFlex;
  }

  setRemi(remi:any){
    this.remi=remi;
  }
  setRemiModal(remi:any){
    this.remi.remitente.id=remi.id;
    this.remi.remitente.nombre=remi.nombre;
    this.remi.remitente.apellidos=remi.apellidos;
  }

  enviarMensaje(){
    if(this.identity.sub==this.remi.receptor.id){
      
      let mensaje = {
        remi: this.identity.sub,
        receptor: this.remi.remitente.id,
        mensaje: this.input
      };
      
      this.api.enviarMensaje(this.token, mensaje).subscribe(
        (response:any ) => {
          if(response && response.status == 'success'){
            this.status = 'success';
            this.messageenvio = response.message;
            
            this.getMensajesUnicos(this.remi.remitente.id);      
          }else{
            this.status = 'error';
            this.messageenvio = response.message;
          }
        },
        error => {
          this.status = 'error';
          console.log(error);
        }
      );
    }else{
      let mensaje = {
        remi: this.identity.sub,
        receptor: this.remi.receptor.id,
        mensaje: this.input
      };
      
      this.api.enviarMensaje(this.token, mensaje).subscribe(
        (response:any ) => {
          if(response && response.status == 'success'){
            this.status = 'success';
            this.messageenvio = response.message;
            
          }else{
            this.status = 'error';
            this.messageenvio = response.message;
          }
        },
        error => {
          this.status = 'error';
          console.log(error);
        }
      );
      this.getMensajesUnicos(this.numremi);      
    }
  }
  onElementoSeleccionado(id: any): void {
    this.remimodal=id;
    
    
    // Cierra el modal
    this.modalService.cerrarModal();
  }

  enviarMensajeModal(){
      let mensaje = {
        remi: this.identity.sub,
        receptor: this.remimodal.id,
        mensaje: this.input
      };
      
      this.api.enviarMensaje(this.token, mensaje).subscribe(
        (response:any ) => {
          if(response && response.status == 'success'){
            this.status = 'success';
            this.messageenvio = response.message;
            
            this.setRemiModal(this.remimodal);
            this.getMensajesInicio();
            this.remimodal=null;
            this.getMensajesUnicos(mensaje.receptor);

                 
          }else{
            this.status = 'error';
            this.messageenvio = response.message;
          }
        },
        error => {
          this.status = 'error';
          console.log(error);
        }
      );
  }

}
