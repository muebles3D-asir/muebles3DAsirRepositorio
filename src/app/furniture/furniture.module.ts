import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { FurnitureRoutingModule } from './furniture-routing.module';
import { FurnitureItemComponent } from './furniture-item/furniture-item.component';
import { SharedModule } from '../shared/shared.module';
import { FurnitureNewComponent } from './furniture-new/furniture-new.component';
import { FurnitureEditComponent } from './furniture-edit/furniture-edit.component';
import { FurnitureDetailComponent } from './furniture-detail/furniture-detail.component';


@NgModule({
  declarations: [
    FurnitureNewComponent,
    FurnitureItemComponent,
    FurnitureEditComponent,
    FurnitureDetailComponent,
  ],
  imports: [CommonModule, FurnitureRoutingModule, SharedModule],
  exports: [FurnitureItemComponent],
})
export class FurnitureModule { }
