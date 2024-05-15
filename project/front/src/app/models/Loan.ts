import { CreatedBy } from "./audit/CreatedBy";
import { ModifiedBy } from "./audit/ModifiedBy";
import { Client } from "./Client";
import { Route } from "./Route";

export interface Loan{
  id?: number;
  route?:Route,
  client?:Client,
  order?:number,
  amount?:number,
  dailyPayment?: number,
  daysToPay?:number,
  paymentDays?:string,
  deposit?:number,
  pico?:number,
  date?:Date,
  daysPastDue?:number,
  balance?:number,
  dues?:number,
  lastPayment?:Date,
  startDate?:Date,
  finalDate?:Date,
  status?:boolean,
  created_by?:CreatedBy,
  modified_by?:ModifiedBy,
}
