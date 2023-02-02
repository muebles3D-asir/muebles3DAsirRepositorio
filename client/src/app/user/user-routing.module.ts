import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { UserDetailComponent } from './user-detail/user-detail.component';
import { UserEditComponent } from './user-edit/user-edit.component';
import { UserNewComponent } from './user-new/user-new.component';

const routes: Routes = [
  { path: 'user/:id/new', component: UserDetailComponent },
  { path: 'user/:furnitureId', component: UserDetailComponent },
  { path: 'user/:id/edit', component: UserNewComponent },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class UserRoutingModule { }
