import { Component, ElementRef, ViewChild, AfterViewChecked, inject, OnDestroy } from '@angular/core';
import { ApiService } from '../services/api.service';
import { RouterModule, Router, ActivatedRoute } from '@angular/router';
import { UserService } from '../services/user.service';
import { DomSanitizer } from '@angular/platform-browser';
import { CommonModule, DatePipe } from '@angular/common';
import { PatronPipe } from '../pipes/patron.pipe';

@Component({
  selector: 'app-mensajes',
  standalone: true,
  imports: [RouterModule, CommonModule, DatePipe, PatronPipe],
  templateUrl: './mensajes.component.html',
  styleUrl: './mensajes.component.css'
})
export class MensajesComponent implements AfterViewChecked, OnDestroy {
  private api = inject(ApiService);
  private userService = inject(UserService);
  public token: any;
  public identity: any;
  public mensajes: any;
  public mensajesunicos: any;
  public mostrarmensaje: boolean = false;
  public remi: any = { remitente: { id: '0', nombre: '', apellidos: '' } };
  input: string = '';
  public status: string = '';
  public numremi: number = 0;
  public messageenvio: string = '';
  public antiguos:boolean=true;
  patron:string='';
  public usuarios:any;
  
  getUsuarios(){
    return this.api.getUsuarios(this.token).subscribe(
      (response:any)=>{
        let usuarios=response.data;
        this.usuarios=JSON.parse(usuarios);
      },
      error =>{
        console.log(error);
      }
    );
  }
  private intervalId: any;
  startInterval(): void {
    this.intervalId = setInterval(() => {
      this.getMensajesUnicos(this.remi.id);
    }, 2000); // 2000 ms = 2 segundos
  }
  ngOnDestroy(): void {
    this.clearInterval();
  }
  clearInterval(): void {
    if (this.intervalId) {
      clearInterval(this.intervalId);
    }
  }
  clickbuscar(){
    this.getUsuarios();
    this.antiguos=false;
  }

  @ViewChild('messagesContainer') private messagesContainer?: ElementRef;

  isRemitente(remi: number) {
    return remi == this.identity.sub;
  }

  constructor(private router: Router, private route: ActivatedRoute, private sanitizer: DomSanitizer) {
    this.loadUser();
    if (this.identity.rol == 'alumno' || this.identity.rol == 'profesor' || this.identity.rol == 'admin') {
      this.getMensajesInicio();
    } else {
      this.router.navigate(['/inicio']);
    }
  }

  ngAfterViewChecked() {
    this.scrollToBottom();
  }

  private scrollToBottom(): void {
    if (this.messagesContainer?.nativeElement) {
      try {
        this.messagesContainer.nativeElement.scrollTop = this.messagesContainer.nativeElement.scrollHeight;
      } catch (err) {
        console.error('Error al desplazarse al final del contenedor de mensajes:', err);
      }
    }
  }

  navigateToMensajes() {
    this.mostrarmensaje = false;
    this.router.navigate(['/mensajes']);
  }

  loadUser() {
    this.token = this.userService.getToken();
    this.identity = this.userService.getIdentity();
  }

  getMensajesInicio() {
    return this.api.getMisMensajes(this.token).subscribe(
      (response: any) => {
        let mensajes = response.data;
        this.mensajes = JSON.parse(mensajes);
      },
      error => {
        console.log(error);
      }
    );
  }
  cancelarBusqueda(){
    this.antiguos=true;
    this.patron='';
  }

  getMensajesUnicos(remi: number) {
    return this.api.getMisMensajesUnicos(remi, this.token).subscribe(
      (response: any) => {
        let mensajesunicos = response.data;
        this.mensajesunicos = JSON.parse(mensajesunicos);
        this.mostrarmensaje = true;
        this.numremi = remi;
      },
      error => {
        console.log(error);
      }
    );
  }
  setRemi(remi: any) {
    this.remi = remi
    this.getMensajesUnicos(remi.id);
    this.startInterval();
  }


  enviarMensaje() {
      let mensaje = {
        remi: this.identity.sub,
        receptor: this.remi.id,
        mensaje: this.input
      };

      this.api.enviarMensaje(this.token, mensaje).subscribe(
        (response: any) => {
          if (response && response.status == 'success') {
            this.status = 'success';
            this.messageenvio = response.message;
            this.getMensajesUnicos(mensaje.receptor);
          } else {
            this.status = 'error';
            this.messageenvio = response.message;
          }
        },
        error => {
          this.status = 'error';
          console.log(error);
        }
      );
      this.getMensajesInicio();
  }
}

