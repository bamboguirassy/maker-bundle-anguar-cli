
<p-toast></p-toast>
<!-- form <?= $entity_twig_var_singular ?> info -->
<form *ngIf="'<?= $entity_class_name ?>'|editable" class="form" role="form" #<?= $entity_twig_var_singular ?>Form="ngForm" autocomplete="off" (ngSubmit)="update<?= $entity_class_name ?>()">
  <p-fieldset legend="Modification utilisateur" [toggleable]="true">
    <p-toolbar>
      <button type="button" (click)="location.back()" class="btn btn-outline-secondary pull-left"><i
          class="fa fa-eraser" aria-hidden="true"></i>
        Retour</button>
      <button [disabled]="<?= $entity_twig_var_singular ?>Form.invalid" type="submit" class="btn btn-warning pull-right">
        <i class="fa fa-edit" aria-hidden="true"></i>
        Enregistrer</button>
    </p-toolbar>
    <!-- debut body -->
    <div class="row">
<?php foreach ($entity_fields as $field): ?>
        <?php if($field['fieldName']!='id'){ ?>
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="col-form-label form-control-label" for="<?= $field['fieldName'] ?>"><?= ucfirst($field['fieldName']) ?></label>
                    <input [(ngModel)]="<?= $entity_twig_var_singular.'.'.$field['fieldName'] ?>" class="form-control" type="text" name="<?= $field['fieldName'] ?>" id="<?= $field['fieldName'] ?>">
                </div>
            </div>
        <?php } ?>
<?php endforeach; ?>        
      
    </div>
    <!-- fin body -->
    <p-toolbar>
      <button type="button" (click)="location.back()" class="btn btn-outline-secondary pull-left"><i
          class="fa fa-eraser" aria-hidden="true"></i>
        Retour</button>
      <button [disabled]="<?= $entity_twig_var_singular ?>Form.invalid" type="submit" class="btn btn-warning pull-right">
        <i class="fa fa-edit" aria-hidden="true"></i>
        Enregistrer</button>
    </p-toolbar>
  </p-fieldset>
</form>
<!-- /form <?= $entity_twig_var_singular ?> info -->