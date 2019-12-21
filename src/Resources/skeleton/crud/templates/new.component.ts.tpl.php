import { Component, OnInit } from '@angular/core';
import { <?= $entity_class_name ?> } from '../<?= $route_name ?>';
import { <?= $entity_class_name ?>Service } from '../<?= $route_name ?>.service';
import { NotificationService } from 'src/app/shared/services/notification.service';
import { Router } from '@angular/router';
import { Location } from '@angular/common';

@Component({
  selector: 'app-<?= $route_name ?>-new',
  templateUrl: './<?= $route_name ?>-new.component.html',
  styleUrls: ['./<?= $route_name ?>-new.component.scss']
})
export class <?= $entity_class_name ?>NewComponent implements OnInit {
  <?= $entity_twig_var_singular ?>: <?= $entity_class_name ?>;
  constructor(public <?= $entity_twig_var_singular ?>Srv: <?= $entity_class_name ?>Service,
    public notificationSrv: NotificationService,
    public router: Router, public location: Location) {
    this.<?= $entity_twig_var_singular ?> = new <?= $entity_class_name ?>();
  }

  ngOnInit() {
  }

  save<?= $entity_class_name ?>() {
    this.<?= $entity_twig_var_singular ?>Srv.create(this.<?= $entity_twig_var_singular ?>)
      .subscribe((data: any) => {
        this.notificationSrv.showInfo('<?= $entity_class_name ?> créé avec succès');
        this.<?= $entity_twig_var_singular ?> = new <?= $entity_class_name ?>();
      }, error => this.<?= $entity_twig_var_singular ?>Srv.httpSrv.handleError(error));
  }

  save<?= $entity_class_name ?>AndExit() {
    this.<?= $entity_twig_var_singular ?>Srv.create(this.<?= $entity_twig_var_singular ?>)
      .subscribe((data: any) => {
        this.router.navigate([this.<?= $entity_twig_var_singular ?>Srv.getRoutePrefix(), data.id]);
      }, error => this.<?= $entity_twig_var_singular ?>Srv.httpSrv.handleError(error));
  }

}

