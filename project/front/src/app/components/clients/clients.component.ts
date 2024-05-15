import {Client} from '../../models/Client';
import {Component} from '@angular/core';
import {FormBuilder, FormControl, FormGroup, Validators} from '@angular/forms';
import {ClientsService} from 'src/app/services/clients/clients.service';
import {decrypt, encrypt} from 'src/app/utils/util-encrypt';

interface documentType {
  name: string,
  code: string
}

@Component({
  selector: 'app-clients',
  templateUrl: './clients.component.html',
  styleUrls: ['./clients.component.css']
})
export class ClientsComponent {

  documentTypes: documentType[] = [];
  clients: Client[] = [];
  openSaveUpdate: boolean = false;
  form: FormGroup;
  first: number = 0;
  row: number = 20;
  last: number = 0;
  totalRecords: number = 0;
  loading: boolean = false;
  updateButtom: boolean = false;
  letUpdateClient: Client = {}

  constructor(
    private clientsService: ClientsService,
    private fb: FormBuilder
  ) {
    this.form = this.fb.group({
      document_type: new FormControl('', [Validators.required]),
      document_number: new FormControl('', [Validators.pattern("^[0-9]*$"), Validators.minLength(3), Validators.required]),
      name: new FormControl('', [Validators.minLength(3), Validators.required]),
      last_name: new FormControl('', [Validators.minLength(3), Validators.required]),
      phone: new FormControl('', [Validators.minLength(3), Validators.required]),
      neighborhood: new FormControl('', [Validators.minLength(3), Validators.required]),
      address: new FormControl('', [Validators.minLength(3), Validators.required]),
      city: new FormControl('', [Validators.minLength(3), Validators.required]),
      profession: new FormControl('', [Validators.minLength(3), Validators.required]),
      notes: new FormControl(''),
      type: new FormControl(''),
    });
    this.createDocumentTypes();
    this.loading = true;
    this.getAllClients(0);
  }


  getAllClients(page: number) {
    this.loading = true;
    this.clients = [];
    this.clientsService.getAllClients(page || 0).subscribe(res => {
      this.loading = false;
      res.data.forEach(el => {
        const clientDecrypt = {
          id: el.id,
          document_type: el.document_type,
          document_number: decrypt(el.document_number!),
          name: decrypt(el.name!),
          last_name: decrypt(el.last_name!),
          phone: decrypt(el.phone!),
          neighborhood: decrypt(el.neighborhood!),
          address: decrypt(el.address!),
          city: decrypt(el.city!),
          profession: decrypt(el.profession!),
          notes: decrypt(el.notes!),
          type: decrypt(el.type!),
          created_by: el.created_by,
          modified_by: el.modified_by,
          created_at: el.created_at,
          updated_at: el.updated_at
        }
        this.clients.push(clientDecrypt)
      });
      this.first = res.from;
      this.last = res.last_page;
      this.totalRecords = res.total
    });
    this.loading = false;
  }

  createNewClient() {
    this.loading = true;
    const docType: documentType = this.form.get('document_type')?.value
    const newClient: Client = {
      document_type: docType.name,
      document_number: encrypt(this.form.get('document_number')?.value),
      name: encrypt(this.form.get('name')?.value),
      last_name: encrypt(this.form.get('last_name')?.value),
      phone: encrypt(this.form.get('phone')?.value),
      neighborhood: encrypt(this.form.get('neighborhood')?.value),
      address: encrypt(this.form.get('address')?.value),
      city: encrypt(this.form.get('city')?.value),
      profession: encrypt(this.form.get('profession')?.value),
      notes: encrypt(this.form.get('notes')?.value),
      type: encrypt(this.form.get('type')?.value)
    };
    console.log(this.form.get('document_type')?.value);
    this.clientsService.createClient(newClient).subscribe(res => {
      console.log(res.data);
      this.getAllClients(0);
      this.openSaveUpdate = false;
      this.form.reset();
    }, error => {
      console.log(error)
    })

    this.loading = false;
  }

  update() {
    const docType: documentType = this.form.get('document_type')?.value
    this.letUpdateClient.document_type = docType.name;
    this.letUpdateClient.document_number = encrypt(this.form.get('document_number')?.value);
    this.letUpdateClient.name = encrypt(this.form.get('name')?.value);
    this.letUpdateClient.last_name = encrypt(this.form.get('last_name')?.value);
    this.letUpdateClient.phone = encrypt(this.form.get('phone')?.value);
    this.letUpdateClient.neighborhood = encrypt(this.form.get('neighborhood')?.value);
    this.letUpdateClient.address = encrypt(this.form.get('address')?.value);
    this.letUpdateClient.city = encrypt(this.form.get('city')?.value);
    this.letUpdateClient.profession = encrypt(this.form.get('profession')?.value);
    this.letUpdateClient.notes = encrypt(this.form.get('notes')?.value);
    this.letUpdateClient.type = encrypt(this.form.get('type')?.value);
    console.log(this.letUpdateClient)
    this.clientsService.updateClient(this.letUpdateClient).subscribe(() => {
      this.loading = true;
      this.getAllClients(0);
      this.updateButtom = false;
      this.openSaveUpdate = false;
      this.form.reset();
    },);
    this.loading = false;
  }

  updateClient(client: Client) {
    this.openSaveUpdate = true;
    this.updateButtom = true;
    const docType: documentType = {
      name: client.document_type!,
      code: client.document_type!
    }
    this.form.get('document_type')?.setValue(docType);
    this.form.get('document_number')?.setValue(client.document_number);
    this.form.get('name')?.setValue(client.name);
    this.form.get('last_name')?.setValue(client.last_name);
    this.form.get('phone')?.setValue(client.phone);
    this.form.get('neighborhood')?.setValue(client.neighborhood);
    this.form.get('address')?.setValue(client.address);
    this.form.get('city')?.setValue(client.city);
    this.form.get('profession')?.setValue(client.profession);
    this.form.get('notes')?.setValue(client.notes);
    this.form.get('type')?.setValue(client.type);
    this.updateButtom = true;
    this.letUpdateClient = client;
  }

  openCreateClient() {
    this.openSaveUpdate = true
  }

  closeCreateClient() {
    this.openSaveUpdate = false;
  }

  onPageChange($event: any) {
    console.log($event.page + 1);
    const page = $event.page + 1;
    this.getAllClients(page)
  }

  createDocumentTypes() {
    this.documentTypes = [
      {name: 'CC', code: 'CC'},
      {name: 'CE', code: 'CE'},
      {name: 'PASS', code: 'PASS'},
      {name: 'TI', code: 'TI'},
    ]
  }

  encriptar() {
    this.clientsService.getAllClientsWithoutPaginated().subscribe(res => {
      res.forEach(client => {
        if (client.name?.length! < 15){
          let cryptClient: Client = {
            id: client.id,
            document_type: client.document_type!,
            document_number: encrypt(client.document_number!),
            name: encrypt(client.name!),
            last_name: encrypt(client.last_name!),
            phone: encrypt(client.phone!),
            neighborhood: encrypt(client.neighborhood!),
            address: encrypt(client.address!),
            city: encrypt(client.city!),
            profession: encrypt(client.profession!),
            notes: encrypt(client.notes!),
            type: encrypt(client.type!)
          }
        this.clientsService.updateClient(cryptClient).subscribe(res => {
          console.log(res)
        }, error => {
          console.error(error);
        })
      }
      })
    })
  }

  protected readonly encrypt = encrypt;
}
