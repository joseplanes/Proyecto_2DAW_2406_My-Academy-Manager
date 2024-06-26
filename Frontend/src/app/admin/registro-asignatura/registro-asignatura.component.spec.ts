import { ComponentFixture, TestBed } from '@angular/core/testing';

import { RegistroAsignaturaComponent } from './registro-asignatura.component';

describe('RegistroAsignaturaComponent', () => {
  let component: RegistroAsignaturaComponent;
  let fixture: ComponentFixture<RegistroAsignaturaComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [RegistroAsignaturaComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(RegistroAsignaturaComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
