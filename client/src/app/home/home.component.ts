import { Component, OnInit } from '@angular/core';
import { FurnitureService } from '../core/furniture.service';
import { Furniture } from '../shared/furniture.model';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.scss'],
})
export class HomeComponent implements OnInit {
  furnitures: Furniture[] = [];
  constructor(private furnitureService: FurnitureService) {}

  ngOnInit() {
    // this.furnitureService
    //   .getFurnitures()
    //   .subscribe((data: Furniture[]) => (this.furnitures = data));
    this.furnitureService
      .createFurniture({
        id: 10,
        name: 'Prueba',
        price: 100,
        rating: 5,
        shortDescription: 'jeje',
        description: 'jejejeje',
        categories: ['Categoria 1', 'Categoria 2'],
        image: '',
      })
      .subscribe(() => console.log("Creado"));
  }
}
