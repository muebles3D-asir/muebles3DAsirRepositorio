import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';

import { Observable, of, throwError } from 'rxjs';
import { catchError, tap, map } from 'rxjs/operators';

import { Furniture } from '../shared/furniture.model';

@Injectable({
  providedIn: 'root',
})
export class FurnitureService {
  private url = 'https://localhost:8000/furniture';

  constructor(private http: HttpClient) {}

  getFurnitures(): Observable<Furniture[]> {

    return this.http.get<Furniture[]>(this.url).pipe(
      tap((data: any) => console.log(JSON.stringify(data))),
      catchError(this.handleError)
    );
  }

  getMaxFurnitureId(): Observable<number> {
    return this.http.get<Furniture[]>(`${this.url}`).pipe(
      // Get max value from an array
      map((data: any) =>
        Math.max.apply(
          Math,
          data.map(function (o: any) {
            return o.id;
          })
        )
      ),
      catchError(this.handleError)
    );
  }

  getFurnitureById(id: number): Observable<Furniture> {
    const url = `${this.url}/${id}`;
    return this.http.get<Furniture>(url).pipe(
      tap((data: any) => console.log('getFurnitureById: ' + JSON.stringify(data))),
      catchError(this.handleError)
    );
  }

  createFurniture(furniture: Furniture): Observable<Furniture> {
    const headers = new HttpHeaders({ 'Content-Type': 'application/json' });
    furniture.id = 0;
    return this.http
      .post<Furniture>(this.url, furniture, { headers: headers })
      .pipe(
        tap((data: any) => console.log('createFurniture: ' + JSON.stringify(data))),
        catchError(this.handleError)
      );
  }

  deleteFurniture(id: number): Observable<{}> {
    const headers = new HttpHeaders({ 'Content-Type': 'application/json' });
    const url = `${this.url}/${id}`;
    return this.http.delete<Furniture>(url, { headers: headers }).pipe(
      tap((data: any) => console.log('deleteFurniture: ' + id)),
      catchError(this.handleError)
    );
  }

  updateFurniture(furniture: Furniture): Observable<Furniture> {
    const headers = new HttpHeaders({ 'Content-Type': 'application/json' });
    const url = `${this.url}/${furniture.id}`;
    return this.http.put<Furniture>(url, furniture, { headers: headers }).pipe(
      tap(() => console.log('updateFurniture: ' + furniture.id)),
      // Return the product on an update
      map(() => furniture),
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
