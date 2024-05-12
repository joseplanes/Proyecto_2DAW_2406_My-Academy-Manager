import { ComponentFixture, TestBed } from '@angular/core/testing';

import { RegistroCalificacionesComponent } from './registro-calificaciones.component';

describe('RegistroCalificacionesComponent', () => {
  let component: RegistroCalificacionesComponent;
  let fixture: ComponentFixture<RegistroCalificacionesComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [RegistroCalificacionesComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(RegistroCalificacionesComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
