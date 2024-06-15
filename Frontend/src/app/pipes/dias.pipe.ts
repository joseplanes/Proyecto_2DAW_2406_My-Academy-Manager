import { Pipe, PipeTransform } from '@angular/core';

@Pipe({
  name: 'dias',
  standalone: true
})
export class DiasPipe implements PipeTransform {

  transform(values: {id: number}[]): string {
    const days = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
    const result = values
      .map(value => days[value.id - 1])
      .filter(day => day !== undefined);

    return result.length > 0 ? result.join(', ') : 'Valor no válido';
  }

}
