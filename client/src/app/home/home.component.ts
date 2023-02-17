import { Component, OnInit } from '@angular/core';
import { FurnitureService } from '../core/furniture.service';
import { Furniture } from '../shared/furniture.model';
import { UserService } from '../core/user.service';
import { User } from '../shared/user.model';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.scss'],
})
export class HomeComponent implements OnInit {
  furnitures: Furniture[] = [];
  users: User[] = [];
  constructor(private userService: UserService, private furnitureService: FurnitureService) {}
 

  ngOnInit() {
    this.furnitureService
      .getFurnitures()
      .subscribe((data: Furniture[]) => (this.furnitures = data));
  }
}
