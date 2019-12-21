const <?= $entity_twig_var_singular ?>Columns = [
<?php foreach ($entity_fields as $field): ?>
<?php if($field['fieldName']!='id'){ ?>
    { header: '<?= ucfirst($field['fieldName']) ?>', field: '<?= $field['fieldName'] ?>', dataKey: '<?= $field['fieldName'] ?>' },
<?php } ?>
        <?php endforeach; ?>
];

const allowed<?= $entity_class_name ?>FieldsForFilter = [
<?php foreach ($entity_fields as $field): ?>
<?php if($field['fieldName']!='id'){ ?>
    '<?= $field['fieldName'] ?>',
<?php } ?>
<?php endforeach; ?>
];

export { <?= $entity_twig_var_singular ?>Columns,allowed<?= $entity_class_name ?>FieldsForFilter };
