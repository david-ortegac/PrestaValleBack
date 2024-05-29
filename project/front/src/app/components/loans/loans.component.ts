<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ce2e761 (Ajustes loans front y back)
import {Component, OnInit} from '@angular/core';
import {ClientsService} from "../../services/clients/clients.service";
import {RoutesService} from "../../services/routes/routes.service";
import {Route} from "../../models/Route";
import {decrypt, encrypt} from "../../utils/util-encrypt";
import {FormArray, FormBuilder, FormControl, FormGroup, Validators} from "@angular/forms";
import {DropdownChangeEvent} from "primeng/dropdown";
import {LoansService} from "../../services/loans/loans.service";
import {Loan} from "../../models/Loan";
<<<<<<< HEAD
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
=======
import {Client} from "../../models/Client";
>>>>>>> 70fa6c1 (ajustes encriptado)

@Component({
  selector: 'app-loans',
  templateUrl: './loans.component.html',
  styleUrls: ['./loans.component.css'],
})
<<<<<<< HEAD
<<<<<<< HEAD
export class LoansComponent implements OnInit {
<<<<<<< HEAD
  search: boolean = false;
<<<<<<< HEAD
=======
  searchClient: boolean = false;
>>>>>>> bb2ed6c (ajuste formarray para new client)
  routes: Route[] = [];
  loans: Loan[] = []
  form: FormGroup;
  selectedRouteItem: Route | undefined;
  currentDate: string = "";
<<<<<<< HEAD
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
=======
  selectedDate: Date = new Date();
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> 7bac5d3 (ajustes loans formarray)
=======
  myGroup: FormGroup;
>>>>>>> 92061b0 (ajustes varios loans front y back loans.component.ts)
=======
  formSearchClient: FormGroup;
  myGroup: FormGroup;
  client: Client | undefined
<<<<<<< HEAD
>>>>>>> 70fa6c1 (ajustes encriptado)
=======
  loadingClientByDocumentNumber: boolean = false;
  loadingDataToFillFormArray: boolean = false;
  routeSelected: boolean = false;
>>>>>>> bb2ed6c (ajuste formarray para new client)

  constructor(
    private readonly clientsService: ClientsService,
    private readonly routesService: RoutesService,
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    private readonly loansService: LoansService
=======
    private readonly loansService: LoansService,
    private fb: FormBuilder
>>>>>>> 7bac5d3 (ajustes loans formarray)
  ) {
    this.formSearchClient = new FormGroup({
      clientDocument: new FormControl('', [Validators.min(3), Validators.required]),
    })
    this.form = new FormGroup({
      loansFormArray: new FormArray([])
    });
    this.myGroup = this.fb.group({
      selectedRouteItem: new FormControl('')
    });
  }

  get loansFormArray() {
    return this.form.get('loansFormArray') as FormArray;
  }

  itemLoan() {
    let nro;
    if (this.loansFormArray.length > 0) {
      nro = this.loansFormArray.length + 1;
    } else {
      nro = 1;
    }

    return this.fb.group({
      nro: new FormControl(nro, [Validators.required]),
      clientId: new FormControl(this.client?.id),
      nombres: new FormControl(this.client?.name + ' ' + this.client?.last_name, [Validators.required]),
      monto: new FormControl(0, [Validators.required]),
      cobroDiario: new FormControl(0, [Validators.required]),
      diasCredito: new FormControl(0, [Validators.required]),
      valorAbono: new FormControl(0, [Validators.required]),
      pico: new FormControl(0, [Validators.required]),
      fechaPago: new FormControl(new Date(), [Validators.required]),
      diasMora: new FormControl(0, [Validators.required]),
      saldo: new FormControl(0, [Validators.required]),
      cuotas: new FormControl(0, [Validators.required]),
      status: new FormControl(true, [Validators.required]),
    });
  }

  addLoans() {
    this.loansFormArray.push(this.itemLoan());
    if (this.loansFormArray.length > 0) {
      this.loansFormArray.at(this.loansFormArray.length - 1).get('nombres')?.disable()
      this.loansFormArray.at(this.loansFormArray.length - 1).get('status')?.disable()
      this.loansFormArray.at(this.loansFormArray.length - 1).get('pico')?.disable()
      this.loansFormArray.at(this.loansFormArray.length - 1).get('diasMora')?.disable()
      this.loansFormArray.at(this.loansFormArray.length - 1).get('saldo')?.disable()
      this.loansFormArray.at(this.loansFormArray.length - 1).get('cuotas')?.disable()
    } else {
      this.loansFormArray.at(0).get('nombres')?.disable()
      this.loansFormArray.at(0).get('status')?.disable()
      this.loansFormArray.at(0).get('pico')?.disable()
      this.loansFormArray.at(0).get('diasMora')?.disable()
      this.loansFormArray.at(0).get('saldo')?.disable()
      this.loansFormArray.at(0).get('cuotas')?.disable()
    }
  }

