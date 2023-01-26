import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { FurnitureRoutingModule } from './furniture-routing.module';
import { FurnitureDetailComponent } from './furniture-detail/furniture-detail.component';
import { FurnitureEditComponent } from './furniture-edit/furniture-edit.component';
import { FurnitureItemComponent } from './furniture-item/furniture-item.component';
import { FurnitureNewComponent } from './furniture-new/furniture-new.component';
import { SharedModule } from '../shared/shared.module';


@NgModule({
  declarations: [
    FurnitureDetailComponent,
    FurnitureEditComponent,
    FurnitureItemComponent,
    FurnitureNewComponent
  ],
  imports: [
    CommonModule,
    FurnitureRoutingModule,
    SharedModule
  ]
})
export class FurnitureModule { }
