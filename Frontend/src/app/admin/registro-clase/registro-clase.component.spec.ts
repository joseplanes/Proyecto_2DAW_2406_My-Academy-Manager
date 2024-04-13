import { ComponentFixture, TestBed } from '@angular/core/testing';

import { RegistroclaseComponent } from './registro-clase.component';

describe('RegistroclaseComponent', () => {
  let component: RegistroclaseComponent;
  let fixture: ComponentFixture<RegistroclaseComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [RegistroclaseComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(RegistroclaseComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
