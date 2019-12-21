
import { Component, OnInit } from '@angular/core';
import { <?= $entity_class_name ?>Service } from '../<?= $route_name ?>.service';
import { Location } from '@angular/common';
import { <?= $entity_class_name ?> } from '../<?= $route_name ?>';
import { ActivatedRoute, Router } from '@angular/router';

@Component({
  selector: 'app-<?= $route_name ?>-clone',
  templateUrl: './<?= $route_name ?>-clone.component.html',
  styleUrls: ['./<?= $route_name ?>-clone.component.scss']
})
export class <?= $entity_class_name ?>CloneComponent implements OnInit {
  <?= $entity_twig_var_singular ?>: <?= $entity_class_name ?>;
  original: <?= $entity_class_name ?>;
  constructor(public <?= $entity_twig_var_singular ?>Srv: <?= $entity_class_name ?>Service, public location: Location,
    public activatedRoute: ActivatedRoute, public router: Router) { }

  ngOnInit() {
    this.original = this.activatedRoute.snapshot.data['<?= $entity_twig_var_singular ?>'];
    this.<?= $entity_twig_var_singular ?> = Object.assign({}, this.original);
    this.<?= $entity_twig_var_singular ?>.id = null;
  }

  clone<?= $entity_class_name ?>() {
    console.log(this.<?= $entity_twig_var_singular ?>);
    this.<?= $entity_twig_var_singular ?>Srv.clone(this.original, this.<?= $entity_twig_var_singular ?>)
      .subscribe((data: any) => {
        this.router.navigate([this.<?= $entity_twig_var_singular ?>Srv.getRoutePrefix(), data.id]);
      }, error => this.<?= $entity_twig_var_singular ?>Srv.httpSrv.handleError(error));
  }

}
