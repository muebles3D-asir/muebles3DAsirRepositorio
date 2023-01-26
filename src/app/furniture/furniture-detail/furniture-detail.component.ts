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
  product: Furniture = {
    id: 0,
    title: '',
    price: 0,
    rating: 0,
    shortDescription: '',
    description: '',
    categories: [''],
    image: '',
  };
  prodId: number = 0;

  constructor(
    private activatedroute: ActivatedRoute,
    private router: Router,
    private furnitureService: FurnitureService
  ) {}

  ngOnInit() {
    this.prodId = parseInt(this.activatedroute.snapshot.params['productId']);
    this.furnitureService
      .getFurnitureById(this.prodId)
      .subscribe((data: Furniture) => (this.product = data));
  }
  goEdit(): void {
    this.router.navigate(['/products', this.prodId, 'edit']);
  }
  onBack(): void {
    this.router.navigate(['']);
  }

}
