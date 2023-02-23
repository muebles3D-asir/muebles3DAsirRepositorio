import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FurnitureService } from './furniture.service';
import { HttpClientModule } from '@angular/common/http';

// import { InMemoryWebApiModule } from 'angular-in-memory-web-api';
import { FurnitureData } from './furniture-data';
import { AuthService } from './auth.service';
import { AuthGuard } from './auth.guard';

@NgModule({
  declarations: [],
  imports: [
    CommonModule,
    HttpClientModule,
    // InMemoryWebApiModule.forRoot(FurnitureData),
  ],
  providers: [FurnitureService, AuthService, AuthGuard],
})
export class CoreModule {}
