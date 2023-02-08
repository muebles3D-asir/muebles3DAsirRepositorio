import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FurnitureService } from './furniture.service';
import { HttpClientModule } from '@angular/common/http';

// import { InMemoryWebApiModule } from 'angular-in-memory-web-api';
import { FurnitureData } from './furniture-data';

@NgModule({
  declarations: [],
  imports: [
    CommonModule,
    HttpClientModule,
    // InMemoryWebApiModule.forRoot(FurnitureData),
  ],
  providers: [FurnitureService],
})
export class CoreModule { }
