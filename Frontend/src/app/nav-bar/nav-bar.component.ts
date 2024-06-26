import { CommonModule } from '@angular/common';
import { Component, ElementRef, inject, HostListener, DoCheck, ViewChild } from '@angular/core';
import { NavigationEnd, Router, RouterModule, RouterOutlet } from '@angular/router';
import { DomSanitizer } from '@angular/platform-browser';
import { UserService } from '../services/user.service';




@Component({
  selector: 'app-nav-bar',
  standalone: true,
  imports: [RouterOutlet, CommonModule, RouterModule],
  templateUrl: './nav-bar.component.html',
  styleUrl: './nav-bar.component.css'
})
export class NavBarComponent{
  constructor(private sanitizer: DomSanitizer, private router: Router) {
   }
  private userService=inject(UserService)
  public identity: any;
  public token: any;
  public currentRoute: string='';
  isMenuVisible: boolean = false;

  ngOnInit() {
    this.router.events.subscribe(event => {
      if (event instanceof NavigationEnd) {
        this.currentRoute = event.url;
      }
    });
  }

  ngDoCheck(){
    this.loadUser();
  }

  toggleDropdown(): void {
    this.isMenuVisible = !this.isMenuVisible; // Alternar la visibilidad
  }

  isMobileMenuVisible: boolean = false; // Estado inicial del menú móvil, oculto

  toggleMobileMenu(): void {
    this.isMobileMenuVisible = !this.isMobileMenuVisible; // Alternar la visibilidad del menú móvil
  }

  @HostListener('window:resize', ['$event'])
  onResize(event:any) {
    const windowWidth = event.target.innerWidth;

    if (windowWidth >= 650) {
      this.isMobileMenuVisible = false;
    }
  }

  closeMobileMenu(): void {
    this.isMobileMenuVisible = false; // Cierra el menú móvil
  }

  loadUser(){
    this.identity = this.userService.getIdentity();
    this.token = this.userService.getToken();
  }

  menuFalse(): void {
    this.isMenuVisible = false;
  }

  @ViewChild('pattern') patternInput!: ElementRef;

  @HostListener('document:click', ['$event'])
  onClickOutside(event: MouseEvent) {
    if (this.patternInput && !this.patternInput.nativeElement.contains(event.target)) {
      this.isMenuVisible = false;
    }
  }

}
