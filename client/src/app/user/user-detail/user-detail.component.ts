import { Component, OnInit } from '@angular/core';
import { User } from '../../shared/user.model';
import { ActivatedRoute, Router } from '@angular/router';
import { UserService } from 'src/app/core/user.service';



@Component({
  selector: 'app-user-detail',
  templateUrl: './user-detail.component.html',
  styleUrls: ['./user-detail.component.scss']
})
export class UserDetailComponent implements OnInit {
  user: User = {
    id: 0,
    name: '',
    password: '',
    mail: '',
    rol: '',
    orderTotal: 0,
  };
  userId: number = 0;

  constructor(
    private activatedroute: ActivatedRoute,
    private router: Router,
    private userService: UserService
  ) {}

  ngOnInit() {
    this.userId = parseInt(this.activatedroute.snapshot.params['userId']);
    this.userService
      .getUserById(this.userId)
      .subscribe((data: User) => (this.user = data));
  }
  goEdit(): void {
    this.router.navigate(['/users', this.userId, 'edit']);
  }
  onBack(): void {
    this.router.navigate(['']);
  }


}
