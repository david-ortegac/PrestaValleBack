import {Component, OnInit} from '@angular/core';
import {ProfileService} from "../../services/profile/profile.service";
import {Router} from "@angular/router";
import Swal from "sweetalert2";
import {decrypt} from "../../utils/util-encrypt";

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {

  constructor(
    private readonly profileService: ProfileService,
    private router: Router,
  ) {

  }

  ngOnInit(): void {
    this.profileService.profile().subscribe(() => {
      //if (res.userData.id != null)
        //this.router.navigate(["/index"]);
    }, () => {
      this.router.navigate(["/"]);
      Swal.fire({
        position: 'center',
        icon: 'error',
        title: 'Por favor inicar sesión para acceder',
        showConfirmButton: false,
        timer: 1500
      });
    });

  }

  }
