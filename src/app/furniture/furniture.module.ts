import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { FurnitureRoutingModule } from './furniture-routing.module';
import { NewFurnituresComponent } from './new-furnitures/new-furnitures.component';
import { FurnitureListComponent } from './furniture-list/furniture-list.component';
import { FurnitureDetailComponent } from './furniture-detail/furniture-detail.component';
import { FurnitureEditComponent } from './furniture-edit/furniture-edit.component';
import { FurnitureItemComponent } from './furniture-item/furniture-item.component';
import { FurnitureNewComponent } from './furniture-new/furniture-new.component';


@NgModule({
  declarations: [
    NewFurnituresComponent,
    FurnitureListComponent,
    FurnitureDetailComponent,
    FurnitureEditComponent,
    FurnitureItemComponent,
    FurnitureNewComponent
  ],
  imports: [
    CommonModule,
    FurnitureRoutingModule
  ]
})
export class FurnitureModule { }
