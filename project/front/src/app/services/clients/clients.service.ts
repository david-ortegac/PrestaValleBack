import {HttpClient} from '@angular/common/http';
import {Injectable} from '@angular/core';
import {Observable} from 'rxjs';
import {Client} from 'src/app/models/Client';
import {Pageable} from 'src/app/utils/pageable';
import {decrypt} from 'src/app/utils/util-encrypt';
import {environment} from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class ClientsService {

  url: string = "";
  tk = "";

  validateAndDecryptToken() {
    try {
      this.tk = decrypt(sessionStorage.getItem('tk')!);
    } catch (error) {
      console.log(error);
    }
  }

  constructor(private httpClient: HttpClient) {
    this.url = environment.apiUrl;
  }

  getAllClients(page: number): Observable<Pageable<Client[]>> {
    this.validateAndDecryptToken();
    return this.httpClient.get<Pageable<Client[]>>(this.url + 'clientes?page=' + page, {
      headers: {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${this.tk}`
      }
    });
  }

  getAllClientsWithoutPaginated(): Observable<Client[]> {
    this.validateAndDecryptToken();
    return this.httpClient.get<Client[]>(this.url + 'clientes_all', {
      headers: {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${this.tk}`
      }
    });
  }

  getClientByDocumentNumber(documentNumber: string): Observable<Client> {
    this.validateAndDecryptToken();
    return this.httpClient.get<Client>(this.url + 'clientes/search_by_document/' + documentNumber, {
      headers: {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${this.tk}`
      }
    })
  }

  createClient(client: Client): Observable<Pageable<Client>> {
    this.validateAndDecryptToken();
    return this.httpClient.post<Pageable<Client>>(this.url + 'clientes', client,
      {
        headers: {
          'Content-Type': 'application/json',
          'Authorization': `Bearer ${this.tk}`
        }
      }
    );
  }

  updateClient(client: Client): Observable<Client> {
    console.log(client)
    this.validateAndDecryptToken();
    return this.httpClient.patch<Client>(this.url + 'clientes/' + client.id, client,
      {
        headers: {
          'Content-Type': 'application/json',
          'Authorization': `Bearer ${this.tk}`
        }

      });
  }


}
