import { Component, inject } from '@angular/core';
import { ApiService } from '../api.service';
import { UsuarioCardComponent } from '../usuario-card/usuario-card.component';
import { PatronPipe } from '../pipes/patron.pipe';
import { FormsModule } from '@angular/forms';
import { RouterModule } from '@angular/router';

@Component({
  selector: 'app-usuarios',
  standalone: true,
  imports: [UsuarioCardComponent, PatronPipe, FormsModule, RouterModule],
  templateUrl: './usuarios.component.html',
  styleUrl: './usuarios.component.css'
})
export class UsuariosComponent {
  private api=inject(ApiService)
  patron: string = '';
  roles: string='';

  getUsuarios(){
    return this.api.getUsuarios();
  }

}
