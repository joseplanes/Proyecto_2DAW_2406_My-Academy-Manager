import { Component, inject } from '@angular/core';
import { ApiService } from '../services/api.service';
import { UsuarioCardComponent } from '../usuario-card/usuario-card.component';
import { PatronPipe } from '../pipes/patron.pipe';
import { FormsModule } from '@angular/forms';
import { RouterModule, Router, ActivatedRoute } from '@angular/router';
import { UserService } from '../services/user.service';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-usuarios',
  standalone: true,
  imports: [UsuarioCardComponent, PatronPipe, FormsModule, RouterModule, CommonModule],
  templateUrl: './usuarios.component.html',
  styleUrl: './usuarios.component.css'
})
export class UsuariosComponent {
  private api = inject(ApiService);
  private userService = inject(UserService);
  public token: any;
  public identity: any;
  public usuarios: any;
  public usuarioToDelete: any;

  patron: string = '';
  roles: string = '';

  constructor(private router: Router, private route: ActivatedRoute) {
    this.loadUser();
    if (this.identity.rol == 'admin') {
      this.getUsuarios();
    } else {
      this.router.navigate(['/inicio']);
    }
  }

  loadUser() {
    this.token = this.userService.getToken();
    this.identity = this.userService.getIdentity();
  }

  getUsuarios() {
    return this.api.getUsuarios(this.token).subscribe(
      (response: any) => {
        let usuarios = response.data;
        this.usuarios = JSON.parse(usuarios);
      },
      error => {
        console.log(error);
      }
    );
  }

  confirmDelete(user: any) {
    this.usuarioToDelete = user;
    const modal = document.getElementById('delete-modal');
    if (modal) {
      modal.classList.remove('hidden');
      modal.classList.add('flex');
    }
  }

  deleteUsuario(user: any) {
    this.api.deleteUsuario(this.token, user.id).subscribe(
      (response: any) => {
        this.getUsuarios();
        this.closeModal();
      },
      error => {
        console.log(error);
      }
    );
  }

  closeModal() {
    const modal = document.getElementById('delete-modal');
    if (modal) {
      modal.classList.add('hidden');
      modal.classList.remove('flex');
    }
  }

}

