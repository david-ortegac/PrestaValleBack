import {Route} from "./Route";
import {Client} from "./Client";
import {CreatedBy} from "./audit/CreatedBy";
import {ModifiedBy} from "./audit/ModifiedBy";

export interface Loan{
  id?: number;
  route?:Route,
  client?:Client,
  order?:number,
  amount?:number,
  paymentDays?:string,
  paymentType?:string,
  deposit?:number,
  lastInstallment?:Date,
  remainingBalance?:number,
  remainingAmount?:number,
  daysPastDue?:number,
  lastPayment?:Date,
  startDate?:Date,
  finalDate?:Date,
  status?:boolean,
  created_by?:CreatedBy,
  modified_by?:ModifiedBy,
}
