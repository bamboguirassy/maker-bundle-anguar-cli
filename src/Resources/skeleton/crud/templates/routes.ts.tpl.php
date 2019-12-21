import { Route } from "@angular/router";
import { <?= $entity_class_name ?>ListComponent } from './<?= $route_name ?>-list/<?= $route_name ?>-list.component';
import { <?= $entity_class_name ?>NewComponent } from './<?= $route_name ?>-new/<?= $route_name ?>-new.component';
import { <?= $entity_class_name ?>EditComponent } from './<?= $route_name ?>-edit/<?= $route_name ?>-edit.component';
import { <?= $entity_class_name ?>CloneComponent } from './<?= $route_name ?>-clone/<?= $route_name ?>-clone.component';
import { <?= $entity_class_name ?>ShowComponent } from './<?= $route_name ?>-show/<?= $route_name ?>-show.component';
import { Multiple<?= $entity_class_name ?>Resolver } from './multiple-<?= $route_name ?>.resolver';
import { One<?= $entity_class_name ?>Resolver } from './one-<?= $route_name ?>.resolver';

const <?= $entity_twig_var_singular ?>Routes: Route = {
    path: '<?= $route_name ?>', children: [
        { path: '', component: <?= $entity_class_name ?>ListComponent, resolve: { <?= $entity_twig_var_singular ?>s: Multiple<?= $entity_class_name ?>Resolver } },
        { path: 'new', component: <?= $entity_class_name ?>NewComponent },
        { path: ':id/edit', component: <?= $entity_class_name ?>EditComponent, resolve: { <?= $entity_twig_var_singular ?>: One<?= $entity_class_name ?>Resolver } },
        { path: ':id/clone', component: <?= $entity_class_name ?>CloneComponent, resolve: { <?= $entity_twig_var_singular ?>: One<?= $entity_class_name ?>Resolver } },
        { path: ':id', component: <?= $entity_class_name ?>ShowComponent, resolve: { <?= $entity_twig_var_singular ?>: One<?= $entity_class_name ?>Resolver } }
    ]

};

export { <?= $entity_twig_var_singular ?>Routes }
