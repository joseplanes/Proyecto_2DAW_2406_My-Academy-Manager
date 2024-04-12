import { Pipe, PipeTransform } from '@angular/core';

@Pipe({
  name: 'patron',
  standalone: true
})
export class PatronPipe implements PipeTransform {

  transform(value: any[], patron: string): any[] {
    if (value && value.length) {
      return value.filter(a=>a.nombre.toLowerCase().includes(patron.toLowerCase())||a.apellidos.toLowerCase().includes(patron.toLowerCase())||a.rol.toLowerCase().includes(patron.toLowerCase()))
    }
    else
    return []
  }

}
