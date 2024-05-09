<<<<<<< HEAD
import {Component, OnInit} from '@angular/core';
import {ClientsService} from "../../services/clients/clients.service";
import {RoutesService} from "../../services/routes/routes.service";
import {Route} from "../../models/Route";
import {Sede} from "../../models/Sede";
import {SedesService} from "../../services/sedes/sedes.service";
import {decrypt} from "../../utils/util-encrypt";
import {FormControl, FormGroup, Validators} from "@angular/forms";
import {DropdownChangeEvent} from "primeng/dropdown";
import {LoansService} from "../../services/loans/loans.service";
import {Loan} from "../../models/Loan";
=======
import {Component} from '@angular/core';
import {ClientsService} from "../../services/clients/clients.service";
import {RoutesService} from "../../services/routes/routes.service";
import {Route} from "../../models/Route";
<<<<<<< HEAD
>>>>>>> 8369093 (inicio)
=======
import {Sede} from "../../models/Sede";
import {SedesService} from "../../services/sedes/sedes.service";
import {decrypt} from "../../utils/util-encrypt";
import {FormControl, FormGroup, Validators} from "@angular/forms";
import {DropdownChangeEvent} from "primeng/dropdown";
>>>>>>> d8914f2 (ajustes)

@Component({
  selector: 'app-loans',
  templateUrl: './loans.component.html',
  styleUrls: ['./loans.component.css'],
})
<<<<<<< HEAD
export class LoansComponent implements OnInit {
  search: boolean = false;
<<<<<<< HEAD
  routes: Route[] = [];
  loans: Loan[]=[]
  formInicial: FormGroup;
  selectedRouteItem: Route | undefined
  currentDate: string = "";
=======
  routes: Route[]=[];
>>>>>>> 8369093 (inicio)
=======
export class LoansComponent {
  search: boolean = false;
  sedes: Sede[] = []
  routes: Route[] = [];
  formInicial: FormGroup;
>>>>>>> d8914f2 (ajustes)

  constructor(
    private readonly clientsService: ClientsService,
    private readonly routesService: RoutesService,
<<<<<<< HEAD
<<<<<<< HEAD
    private readonly loansService: LoansService
  ) {
    this.formInicial = new FormGroup({
      sede: new FormControl(''),
      name: new FormControl('', [Validators.minLength(3), Validators.required]),
    });
    this.getAllRoutes();
  }

  ngOnInit(): void {
    const today = new Date();
    today.setMonth(today.getMonth() + 1)
    this.currentDate = +today.getMonth() + '/' + today.getDate() + '/' + today.getFullYear();
  }

  getAllLoansByRouteId(){
    this.loansService.getLoansByRouteId(this.selectedRouteItem?.id!).subscribe(res=>{
      this.loans = res;
      console.log(this.loans)
    }, err=>{
      console.log(err)
    })
  }

  getAllRoutes() {
    this.routesService.getAllRoutesWithoutPaged().subscribe(res => {
      res.forEach(el => {
        const routeDecrypt = {
          id: el.id,
          name: decrypt(el.name!),
          sede: {
            id: el.sede?.id,
            name: decrypt(el.sede?.name!)
          }
        }
        this.routes.push(routeDecrypt);
      });
    });
  }
=======
=======
    private readonly sedesService: SedesService,
>>>>>>> d8914f2 (ajustes)
  ) {
    this.formInicial = new FormGroup({
      sede: new FormControl(''),
      name: new FormControl('', [Validators.minLength(3), Validators.required]),
    });
    this.getAllSedes();
    this.getAllRoutes();
  }

  getAllSedes(){
    this.sedesService.getAllSedesWithoutPaginated().subscribe(res=>{
      res.forEach(el=>{
        const sedeDecrypt={
          id: el.id,
          name: decrypt(el.name!)
        };
        this.sedes.push(sedeDecrypt);
      });
    });
  }

  getAllRoutes() {
    this.routesService.getAllRoutesWithoutPaged().subscribe(res => {
      res.forEach(el=> {
        const routeDecrypt={
          id: el.id,
          name: decrypt(el.name!),
          sede: {
            id: el.sede?.id,
            name: decrypt(el.sede?.name!)
          }
        }
        this.routes.push(routeDecrypt);
      });
    });
  }
>>>>>>> 8369093 (inicio)

  openSearchByDocument() {
    this.search = true;
    console.log(this.search);
  }

  closeSearchByDocument() {
    this.search = false;
  }

  selectedRoute(event: DropdownChangeEvent) {
<<<<<<< HEAD
    this.selectedRouteItem = event.value;
    this.getAllLoansByRouteId();
  }

  dateChanged(event: Date) {
    console.log(new Date(event))
=======
    console.log(event.value)
>>>>>>> d8914f2 (ajustes)
  }
}

