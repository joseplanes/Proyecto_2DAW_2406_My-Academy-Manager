import { Component, inject } from '@angular/core';
import { User } from '../models/user';
import { UserService } from '../services/user.service';
import { FormsModule } from '@angular/forms';
import { Router, ActivatedRoute, Params } from '@angular/router';

@Component({
  selector: 'app-login',
  standalone: true,
  imports: [FormsModule],
  templateUrl: './login.component.html',
  styleUrl: './login.component.css'
})
export class LoginComponent {
  private userService=inject(UserService);
  public user: User;
  public identity: any;
  public status:string='';
  public token: any;

  constructor(private _router: Router, private _route: ActivatedRoute) {
    this.user = new User(1, '', '', '', '', new Date(), '', '');
    this.status = '';
    this.token = '';

  }
  ngOnInit(){
    this.logout();

  }
  onSubmit(loginForm: any) {
     this.userService.login(this.user).subscribe(
      (response:any ) => {
        if (!response.status || response.status != 'error') {
          this.status = 'success';
          this.identity = response;

          //Sacar TOKEN
          this.userService.login(this.user, true).subscribe(
            (response:any ) => {
              if (!response.status || response.status != 'error') {
                this.token = response;

                console.log(this.identity)
                console.log(this.token)

                //Persistir datos del usuario
                localStorage.setItem('token', this.token);
                localStorage.setItem('identity', JSON.stringify(this.identity));

                this._router.navigate(['/inicio']);

              } else {
                this.status = 'error';
              }
            },
            error => {
              this.status = 'error';
              console.log(error);
            }
          );

        } else {
          this.status = 'error';
        }
      },
      error => {
        this.status = 'error';
        console.log(error);
      }
    );



  }

  logout() {
    this._route.params.subscribe(params => {
      let logout = +params['sure'];

      if (logout == 1) {
        localStorage.removeItem('identity');
        localStorage.removeItem('token');

        this.identity = null;
        this.token = null;

        this._router.navigate(['/login']);
      }
    });
  }

}
