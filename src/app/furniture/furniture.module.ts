import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { FurnitureRoutingModule } from './furniture-routing.module';
import { NewFurnituresComponent } from './new-furnitures/new-furnitures.component';


@NgModule({
  declarations: [
    NewFurnituresComponent
  ],
  imports: [
    CommonModule,
    FurnitureRoutingModule
  ]
})
export class FurnitureModule { }
