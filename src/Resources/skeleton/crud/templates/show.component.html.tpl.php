<p-toast></p-toast>
<p-fieldset *ngIf="'<?= $entity_class_name ?>'|showable" legend="Affichage des informations - Utilisateur" [toggleable]="true">
  <p-toolbar>
    <button *ngIf="'<?= $entity_class_name ?>'|editable" type="button" class="btn btn-outline-warning pull-right ml-1"
      [routerLink]="['/'+<?= $entity_twig_var_singular ?>Srv.getRoutePrefix(),<?= $entity_twig_var_singular ?>.id,'edit']"><i class="fa fa-pencil-square-o ml-1"></i>
      Modifier</button>
    <button *ngIf="'<?= $entity_class_name ?>'|clonable" [routerLink]="['/'+<?= $entity_twig_var_singular ?>Srv.getRoutePrefix(),<?= $entity_twig_var_singular ?>.id,'clone']" type="button"
      class="btn btn-outline-secondary pull-right ml-1">
      <i class="fa fa-clone" aria-hidden="true"></i> Cloner
    </button>
    <button *ngIf="'<?= $entity_class_name ?>'|deletable" type="button" class="btn btn-outline-danger pull-right ml-1" (click)="remove<?= $entity_class_name ?>()"><i
        class="fa fa-trash-o"></i> Supprimer</button>
    <button type="button" class="btn btn-outline-secondary pull-left ml-1" (click)="location.back()"><i
        class="fa fa-reply"></i> Retour</button>
  </p-toolbar>
  <p-tabView>
    <p-tabPanel header="Détails">
      <p-fieldset [legend]="<?= $entity_twig_var_singular ?>.id">
        <table class="table">
<?php foreach ($entity_fields as $field): ?>
            <?php if($field['fieldName']!='id'){ ?>
            <tr>
                <th><?= ucfirst($field['fieldName']) ?></th>
                <td>{{ <?= $helper->getEntityFieldPrintCode($entity_twig_var_singular, $field) ?> }}</td>
            </tr>
            <?php } ?>
<?php endforeach; ?>
        </table>
        <p-toolbar>
          <button *ngIf="'<?= $entity_class_name ?>'|editable" type="button" class="btn btn-outline-warning pull-right ml-1"
            [routerLink]="['/'+<?= $entity_twig_var_singular ?>Srv.getRoutePrefix(),<?= $entity_twig_var_singular ?>.id,'edit']"><i class="fa fa-pencil-square-o ml-1"></i>
            Modifier</button>
          <button *ngIf="'<?= $entity_class_name ?>'|clonable" [routerLink]="['/'+<?= $entity_twig_var_singular ?>Srv.getRoutePrefix(),<?= $entity_twig_var_singular ?>.id,'clone']" type="button"
            class="btn btn-outline-secondary pull-right ml-1">
            <i class="fa fa-clone" aria-hidden="true"></i> Cloner
          </button>
          <button *ngIf="'<?= $entity_class_name ?>'|deletable" type="button" class="btn btn-outline-danger pull-right ml-1" (click)="remove<?= $entity_class_name ?>()"><i
              class="fa fa-trash-o"></i> Supprimer</button>
          <button type="button" class="btn btn-outline-secondary pull-left ml-1" (click)="location.back()"><i
              class="fa fa-reply"></i> Retour</button>
          <button *ngIf="'<?= $entity_class_name ?>'|showable" type="button" class="btn btn-secondary ml-1" (click)="refresh()">
              <i class="fa fa-refresh" aria-hidden="true"></i> Raffraichir les données
          </button>
        </p-toolbar>
      </p-fieldset>
    </p-tabPanel>
    <p-tabPanel header="Liste associée">
      
    </p-tabPanel>
  </p-tabView>
</p-fieldset>
