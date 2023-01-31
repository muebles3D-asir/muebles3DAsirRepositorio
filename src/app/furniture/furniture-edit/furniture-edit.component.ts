import {
  Component,
  OnInit,
  AfterViewInit,
  OnDestroy,
  ViewChildren,
  ElementRef,
} from '@angular/core';

import {
  FormBuilder,
  FormGroup,
  FormControl,
  FormArray,
  Validators,
  FormControlName,
} from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';

import { Furniture } from '../../shared/furniture.model';
import { FurnitureService } from '../../core/furniture.service';

@Component({
  selector: 'app-furniture-edit',
  templateUrl: './furniture-edit.component.html',
  styleUrls: ['./furniture-edit.component.scss']
})
export class FurnitureEditComponent implements OnInit {
  pageName = 'Furniture Edit';
  errorMessage: string = '';
  furnitureForm: any;

  furnitureId: number = 0;
  furniture: Furniture = {
    id: 0,
    name: '',
    price: 0,
    rating: 0,
    shortDescription: '',
    description: '',
    categories: [''],
    image: '',


};
constructor(
  private fb: FormBuilder,
  private activatedroute: ActivatedRoute,
  private router: Router,
  private furnitureservice: FurnitureService
) {}

ngOnInit(): void {
  this.furnitureForm = this.fb.group({
    name: [
      '',
      [
        Validators.required,
        Validators.minLength(3),
        Validators.maxLength(50),
      ],
    ],
    categories: '',
    rating: '',
    price: '',
    description: '',
    shortDescription: '',
    image: '',
  });


  this.furnitureId = parseInt(this.activatedroute.snapshot.params['id']);
  this.getFurniture(this.furnitureId);
}

getFurniture(id: number): void {
  this.furnitureservice.getFurnitureById(id).subscribe(
    (furniture: Furniture) => this.displayFurniture(furniture),
    (error: any) => (this.errorMessage = <any>error)
  );
}

displayFurniture(furniture: Furniture): void {
  if (this.furnitureForm) {
    this.furnitureForm.reset();
  }
  this.furniture = furniture;
  this.pageName = `Edit Furniture: ${this.furniture.name}`;

  // Update the data on the form
  this.furnitureForm.patchValue({
    name: this.furniture.name,
    price: this.furniture.price,
    rating: this.furniture.rating,
    description: this.furniture.description,
    shortDescription: this.furniture.shortDescription,
    categories: this.furniture.categories,
    image: this.furniture.image,
  });
}

deleteFurniture(): void {
  if (this.furniture.id === 0) {
    // Don't delete, it was never saved.
    this.onSaveComplete();
  } else {
    if (confirm(`Really delete the furniture: ${this.furniture.name}?`)) {
      this.furnitureservice.deleteFurniture(this.furniture.id).subscribe(
        () => this.onSaveComplete(),
        (error: any) => (this.errorMessage = <any>error)
      );
    }
  }
}

saveFurniture(): void {
  if (this.furnitureForm.valid) {
    if (this.furnitureForm.dirty) {
      this.furniture = this.furnitureForm.value;
      this.furniture.id = this.furnitureId;

      this.furnitureservice.updateFurniture(this.furniture).subscribe(
        () => this.onSaveComplete(),
        (error: any) => (this.errorMessage = <any>error)
      );
    } else {
      this.onSaveComplete();
    }
  } else {
    this.errorMessage = 'Please correct the validation errors.';
  }
}

onSaveComplete(): void {
  // Reset the form to clear the flags
  this.furnitureForm.reset();
  this.router.navigate(['']);
}
}
