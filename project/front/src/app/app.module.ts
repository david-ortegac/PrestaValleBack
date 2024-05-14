import { NgModule, isDevMode } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { HttpClientModule } from '@angular/common/http';
import { ReactiveFormsModule } from '@angular/forms';

import { LoginComponent } from './components/login/login.component';
import { NotFoundComponent } from './components/not-found/not-found.component';
import { HomeComponent } from './components/home/home.component';
import { RegisterComponent } from './components/register/register.component';
import { SidebarComponent } from './components/estructura/sidebar/sidebar.component';
import { FooterComponent } from './components/estructura/footer/footer.component';
import { HeaderComponent } from './components/estructura/header/header.component';

//Prime NG
import { TableModule } from 'primeng/table';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { InputTextModule } from 'primeng/inputtext';
import { PasswordModule } from 'primeng/password';
import { ButtonModule } from 'primeng/button';
import { PaginatorModule } from 'primeng/paginator';
import { ProgressSpinnerModule } from 'primeng/progressspinner';
import { ScrollPanelModule } from 'primeng/scrollpanel';


import { SedesComponent } from './components/sedes/sedes.component';
import { RoutesComponent } from './components/routes/routes.component';
import { EmployeesComponent } from './components/employees/employees.component';
import { ClientsComponent } from './components/clients/clients.component';
import { IonicModule } from '@ionic/angular';
import { ServiceWorkerModule } from '@angular/service-worker';
import { NgxPaginationModule } from 'ngx-pagination';
import { DropdownModule } from 'primeng/dropdown';
import {LoansComponent} from "./components/loans/loans.component";
import {FloatLabelModule} from "primeng/floatlabel";
import {CalendarModule} from "primeng/calendar";
import {PanelModule} from "primeng/panel";


@NgModule({
  declarations: [
    AppComponent,
    LoginComponent,
    NotFoundComponent,
    HomeComponent,
    RegisterComponent,
    SidebarComponent,
    FooterComponent,
    HeaderComponent,
    SedesComponent,
    RoutesComponent,
    EmployeesComponent,
    ClientsComponent,
    LoansComponent
  ],
    imports: [
        BrowserModule,
        AppRoutingModule,
        BrowserAnimationsModule,
        TableModule,
        HttpClientModule,
        InputTextModule,
        PasswordModule,
        DropdownModule,
        ReactiveFormsModule,
        ScrollPanelModule,
        PaginatorModule,
        FloatLabelModule,
        NgxPaginationModule,
        ProgressSpinnerModule,
        ButtonModule,
        IonicModule.forRoot({}),
        ServiceWorkerModule.register('ngsw-worker.js', {
            enabled: !isDevMode(),
            // Register the ServiceWorker as soon as the application is stable
            // or after 30 seconds (whichever comes first).
            registrationStrategy: 'registerWhenStable:30000'
        }),
        CalendarModule,
        PanelModule,
    ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
