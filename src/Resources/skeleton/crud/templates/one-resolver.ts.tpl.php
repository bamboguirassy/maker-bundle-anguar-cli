import { Injectable } from '@angular/core';
import { Resolve } from '@angular/router';
import { map, catchError } from 'rxjs/operators';
import { of } from 'rxjs';
import { <?= $entity_class_name ?>Service } from './<?= $route_name ?>.service';

@Injectable({
  providedIn: 'root'
})
export class One<?= $entity_class_name ?>Resolver implements Resolve<any> {
  resolve(route: import("@angular/router").ActivatedRouteSnapshot, state: import("@angular/router").RouterStateSnapshot) {
    return this.<?= $entity_twig_var_singular ?>Srv.findOneById(route.params.id).pipe(map(data => {
      return data;
    }),
    catchError(error => {
      const message = `Retrieval error: ${error}`;
      return of({ <?= $entity_twig_var_singular ?>: null, error: message });
    }));
  }

  constructor(public <?= $entity_twig_var_singular ?>Srv:<?= $entity_class_name ?>Service) { }
}

