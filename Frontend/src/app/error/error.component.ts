import { CommonModule } from '@angular/common';
import { Component, inject, HostListener, DoCheck } from '@angular/core';
import { NavigationEnd, Router, RouterModule, RouterOutlet } from '@angular/router';
import { DomSanitizer } from '@angular/platform-browser';
import { UserService } from '../services/user.service';

@Component({
  selector: 'app-error',
  standalone: true,
  imports: [RouterOutlet, CommonModule, RouterModule],
  templateUrl: './error.component.html',
  styleUrl: './error.component.css'
})
export class ErrorComponent {


  constructor(private sanitizer: DomSanitizer, private router: Router) { }
  private userService=inject(UserService)
  public identity: any;
  public token: any;
  public currentRoute: string='';



  ngDoCheck(){
    this.loadUser();
  }


  loadUser(){
    this.identity = this.userService.getIdentity();
    this.token = this.userService.getToken();
  }


}
