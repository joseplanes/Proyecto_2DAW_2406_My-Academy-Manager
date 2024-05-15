import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ListaModalComponent } from './lista-modal.component';

describe('ListaModalComponent', () => {
  let component: ListaModalComponent;
  let fixture: ComponentFixture<ListaModalComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [ListaModalComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(ListaModalComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
