import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { FurnitureService } from 'src/app/core/furniture.service';

@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.scss']
})
export class NavbarComponent {
 id: any;

  constructor(private furnitureService: FurnitureService, private router: Router) {}

  ngOnInit() {}

  newFurniture() {
    // Get max product Id from the product list
    this.furnitureService.getMaxFurnitureId().subscribe((data: any) => (this.id = data));
    this.router.navigate(['/furniture', this.id, 'new']);
  }
}
