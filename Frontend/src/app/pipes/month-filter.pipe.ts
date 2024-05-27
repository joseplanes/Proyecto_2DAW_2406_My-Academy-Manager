import { Pipe, PipeTransform } from '@angular/core';

@Pipe({
  name: 'monthFilter',
  standalone: true
})
export class MonthFilterPipe implements PipeTransform {

  transform(jornadas:{ dia: string }[], month: number): any[] {
    if(month==0){
      return jornadas;
    }

    return jornadas.filter(jornada => {
      const dateMonth = parseInt(jornada.dia.substring(5, 7));
      const formattedMonth = ("0" + month).slice(-2);
      return dateMonth === parseInt(formattedMonth);
  });
}

}
