import { Component, Input } from '@angular/core';
import { User } from '../../shared/user.model';

@Component({
  selector: 'app-user-item',
  templateUrl: './user-item.component.html',
  styleUrls: ['./user-item.component.scss']
})
export class UserItemComponent {
  @Input() user: User = {
    id: 0,
    name: '',
    password: '',
    mail: '',
    rol: '',
    orderTotal: 0,
  };

}
