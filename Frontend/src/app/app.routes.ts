import { Routes } from '@angular/router';
import { PerfilComponent } from './perfil/perfil.component';
import { AsistenciaComponent } from './asistencia/asistencia.component';
import { ClaseComponent } from './clase/clase.component';
import { ClaseDetalleComponent } from './clase-detalle/clase-detalle.component';
import { RegistroUsuarioComponent } from './admin/registro-usuario/registro-usuario.component';
import { UsuariosComponent } from './usuarios/usuarios.component';
import { RegistroclaseComponent } from './admin/registro-clase/registro-clase.component';
import { RegistroAsignaturaComponent } from './admin/registro-asignatura/registro-asignatura.component';
import { RegistroAulaComponent } from './admin/registro-aula/registro-aula.component';
import { LoginComponent } from './login/login.component';
import { IdentityGuard } from './services/identity.guard';
import { HomeComponent } from './home/home.component';
import { LandingComponent } from './landing/landing.component';
import { MisClasesComponent } from './mis-clases/mis-clases.component';
import { RegistroAsistenciaComponent } from './registro-asistencia/registro-asistencia.component';
import { RegistroCalificacionesComponent } from './registro-calificaciones/registro-calificaciones.component';
import { CalificacionesComponent } from './calificaciones/calificaciones.component';
import { MensajesComponent } from './mensajes/mensajes.component';
import { JornadaComponent } from './jornada/jornada.component';
import { ErrorComponent } from './error/error.component';

export const routes: Routes = [
{
    path: 'asistencia',
    component: AsistenciaComponent,
    title: 'Asistencia',
    canActivate: [IdentityGuard]
},
{
    path: 'faltasasistencia',
    component: RegistroAsistenciaComponent,
    title: 'Registro Asistencia',
    canActivate: [IdentityGuard]
},
{
    path: 'perfil',
    component: PerfilComponent,
    title: 'Perfil',
    canActivate: [IdentityGuard]
},
{
    path: 'asistencia',
    component: AsistenciaComponent,
    title: 'Asistencia',
    canActivate: [IdentityGuard]
},
{
    path: 'usuario',
    component: UsuariosComponent,
    title: 'Lista de Usuarios',
    canActivate: [IdentityGuard]
},
{
    path: 'clase',
    component: ClaseComponent,
    title: 'Clase',
    canActivate: [IdentityGuard]
},
{
    path:'clase/:id',
    component:ClaseDetalleComponent,
    title:'Informacion Clase',
    canActivate: [IdentityGuard]
},

{
    path:'usuario/crear',
    component:RegistroUsuarioComponent,
    title:'Resgitro Usuario',
    canActivate: [IdentityGuard]
},
{
    path:'clases/crear',
    component:RegistroclaseComponent,
    title:'Resgitro Clase',
    canActivate: [IdentityGuard]
},
{
    path:'asignatura/crear',
    component:RegistroAsignaturaComponent,
    title:'Resgitro Asignatura',
    canActivate: [IdentityGuard]
},
{
    path:'aula/crear',
    component:RegistroAulaComponent,
    title:'Resgitro Aula',
    canActivate: [IdentityGuard]
},
{
    path:'inicio',
    component:HomeComponent,
    title:'Inicio',
    canActivate: [IdentityGuard]
},
{
    path:'login',
    component:LoginComponent,
    title:'Login'
},
{
    path:'logout/:sure',
    component:LoginComponent,
    title:'Logout'
},
{
  path:'',
  component: LandingComponent,
  title:'MyAcademy Manager'
},
{
    path: 'clases',
    component: MisClasesComponent,
    title: 'Clases',
    canActivate: [IdentityGuard]
},
{
    path: 'calificaciones',
    component: RegistroCalificacionesComponent,
    title: 'Calificaciones',
    canActivate: [IdentityGuard]
},
{
    path: 'misnotas',
    component: CalificacionesComponent,
    title: 'Calificaciones',
    canActivate: [IdentityGuard]
},
{
    path: 'mensajes',
    component: MensajesComponent,
    title: 'Mensajes',
    canActivate: [IdentityGuard]
},
{
    path: 'jornadas',
    component: JornadaComponent,
    title: 'Mis Jornadas Laborales',
    canActivate: [IdentityGuard]
},
{
    path: '**',
    component: ErrorComponent,
    title: 'Error 404'
}
];
