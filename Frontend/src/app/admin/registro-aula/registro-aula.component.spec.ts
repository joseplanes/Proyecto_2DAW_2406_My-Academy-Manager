import { ComponentFixture, TestBed } from '@angular/core/testing';

import { RegistroAulaComponent } from './registro-aula.component';

describe('RegistroAulaComponent', () => {
  let component: RegistroAulaComponent;
  let fixture: ComponentFixture<RegistroAulaComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [RegistroAulaComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(RegistroAulaComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
