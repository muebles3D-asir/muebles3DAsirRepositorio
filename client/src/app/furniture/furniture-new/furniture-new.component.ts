import { Component, OnInit } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { Furniture } from '../../shared/furniture.model';
import { ActivatedRoute, Router } from '@angular/router';
import { FurnitureService } from '../../core/furniture.service';
import { Category } from 'src/app/shared/category.model';

@Component({
  selector: 'app-furniture-new',
  templateUrl: './furniture-new.component.html',
  styleUrls: ['./furniture-new.component.scss'],
})
export class FurnitureNewComponent implements OnInit {
  pageTitle = 'Furniture New';
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
    filamento: '',
    color: '',
    material: '',
    tamaño: 0    
  };

  constructor(
    private fb: FormBuilder,
    private activatedroute: ActivatedRoute,
    private router: Router,
    private furnitureService: FurnitureService
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
      categories:[''],
      rating: 0,
      price: 0.0,
      description: '',
      shortDescription: '',
      image: '',
      filamento: '',
      color: '',
      material: '',
      tamaño: 0    
    });

    // Read the furniture Id from the route parameter
    this.furnitureId = parseInt(this.activatedroute.snapshot.params['furnitureId']);
  }

  saveFurniture(): void {
    if (this.furnitureForm.valid) {
      if (this.furnitureForm.dirty) {
       let tmp = this.furnitureForm.value;
       this.furniture.name = tmp.name;
       this.furniture.price = +tmp.price;
       this.furniture.rating = +tmp.rating;
       this.furniture.shortDescription = tmp.shortDescription;
       this.furniture.description = tmp.description;
       this.furniture.categories = tmp.categories.split(',');
       this.furniture.image = tmp.image;
       this.furniture.color = tmp.color;
       this.furniture.material = tmp.material;
       this.furniture.tamaño = tmp.tamaño;


        console.log(this.furniture);
        this.furniture.id = this.furnitureId;

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
