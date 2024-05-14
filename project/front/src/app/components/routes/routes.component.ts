import { Component } from '@angular/core';
import { Route } from './../../models/Route';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { RoutesService } from 'src/app/services/routes/routes.service';
import { decrypt, encrypt } from 'src/app/utils/util-encrypt';
import { SedesService } from 'src/app/services/sedes/sedes.service';
import { Sede } from 'src/app/models/Sede';

@Component({
  selector: 'app-routes',
  templateUrl: './routes.component.html',
  styleUrls: ['./routes.component.css']
})
export class RoutesComponent {

  routes: Route[] = [];
  sedes: Sede[]=[];
  openSaveUpdate: boolean = false;
  form: FormGroup;
  first: number = 0;
  row: number = 20;
  last: number = 0;
  totalRecords: number = 0;
  loading: boolean = false;
  updateButtom: boolean = false;
  letUpdateRoute: Route = {}

  constructor(
    private readonly routesService: RoutesService,
    private readonly sedesService: SedesService,
  ) {
    this.loading = true;
    this.getAllSedes();
    this.getAllRoutes(0);
    this.form = new FormGroup({
      sede: new FormControl(''),
      name: new FormControl('', [Validators.minLength(3), Validators.required]),
    });
  }

  getAllSedes(){
    this.sedesService.getAllSedesWithoutPaginated().subscribe(res=>{
      res.forEach(el=>{
        const sedeDecrypt={
          id: el.id,
          name: decrypt(el.name!)
        }
        this.sedes.push(sedeDecrypt);
      });
    });
  }

  getAllRoutes(page: number) {
    this.loading = true;
    this.routes = [];
    this.routesService.getAllRoutes(page || 0).subscribe(res => {
      console.log(res)
      res.data.forEach(el => {
        const routeDecrypt = {
          id: el.id,
          sede:{
            id:el.sede?.id,
            name: decrypt(el.sede?.name!)
          },
          name: decrypt(el.name!),
          created_at: el.created_at,
          updated_at: el.updated_at,
          created_by: el.created_by,
          modified_by: el.modified_by
        }
        console.log(el)
        this.routes.push(routeDecrypt)
      });
      this.first = res.from;
      this.last = res.last_page;
      this.totalRecords = res.total
    });
    this.loading = false;
  }

  createNewRoute() {
    const route: Route = {
      sede: this.form.get('sede')?.value,
      name: encrypt(this.form.get('name')?.value)
    }
    this.routesService.createRoute(route).subscribe(() => {
      this.loading = true;
      this.getAllRoutes(0);
      this.openSaveUpdate = false;
      this.form.reset();
    })
    this.loading = false;

  }

  update() {
    this.letUpdateRoute.name = encrypt(this.form.get('name')?.value);
    this.letUpdateRoute.sede = this.form.get('sede')?.value

    this.routesService.updateRoute(this.letUpdateRoute).subscribe(() => {
      this.loading = true;
      this.getAllRoutes(0);
      this.updateButtom = false;
      this.openSaveUpdate = false;
      this.form.reset();
    });
    this.loading = false;
  }

  updateRoute(route: Route) {
    this.openSaveUpdate = true;
    this.updateButtom = true;
    this.form.get('name')?.setValue(route.name);
    this.form.get('sede')?.setValue(route.sede);
    this.updateButtom = true;
    this.letUpdateRoute = route;
  }

  openCreateRoute() {
    this.openSaveUpdate = true
  }

  closeCreateRoute() {
    this.openSaveUpdate = false;
  }

  onPageChange($event: any) {
    console.log($event.page + 1);
    const page = $event.page + 1;
    this.getAllRoutes(page)
  }

}
