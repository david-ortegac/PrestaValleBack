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
>>>>>>> 8369093 (inicio)

@Component({
  selector: 'app-loans',
  templateUrl: './loans.component.html',
  styleUrls: ['./loans.component.css'],
})
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

  constructor(
    private readonly clientsService: ClientsService,
    private readonly routesService: RoutesService,
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
  ) {
    this.routesService.getAllRoutesWithoutPaged().subscribe(res=>{
      console.log(res)
      this.routes = res;
    })
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
    this.selectedRouteItem = event.value;
    this.getAllLoansByRouteId();
  }

  dateChanged(event: Date) {
    console.log(new Date(event))
  }
}

