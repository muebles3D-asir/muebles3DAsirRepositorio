import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { FurnitureDetailComponent } from './furniture-detail/furniture-detail.component';
import { FurnitureEditComponent } from './furniture-edit/furniture-edit.component';
import { FurnitureNewComponent } from './furniture-new/furniture-new.component';

const routes: Routes = [
  { path: 'furniture/:id/new', component: FurnitureNewComponent },
  { path: 'furniture/:furnitureId', component: FurnitureDetailComponent },
  { path: 'furniture/:id/edit', component: FurnitureEditComponent },
  
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class FurnitureRoutingModule {}
