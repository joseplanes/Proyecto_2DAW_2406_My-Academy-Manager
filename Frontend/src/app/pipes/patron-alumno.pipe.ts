import { Pipe, PipeTransform } from '@angular/core';

@Pipe({
  name: 'patronAlumno',
  standalone: true
})
export class PatronAlumnoPipe implements PipeTransform {

  transform(value: any[], patron: string): any[] {
    if (value && value.length) {
      return value.filter(a=>a.usuario.nombre.toLowerCase().includes(patron.toLowerCase())||a.usuario.apellidos.toLowerCase().includes(patron.toLowerCase()))
    }
    else
    return []
  }

}
