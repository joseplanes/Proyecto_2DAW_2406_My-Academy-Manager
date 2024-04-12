import { Pipe, PipeTransform } from '@angular/core';

@Pipe({
  name: 'hora',
  standalone: true
})
export class HoraPipe implements PipeTransform {

  transform(fechaString: string): string {
    const fecha = new Date(fechaString);
    const hora = fecha.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
    return hora;
  }

}
