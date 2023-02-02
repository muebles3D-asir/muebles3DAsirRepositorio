import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { UserRoutingModule } from './user-routing.module';
import { UseDetailComponent } from './use-detail/use-detail.component';
import { UserDetailComponent } from './user-detail/user-detail.component';
import { UserEditComponent } from './user-edit/user-edit.component';
import { UserItemComponent } from './user-item/user-item.component';
import { UserNewComponent } from './user-new/user-new.component';


@NgModule({
  declarations: [
    UseDetailComponent,
    UserDetailComponent,
    UserEditComponent,
    UserItemComponent,
    UserNewComponent
  ],
  imports: [
    CommonModule,
    UserRoutingModule
  ]
})
export class UserModule { }
