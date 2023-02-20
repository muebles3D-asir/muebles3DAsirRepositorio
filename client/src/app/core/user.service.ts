import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';

import { Observable, of, throwError } from 'rxjs';
import { catchError, tap, map } from 'rxjs/operators';

import { User } from '../shared/user.model';

@Injectable({
  providedIn: 'root',
})
export class UserService {
  private url = 'http://127.0.0.1:8000/user';

  constructor(private http: HttpClient) {}

  getUsers(): Observable<User[]> {
    return this.http.get<User[]>(this.url).pipe(
      tap((data) => console.log(JSON.stringify(data))),
      catchError(this.handleError)
    );
  }

  getMaxUserId(): Observable<number> {
    return this.http.get<User[]>(this.url).pipe(
      // Get max value from an array
      map((data) =>
        Math.max.apply(
          Math,
          data.map(function (o) {
            return o.id;
          })
        )
      ),
      catchError(this.handleError)
    );
  }

  getUserById(id: number): Observable<User> {
    const url = `${this.url}/${id}`;
    return this.http.get<User>(url).pipe(
      tap((data) => console.log('getUser: ' + JSON.stringify(data))),
      catchError(this.handleError)
    );
  }



  createUser(user: User): Observable<User> {
    const headers = new HttpHeaders({ 'Content-Type': 'application/json' });
    user.id = 0;
    return this.http
      .post<User>(this.url, user, { headers: headers })
      .pipe(
        tap((data) => console.log('createUser: ' + JSON.stringify(data))),
        catchError(this.handleError)
      );
  }

  deleteUser(id: number): Observable<{}> {
    const headers = new HttpHeaders({ 'Content-Type': 'application/json' });
    const url = `${this.url}/${id}`;
    return this.http.delete<User>(url, { headers: headers }).pipe(
      tap((data) => console.log('deleteUser: ' + id)),
      catchError(this.handleError)
    );
  }

  updateUser(user: User): Observable<User> {
    const headers = new HttpHeaders({ 'Content-Type': 'application/json' });
    const url = `${this.url}/${user.id}`;
    return this.http.put<User>(url, user, { headers: headers }).pipe(
      tap(() => console.log('updateUser: ' + user.id)),
      // Return the product on an update
      map(() => user),
      catchError(this.handleError)
    );
  }

  private handleError(err: any) {
    // in a real world app, we may send the server to some remote logging infrastructure
    // instead of just logging it to the console
    let errorMessage: string;
    if (err.error instanceof ErrorEvent) {
      // A client-side or network error occurred. Handle it accordingly.
      errorMessage = `An error occurred: ${err.error.message}`;
    } else {
      // The backend returned an unsuccessful response code.
      // The response body may contain clues as to what went wrong,
      errorMessage = `Backend returned code ${err.status}: ${err.body.error}`;
    }
    console.error(err);
    return throwError(errorMessage);
  }
}
