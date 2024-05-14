import { Injectable } from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {environment} from "../../../environments/environment";
import {decrypt} from "../../utils/util-encrypt";
import {Observable} from "rxjs";
import {Loan} from "../../models/Loan";
import {CustomLoans} from "../../utils/customLoans";

@Injectable({
  providedIn: 'root'
})
export class LoansService {

  url: string;
  tk = "";

  constructor(
    private readonly httpClient: HttpClient
  ) {
    this.url = environment.apiUrl
  }

  validateAndDecryptToken() {
    try {
      this.tk = decrypt(sessionStorage.getItem('tk')!);
    } catch (error) {
      console.log(error);
    }
  }

  getLoansByRouteId(routeId: number | undefined): Observable<CustomLoans<Loan[]>> {
    this.validateAndDecryptToken();
    return this.httpClient.get<CustomLoans<Loan[]>>(this.url + 'loans/'+routeId, {
      headers: {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${this.tk}`
      }
    });
  }

}
