import { Component, OnDestroy, inject, EventEmitter, Output } from '@angular/core';
import { ModalService } from '../services/ModalService.service';
import { Subscription } from 'rxjs';
import { ApiService } from '../services/api.service';
import { UserService } from '../services/user.service';
import { DomSanitizer, SafeHtml } from '@angular/platform-browser';
import { RouterModule, Router,ActivatedRoute,Params } from '@angular/router';
import { PatronPipe } from '../pipes/patron.pipe';

@Component({
  selector: 'app-lista-modal',
  standalone: true,
  imports: [PatronPipe],
  templateUrl: './lista-modal.component.html',
  styleUrl: './lista-modal.component.css'
})
export class ListaModalComponent implements OnDestroy {
  @Output() elementoSeleccionado = new EventEmitter<any>();
  modalAbierto = false;
  private modalSubscription: Subscription;

  private api=inject(ApiService)
  private userService=inject(UserService)
  public token:any;
  public identity:any;
  public usuarios:any;

  patron:string='';

  onClose(id: any): void {
    this.elementoSeleccionado.emit(id);
  }

  constructor(private modalService: ModalService, private router: Router, private route: ActivatedRoute, private sanitizer: DomSanitizer) {
    this.loadUser();
    this.modalSubscription = this.modalService.modalAbierto$.subscribe(abrir => {
      this.modalAbierto = abrir;
    });
    if(this.identity.rol=='alumno'||this.identity.rol=='profesor'||this.identity.rol=='admin'){
      this.getUsuarios();
    }else{
      this.router.navigate(['/mensajes']);
    }
  }
  loadUser(){
    this.token=this.userService.getToken();
    this.identity=this.userService.getIdentity();
  }
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
  

  ngOnDestroy(): void {
    this.modalSubscription.unsubscribe();
  }

  cerrarModal(): void {
    this.modalService.cerrarModal();
  }
} 
