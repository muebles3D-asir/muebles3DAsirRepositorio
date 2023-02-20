import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { CoreModule } from './core/core.module';
import { HomeModule } from './home/home.module';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { FurnitureModule } from './furniture/furniture.module';
import { SharedModule } from './shared/shared.module';
import { HttpClientModule } from "@angular/common/http";
import { LogComponent } from './log/log.component';

@NgModule({
  declarations: [
    AppComponent,
   // LogComponent // TODO: Ver porque no va
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    CoreModule,
    HomeModule,
    FurnitureModule,
    SharedModule,
    HttpClientModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
