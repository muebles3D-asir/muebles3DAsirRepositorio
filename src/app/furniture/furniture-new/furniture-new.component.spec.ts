import { ComponentFixture, TestBed } from '@angular/core/testing';

import { FurnitureNewComponent } from './furniture-new.component';

describe('FurnitureNewComponent', () => {
  let component: FurnitureNewComponent;
  let fixture: ComponentFixture<FurnitureNewComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ FurnitureNewComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(FurnitureNewComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
