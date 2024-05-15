import * as CryptoJS from "crypto-js"
import {environment} from "src/environments/environment";

export const encrypt = (data: string): string => {
  let tokenFromUI:string = environment.keyCrypt;
  let encrypted: any = "";
  let decrypted: string;

  let _key = CryptoJS.enc.Utf8.parse(tokenFromUI);
  let _iv = CryptoJS.enc.Utf8.parse(tokenFromUI);
  let encryp = CryptoJS.AES.encrypt(
    JSON.stringify(data), _key, {
      keySize: 16,
      iv: _iv,
      mode: CryptoJS.mode.CBC,
      padding: CryptoJS.pad.Pkcs7
    });
  return encrypted = encryp.toString();
}

export const decrypt = (valueEncrypt: string): string => {
  let tokenFromUI:string = environment.keyCrypt;
  let decrypted: string;

  let _key = CryptoJS.enc.Utf8.parse(tokenFromUI);
  let _iv = CryptoJS.enc.Utf8.parse(tokenFromUI);

  decrypted = CryptoJS.AES.decrypt(
    valueEncrypt, _key, {
      keySize: 16,
      iv: _iv,
      mode: CryptoJS.mode.CBC,
      padding: CryptoJS.pad.Pkcs7
    }).toString(CryptoJS.enc.Utf8);
  return decrypted.substring(1, decrypted.length - 1);
}

