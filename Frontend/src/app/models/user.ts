export class User {
    constructor(
    public id: number,
    public nombre: string,
    public apellidos: string,
    public email: string,
    public password: string,
    public fecha_nacimiento: Date,
    public rol: string,
    public dni: string){}
}