import { Time } from "@angular/common";

export class Clase {
    constructor(
    public id: number,
    public asignatura_id: number,
    public profesor_id: number,
    public aula_id: number,
    public hora_inicio: Time,
    public hora_fin: Time
    ){}
}