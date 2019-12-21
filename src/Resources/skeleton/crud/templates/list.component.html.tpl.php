<p-toast></p-toast>
<div class="row" *ngIf="'<?= $entity_class_name ?>'|listable">
  <div class="col-sm-12 col-md-12 col-lg-12">
    <p-fieldset legend="Liste des <?= $entity_twig_var_singular ?>s" [toggleable]="true">
      <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
          <p-toolbar>
            <button *ngIf="'<?= $entity_class_name ?>'|listable" type="button" class="btn btn-outline-secondary" (click)="refreshList()">
              <i class="fa fa-refresh" aria-hidden="true"></i> Raffraichir les données
            </button>
            <button *ngIf="'<?= $entity_class_name ?>'|deletable" (click)="deleteSelected<?= $entity_class_name ?>s()" type="button"
              class="btn btn-outline-danger pull-right ml-1">
              <i class="fa fa-trash-o" aria-hidden="true"></i> Supprimer selection
            </button>
            <button *ngIf="'<?= $entity_class_name ?>'|creable" [routerLink]="['/'+<?= $entity_twig_var_singular ?>Srv.getRoutePrefix(),'new']"
              routerLinkActive="router-link-active" type="button" class="btn btn-outline-primary pull-right ml-1">
              <i class="fa fa-plus-square-o" aria-hidden="true"></i> Nouveau
            </button>
          </p-toolbar>
          <p-table #tt [value]="<?= $entity_twig_var_singular ?>s" [paginator]="true" [rows]="50" sortMode="multiple" selectionMode="multiple"
            [(selection)]="selected<?= $entity_class_name ?>s" [resizableColumns]="true" [responsive]="true"
            [contextMenu]="contextMenu" [(contextMenuSelection)]="selected<?= $entity_class_name ?>" [scrollable]="true"
            scrollHeight="400px" [globalFilterFields]="globalFilterFields" dataKey="id">
            <ng-template pTemplate="caption">
              Liste des <?= $entity_twig_var_singular ?>s<br>
              <i class="fa fa-search" style="margin:4px 4px 0 0"></i>
              <input type="text" pInputText size="50" placeholder="Rechercher dans le tableau"
                (input)="tt.filterGlobal($event.target.value, 'contains')" style="width:auto">
              <div class="ui-helper-clearfix" style="text-align: left">
                <button *ngIf="'<?= $entity_class_name ?>'|listable" type="button" pButton icon="pi pi-file-pdf" iconPos="left" label="PDF"
                  (click)="exportPdf()" class="ui-button-warning pull-right ml-1"></button>
                <button *ngIf="'<?= $entity_class_name ?>'|listable" type="button" pButton icon="pi pi-file-excel" iconPos="left"
                  label="EXCEL" (click)="exportExcel()" style="margin-right: 0.5em;" class="ui-button-success pull-right"></button>
              </div>
            </ng-template>
            <ng-template pTemplate="colgroup">
              <colgroup>
      <?php foreach ($entity_fields as $field): ?>
      <?php if($field['fieldName']!='id'){ ?>
                <col>
      <?php } ?>
<?php endforeach; ?>
              </colgroup>
            </ng-template>
            <ng-template pTemplate="header">
              <tr>
                <th style="width: 3em">
                  <p-tableHeaderCheckbox></p-tableHeaderCheckbox>
                </th>
      <?php foreach ($entity_fields as $field): ?>
      <?php if($field['fieldName']!='id'){ ?>
              <th [pSortableColumn]="'<?= $field['fieldName'] ?>'" pResizableColumn>
                  <?= ucfirst($field['fieldName']) ?> <p-sortIcon [field]="'<?= $field['fieldName'] ?>'"></p-sortIcon>
              </th>
      <?php } ?>
<?php endforeach; ?>
              </tr>
            </ng-template>
            <ng-template pTemplate="body" let-<?= $entity_twig_var_singular ?> let-editing="editing">
              <tr [pEditableRow]="<?= $entity_twig_var_singular ?>" [pSelectableRow]="<?= $entity_twig_var_singular ?>" [pContextMenuRow]="<?= $entity_twig_var_singular ?>">
                <td style="width: 3em">
                  <p-tableCheckbox [value]="<?= $entity_twig_var_singular ?>"></p-tableCheckbox>
                </td>
          <?php foreach ($entity_fields as $field): ?>
            <?php if($field['fieldName']!='id'){ ?>
                <td class="ui-resizable-column">
                  {{ <?= $helper->getEntityFieldPrintCode($entity_twig_var_singular, $field) ?> }}
                </td>
            <?php } ?>
<?php endforeach; ?>
              </tr>
            </ng-template>
            <ng-template pTemplate="footer" let-columns>
              <tr>
                <td style="width: 3em">
                  <p-tableHeaderCheckbox></p-tableHeaderCheckbox>
                </td>
      <?php foreach ($entity_fields as $field): ?>
      <?php if($field['fieldName']!='id'){ ?>
                 <td><?= ucfirst($field['fieldName']) ?></td>
      <?php } ?>
<?php endforeach; ?>
              </tr>
            </ng-template>
          </p-table>
          <p-contextMenu #contextMenu [model]="cMenuItems"></p-contextMenu>
          <p-toolbar>
            <button *ngIf="'<?= $entity_class_name ?>'|deletable" (click)="deleteSelected<?= $entity_class_name ?>s()" type="button"
              class="btn btn-outline-danger mr-1">
              <i class="fa fa-trash-o" aria-hidden="true"></i> Supprimer selection
            </button>
            <button *ngIf="'<?= $entity_class_name ?>'|creable" [routerLink]="['/'+<?= $entity_twig_var_singular ?>Srv.getRoutePrefix(),'new']"
              routerLinkActive="router-link-active" type="button" class="btn btn-outline-primary mr-1">
              <i class="fa fa-plus-square-o" aria-hidden="true"></i> Nouveau
            </button>
          </p-toolbar>
        </div>
      </div>
    </p-fieldset>
  </div>
</div>