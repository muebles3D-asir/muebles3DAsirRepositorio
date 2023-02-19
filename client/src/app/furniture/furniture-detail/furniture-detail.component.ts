import { Component, OnInit } from '@angular/core';
import { Furniture } from '../../shared/furniture.model';
import { ActivatedRoute, Router } from '@angular/router';
import { FurnitureService } from 'src/app/core/furniture.service';

@Component({
  selector: 'app-furniture-detail',
  templateUrl: './furniture-detail.component.html',
  styleUrls: ['./furniture-detail.component.scss']
})
export class FurnitureDetailComponent implements OnInit {
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
  furnitureId: number = 0;
  categoriesList: string = "";
  

  constructor(
    private activatedroute: ActivatedRoute,
    private router: Router,
    private furnitureService: FurnitureService
  ) {}

  ngOnInit() {
    this.furnitureId = parseInt(this.activatedroute.snapshot.params['furnitureId']);
    this.furnitureService
      .getFurnitureById(this.furnitureId)
      .subscribe((data: Furniture) => {
        this.furniture = data;
        this.categoriesList = this.furniture.categories.toString();
      });
  }
  goEdit(): void {
    this.router.navigate(['/furniture', this.furnitureId, 'edit']);
  }
  onBack(): void {
    this.router.navigate(['']);
  }

}
