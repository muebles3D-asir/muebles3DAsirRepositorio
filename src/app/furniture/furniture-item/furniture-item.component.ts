import { Component, Input } from '@angular/core';
import { Furniture } from 'src/app/shared/furniture.model';

@Component({
  selector: 'app-furniture-item',
  templateUrl: './furniture-item.component.html',
  styleUrls: ['./furniture-item.component.scss'],
})
export class FurnitureItemComponent {
  @Input() furniture: Furniture = {
    id: 0,
    name: '',
    price: 0,
    rating: 0,
    shortDescription: '',
    description: '',
    categories: [''],
    image: '',
  };
}
