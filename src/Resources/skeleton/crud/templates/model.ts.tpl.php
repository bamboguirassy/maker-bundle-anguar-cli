export class <?= $entity_class_name ?> {
    <?=  $entity_identifier ?>: any;
    <?php foreach ($entity_fields as $field): ?>
    <?php if($field['fieldName']!='id'){ ?>
                <?= $field['fieldName'] ?>: string;
                <?php } ?>
    <?php endforeach; ?>
}