  deleteLoans(indexLoan: number) {
    this.loansFormArray.removeAt(indexLoan);
  }

  onSubmit() {
    console.log(this.loansFormArray.value);
  }

  ngOnInit(): void {
    const today = new Date();
    today.setMonth(today.getMonth() + 1)
    this.currentDate = today.getMonth() + '/' + today.getDate() + '/' + today.getFullYear();
    this.getAllRoutes();
  }

  openSearchByDocument() {
    this.loadingClientByDocumentNumber = true;
    this.clientsService.getClientByDocumentNumber(encrypt(String(this.formSearchClient.get('clientDocument')?.value))).subscribe(res => {
      const newClinet: Client = {
        id: res.id,
        name: decrypt(res.name!),
        last_name: decrypt(res.last_name!),
      }
      console.log(newClinet)
      this.client = newClinet;
      this.searchClient = true
      this.loadingClientByDocumentNumber = false
    })
  }

  closeSearchByDocument() {
    this.searchClient = false;
  }

  dateChanged(event: Date) {
    this.selectedDate = event;
  }

  getAllRoutes() {
    this.routesService.getAllRoutesWithoutPaged().subscribe(res => {
      res.forEach(el => {
        const routeDecrypt: Route = {
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

  selectedRoute(event: DropdownChangeEvent) {
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ce2e761 (Ajustes loans front y back)
    this.selectedRouteItem = event.value;
    this.getAllLoansByRouteId(this.selectedRouteItem?.id);
    console.log(event);
  }

  dateChanged(event: Date) {
<<<<<<< HEAD
    console.log(new Date(event))
<<<<<<< HEAD
=======
    console.log(event.value)
>>>>>>> d8914f2 (ajustes)
=======
>>>>>>> ce2e761 (Ajustes loans front y back)
=======
    this.selectedDate = event;
>>>>>>> 7bac5d3 (ajustes loans formarray)
=======
    this.loansFormArray.clear()
    this.loans = [];

    if (event.value != null) {
      this.selectedRouteItem = event.value as Route;
      this.getAllLoansByRouteId(event.value.id!);
    }

    this.routeSelected = true;
  }

  getAllLoansByRouteId(id: number) {
    this.loadingDataToFillFormArray = true;
    this.loansService.getLoansByRouteId(id).subscribe(res => {
      console.log(res.data)
      res.data.forEach(el => {
        let status: boolean = el.status == true;
        const loansFromBack: FormGroup = this.fb.group({
          nro: new FormControl(el.order),
          clientId: el.client?.id,
          nombres: new FormControl(decrypt(el.client?.name!) + " " + decrypt(el.client?.last_name!)),
          monto: new FormControl(el.amount),
          cobroDiario: new FormControl(el.dailyPayment),
          diasCredito: new FormControl(el.daysToPay),
          valorAbono: new FormControl(el.deposit),
          pico: new FormControl(el.pico),
          fechaPago: new FormControl(this.selectedDate),
          diasMora: new FormControl(el.daysPastDue),
          saldo: new FormControl(el.balance),
          cuotas: new FormControl(el.dues),
          status: new FormControl(status),
        })

        loansFromBack.controls['nombres'].disable();
        loansFromBack.controls['monto'].disable();
        loansFromBack.controls['cobroDiario'].disable();
        loansFromBack.controls['diasCredito'].disable();
        loansFromBack.controls['pico'].disable();
        loansFromBack.controls['fechaPago'].disable();
        loansFromBack.controls['diasMora'].disable();
        loansFromBack.controls['saldo'].disable();
        loansFromBack.controls['cuotas'].disable();
        loansFromBack.controls['status'].disable();
        if (loansFromBack.controls['status'].value == 0) {
          loansFromBack.controls['nro'].disable();
          loansFromBack.controls['valorAbono'].disable();
        }

        this.loansFormArray.push(loansFromBack);
      })
      this.loadingDataToFillFormArray = false;
    });
  }


  reencauche(index: number) {
    this.loansFormArray.at(index).get('monto')?.enable();
    this.loansFormArray.at(index).get('cobroDiario')?.enable();
    this.loansFormArray.at(index).get('diasCredito')?.enable();
    this.loansFormArray.at(index).get('nro')?.enable();
    this.loansFormArray.at(index).get('valorAbono')?.enable();
>>>>>>> 8df4154 (ajustes loans front)
  }

}

