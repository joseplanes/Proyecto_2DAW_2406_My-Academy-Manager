import { Pipe, PipeTransform } from '@angular/core';

@Pipe({
  name: 'patronClase',
  standalone: true
})
export class PatronClasePipe implements PipeTransform {

  transform(value: any[], patron: string): any[] {
    if (value && value.length) {
      return value.filter(a=>a.asignatura.nombre.toLowerCase().includes(patron.toLowerCase()))
    }
    else
    return []
  }

}
