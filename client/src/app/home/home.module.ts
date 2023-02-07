import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { HomeRoutingModule } from './home-routing.module';
import { HomeComponent } from './home.component';
import { FurnitureModule } from '../furniture/furniture.module';
import { HttpClient, HttpClientModule } from '@angular/common/http';

@NgModule({
    declarations: [HomeComponent],
    imports: [CommonModule, HomeRoutingModule, FurnitureModule, HttpClientModule],
})
export class HomeModule {}
