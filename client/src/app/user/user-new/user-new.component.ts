import { Component } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { UserService } from 'src/app/core/user.service';
import { User } from 'src/app/shared/user.model';

@Component({
  selector: 'app-user-new',
  templateUrl: './user-new.component.html',
  styleUrls: ['./user-new.component.scss'],
})
export class UserNewComponent {
  pageTitle = 'User New';
  errorMessage: string = '';
  userForm: any;

  userId: number = 0;
  user: User = {
    id: 0,
    name: '',
    password: '',
    mail: '',
    rol: '',
    orderTotal: 0,
  };

  constructor(
    private fb: FormBuilder,
    private activatedroute: ActivatedRoute,
    private router: Router,
    private userService: UserService
  ) {}

  ngOnInit(): void {
    this.userForm = this.fb.group({
      name: [ '', [ Validators.required, Validators.minLength(3), Validators.maxLength(50) ] ],
      password: '',
      mail: '',
      rol: '',
      orderTotal: 0,
    });

    // Read the furniture Id from the route parameter
    this.userId = parseInt(this.activatedroute.snapshot.params['userId']);
  }

  saveUser(): void {
    if (this.userForm.valid) {
      if (this.userForm.dirty) {
        this.user = this.userForm.value;
        this.user.id = this.userId;

        this.userService.createUser(this.user).subscribe(
          () => this.onSaveComplete(),
          (error: any) => (this.errorMessage = <any>error)
        );
      } else {
        this.onSaveComplete();
      }
    } else {
      this.errorMessage = 'Please correct the validation errors.';
    }
  }

  onSaveComplete(): void {
    // Reset the form to clear the flags
    this.userForm.reset();
    this.router.navigate(['']);
  }
}
