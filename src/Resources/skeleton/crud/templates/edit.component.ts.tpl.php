
import { Component, OnInit } from '@angular/core';
import { <?= $entity_class_name ?>Service } from '../<?= $route_name ?>.service';
import { <?= $entity_class_name ?> } from '../<?= $route_name ?>';
import { ActivatedRoute, Router } from '@angular/router';
import { Location } from '@angular/common';
import { NotificationService } from 'src/app/shared/services/notification.service';

@Component({
  selector: 'app-<?= $route_name ?>-edit',
  templateUrl: './<?= $route_name ?>-edit.component.html',
  styleUrls: ['./<?= $route_name ?>-edit.component.scss']
})
export class <?= $entity_class_name ?>EditComponent implements OnInit {

  <?= $entity_twig_var_singular ?>: <?= $entity_class_name ?>;
  constructor(public <?= $entity_twig_var_singular ?>Srv: <?= $entity_class_name ?>Service,
    public activatedRoute: ActivatedRoute,
    public router: Router, public location: Location,
    public notificationSrv: NotificationService) {
  }

  ngOnInit() {
    this.<?= $entity_twig_var_singular ?> = this.activatedRoute.snapshot.data['<?= $entity_twig_var_singular ?>'];
  }

  update<?= $entity_class_name ?>() {
    this.<?= $entity_twig_var_singular ?>Srv.update(this.<?= $entity_twig_var_singular ?>)
      .subscribe(data => this.location.back(),
        error => this.<?= $entity_twig_var_singular ?>Srv.httpSrv.handleError(error));
  }

}
