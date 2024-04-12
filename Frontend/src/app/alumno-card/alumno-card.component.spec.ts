import { ComponentFixture, TestBed } from '@angular/core/testing';

import { AlumnoCardComponent } from './alumno-card.component';

describe('AlumnoCardComponent', () => {
  let component: AlumnoCardComponent;
  let fixture: ComponentFixture<AlumnoCardComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [AlumnoCardComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(AlumnoCardComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
