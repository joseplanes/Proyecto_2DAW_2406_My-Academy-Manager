import { ApplicationConfig } from '@angular/core';
import { provideRouter } from '@angular/router';

import { routes } from './app.routes';
import { HttpClientModule, provideHttpClient } from '@angular/common/http';
import { BrowserModule } from '@angular/platform-browser';
import { IdentityGuard } from './services/identity.guard';
import { UserService } from './user.service';


export const appConfig: ApplicationConfig = {
  providers: [provideRouter(routes), provideHttpClient(), BrowserModule, HttpClientModule, IdentityGuard, UserService],
};
