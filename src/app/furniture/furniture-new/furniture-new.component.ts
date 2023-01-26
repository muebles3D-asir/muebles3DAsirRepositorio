import { Component, OnInit } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { Furniture } from '../../shared/furniture.model';
import { ActivatedRoute, Router } from '@angular/router';
import { FurnitureService } from '../../core/furniture.service';

@Component({
  selector: 'app-furniture-new',
  templateUrl: './furniture-new.component.html',
  styleUrls: ['./furniture-new.component.css'],
})
export class FurnitureNewComponent implements OnInit {
  pageTitle = 'Furniture New';
  errorMessage: string = '';
  furnitureForm: any;

  prodId: number = 0;
  furniture: Furniture = {
    id: 0,
    title: '',
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
    private furnitureService: FurnitureService
  ) {}

  ngOnInit(): void {
    this.furnitureForm = this.fb.group({
      title: [
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

    // Read the product Id from the route parameter
    this.prodId = parseInt(this.activatedroute.snapshot.params['productId']);
  }

  saveProduct(): void {
    if (this.furnitureForm.valid) {
      if (this.furnitureForm.dirty) {
        this.furniture = this.furnitureForm.value;
        this.furniture.id = this.prodId;

        this.furnitureService.createFurniture(this.furniture).subscribe(
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
