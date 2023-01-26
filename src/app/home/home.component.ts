import { Component } from '@angular/core';
import { FurnitureService } from '../core/furniture.service';
import { Furniture } from '../shared/furniture.model';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.scss'],
})
export class HomeComponent {
  furnitures: Furniture[] = [];
  constructor(private furnitureService: FurnitureService) {}

  ngOnInit() {
    this.furnitureService
      .getFurnitures()
      .subscribe((data: Furniture[]) => (this.furnitures = data));
  }
}
