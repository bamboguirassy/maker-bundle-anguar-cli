import { Component, OnInit } from '@angular/core';
import { <?= $entity_class_name ?> } from '../user';
import { ActivatedRoute, Router } from '@angular/router';
import { <?= $entity_class_name ?>Service } from '../user.service';
import { <?= $entity_twig_var_singular ?>Columns, allowed<?= $entity_class_name ?>FieldsForFilter } from '../user.columns';
import { ExportService } from 'src/app/shared/services/export.service';
import { MenuItem } from 'primeng/api';
import { AuthService } from 'src/app/shared/services/auth.service';
import { NotificationService } from 'src/app/shared/services/notification.service';


@Component({
  selector: 'app-user-list',
  templateUrl: './user-list.component.html',
  styleUrls: ['./user-list.component.scss']
})
export class <?= $entity_class_name ?>ListComponent implements OnInit {

  <?= $entity_twig_var_singular ?>s: <?= $entity_class_name ?>[] = [];
  selected<?= $entity_class_name ?>s: <?= $entity_class_name ?>[];
  selected<?= $entity_class_name ?>: <?= $entity_class_name ?>;
  cloned<?= $entity_class_name ?>s: <?= $entity_class_name ?>[];

  cMenuItems: MenuItem[]=[];

  tableColumns = <?= $entity_twig_var_singular ?>Columns;
  //allowed fields for filter
  globalFilterFields = allowed<?= $entity_class_name ?>FieldsForFilter;


  constructor(private activatedRoute: ActivatedRoute,
    public <?= $entity_twig_var_singular ?>Srv: <?= $entity_class_name ?>Service, public exportSrv: ExportService,
    private router: Router, public authSrv: AuthService,
    public notificationSrv: NotificationService) { }

  ngOnInit() {
    if(this.authSrv.checkShowAccess('<?= $entity_class_name ?>')){
      this.cMenuItems.push({ label: 'Afficher détails', icon: 'pi pi-eye', command: (event) => this.view<?= $entity_class_name ?>(this.selected<?= $entity_class_name ?>) });
    }
    if(this.authSrv.checkEditAccess('<?= $entity_class_name ?>')){
      this.cMenuItems.push({ label: 'Modifier', icon: 'pi pi-pencil', command: (event) => this.edit<?= $entity_class_name ?>(this.selected<?= $entity_class_name ?>) })
    }
    if(this.authSrv.checkCloneAccess('<?= $entity_class_name ?>')){
      this.cMenuItems.push({ label: 'Cloner', icon: 'pi pi-clone', command: (event) => this.clone<?= $entity_class_name ?>(this.selected<?= $entity_class_name ?>) })
    }
    if(this.authSrv.checkDeleteAccess('<?= $entity_class_name ?>')){
      this.cMenuItems.push({ label: 'Supprimer', icon: 'pi pi-times', command: (event) => this.delete<?= $entity_class_name ?>(this.selected<?= $entity_class_name ?>) })
    }

    this.<?= $entity_twig_var_singular ?>s = this.activatedRoute.snapshot.data['<?= $entity_twig_var_singular ?>s'];
  }

  view<?= $entity_class_name ?>(<?= $entity_twig_var_singular ?>: <?= $entity_class_name ?>) {
      this.router.navigate([this.<?= $entity_twig_var_singular ?>Srv.getRoutePrefix(), <?= $entity_twig_var_singular ?>.id]);

  }

  edit<?= $entity_class_name ?>(<?= $entity_twig_var_singular ?>: <?= $entity_class_name ?>) {
      this.router.navigate([this.<?= $entity_twig_var_singular ?>Srv.getRoutePrefix(), <?= $entity_twig_var_singular ?>.id, 'edit']);
  }

  clone<?= $entity_class_name ?>(<?= $entity_twig_var_singular ?>: <?= $entity_class_name ?>) {
      this.router.navigate([this.<?= $entity_twig_var_singular ?>Srv.getRoutePrefix(), <?= $entity_twig_var_singular ?>.id, 'clone']);
  }

  delete<?= $entity_class_name ?>(<?= $entity_twig_var_singular ?>: <?= $entity_class_name ?>) {
      this.<?= $entity_twig_var_singular ?>Srv.remove(<?= $entity_twig_var_singular ?>)
        .subscribe(data => this.refreshList(), error => this.<?= $entity_twig_var_singular ?>Srv.httpSrv.handleError(error));
  }

  deleteSelected<?= $entity_class_name ?>s(<?= $entity_twig_var_singular ?>: <?= $entity_class_name ?>) {
    this.<?= $entity_twig_var_singular ?>Srv.removeSelection(this.selected<?= $entity_class_name ?>s)
      .subscribe(data => this.refreshList(), error => this.<?= $entity_twig_var_singular ?>Srv.httpSrv.handleError(error));
  }

  refreshList() {
    this.<?= $entity_twig_var_singular ?>Srv.findAll()
      .subscribe((data: any) => this.<?= $entity_twig_var_singular ?>s = data, error => this.<?= $entity_twig_var_singular ?>Srv.httpSrv.handleError(error));
  }

  exportPdf() {
    this.exportSrv.exportPdf(this.tableColumns, this.<?= $entity_twig_var_singular ?>s, '<?= $entity_twig_var_singular ?>s');
  }

  exportExcel() {
    this.exportSrv.exportExcel(this.<?= $entity_twig_var_singular ?>s);
  }

  saveAsExcelFile(buffer: any, fileName: string): void {
    this.exportSrv.saveAsExcelFile(buffer, fileName);
  }

}