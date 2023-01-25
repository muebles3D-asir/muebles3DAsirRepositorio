import { ComponentFixture, TestBed } from '@angular/core/testing';

import { NewFurnituresComponent } from './new-furnitures.component';

describe('NewFurnituresComponent', () => {
  let component: NewFurnituresComponent;
  let fixture: ComponentFixture<NewFurnituresComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ NewFurnituresComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(NewFurnituresComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
