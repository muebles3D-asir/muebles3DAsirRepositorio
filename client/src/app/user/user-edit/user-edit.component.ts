
import { Component, OnInit, AfterViewInit, OnDestroy, ViewChildren, ElementRef } from '@angular/core';

import { FormBuilder, FormGroup, FormControl, FormArray, Validators, FormControlName } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';

import { User } from '../../shared/user.model';
import { UserService } from '../../core/user.service';

@Component({
  selector: 'app-user-edit',
  templateUrl: './user-edit.component.html',
  styleUrls: ['./user-edit.component.scss'],
})
export class UserEditComponent implements OnInit {
  pageName = 'User Edit';
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
    private userservice: UserService
  ) {}

  ngOnInit(): void {
    this.userForm = this.fb.group({
      name: [
        '',
        [
          Validators.required,
          Validators.minLength(3),
          Validators.maxLength(50),
        ],
      ],
      password: '',
      mail: '',
      rol: '',
      orderTotal: 0,
    });

    this.userId = parseInt(this.activatedroute.snapshot.params['id']);
    this.getFurniture(this.userId);
  }

  getUser(id: number): void {
    this.userservice.getUserById(id).subscribe(
      (user: User) => this.displayUser(user),
      (error: any) => (this.errorMessage = <any>error)
    );
  }

  displayUser(user: User): void {
    if (this.userForm) {
      this.userForm.reset();
    }
    this.user = user;
    this.pageName = `Edit User: ${this.user.name}`;

    // Update the data on the form
    this.userForm.patchValue({
      name: this.user.name,
      password: this.user.password,
      mail: this.user.mail,
      rol: this.user.rol,
      orderTotal: this.user.orderTotal,
    });
  }

  deleteUser(): void {
    if (this.user.id === 0) {
      this.onSaveComplete();
    } else {
      if (confirm(`Really delete the User: ${this.user.name}?`)) {
        this.userservice.deleteUser(this.user.id).subscribe(
          () => this.onSaveComplete(),
          (error: any) => (this.errorMessage = <any>error)
        );
      }
    }
  }

  saveUser(): void {
    if (this.userForm.valid) {
      if (this.userForm.dirty) {
        this.user = this.userForm.value;
        this.user.id = this.userId;

        this.userservice.updateUser(this.user).subscribe(
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
