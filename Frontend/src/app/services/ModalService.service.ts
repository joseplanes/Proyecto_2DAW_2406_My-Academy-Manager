import { Injectable } from '@angular/core';
import { BehaviorSubject } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ModalService {
  private modalAbiertoSubject = new BehaviorSubject<boolean>(false);
  modalAbierto$ = this.modalAbiertoSubject.asObservable();

  abrirModal(): void {
    this.modalAbiertoSubject.next(true);
  }

  cerrarModal(): void {
    this.modalAbiertoSubject.next(false);
  }
}
