<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ce2e761 (Ajustes loans front y back)
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
<<<<<<< HEAD
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
=======
>>>>>>> ce2e761 (Ajustes loans front y back)

@Component({
  selector: 'app-loans',
  templateUrl: './loans.component.html',
  styleUrls: ['./loans.component.css'],
})
<<<<<<< HEAD
<<<<<<< HEAD
export class LoansComponent implements OnInit {
  search: boolean = false;
<<<<<<< HEAD
  routes: Route[] = [];
  loans: Loan[]=[]
  form: FormGroup;
  selectedRouteItem: Route | undefined
  currentDate: string = "";
=======
  routes: Route[]=[];
>>>>>>> 8369093 (inicio)
=======
export class LoansComponent {
=======
export class LoansComponent implements OnInit {
>>>>>>> ce2e761 (Ajustes loans front y back)
  search: boolean = false;
  routes: Route[] = [];
  loans: Loan[]=[]
  formInicial: FormGroup;
<<<<<<< HEAD
>>>>>>> d8914f2 (ajustes)
=======
  selectedRouteItem: Route | undefined
  currentDate: string = "";
>>>>>>> ce2e761 (Ajustes loans front y back)

  constructor(
    private readonly clientsService: ClientsService,
    private readonly routesService: RoutesService,
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    private readonly loansService: LoansService
  ) {
    this.form = new FormGroup({
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

  getAllLoansByRouteId(id: number){
    this.loansService.getLoansByRouteId(id).subscribe(res=> {
      res.data.forEach(el => {
        const loansDecrypted: Loan={
          id: el.id,
          route: {
            id: el.route?.id
          },
          client: {
            id: el.client?.id,
            name: decrypt(el.client?.name!),
            last_name: decrypt(el.client?.last_name!),
          },
          order: el.order,
          amount: el.amount,
          paymentDays: el.paymentDays,
          paymentType: el.paymentType,
          deposit: el.deposit,
          lastInstallment: el.lastInstallment,
          remainingBalance: el.remainingBalance,
          remainingAmount: el.remainingAmount,
          daysPastDue: el.daysPastDue,
          lastPayment: el.lastPayment,
          startDate: el.startDate,
          finalDate: el.finalDate,
          status: el.status,
          created_by: el.created_by,
          modified_by: el.modified_by,
        }
        this.loans.push(loansDecrypted);
      })
    });
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
=======
    private readonly loansService: LoansService
>>>>>>> ce2e761 (Ajustes loans front y back)
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
<<<<<<< HEAD
=======
>>>>>>> ce2e761 (Ajustes loans front y back)
    this.selectedRouteItem = event.value;
    this.getAllLoansByRouteId(this.selectedRouteItem?.id!);
  }

  dateChanged(event: Date) {
    console.log(new Date(event))
<<<<<<< HEAD
=======
    console.log(event.value)
>>>>>>> d8914f2 (ajustes)
=======
>>>>>>> ce2e761 (Ajustes loans front y back)
  }
}

