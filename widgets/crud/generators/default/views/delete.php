<?php
echo "<?php\n";
?>
use kartik\form\ActiveForm;
?>

<?= "<?php " ?>$form = ActiveForm::begin(); ?>
<h4>Bạn chắc chắn muốn xóa <?= $generator->title?> "<?= '<?=$model->ten?>'?>"?</h4>
<?= "<?php " ?>ActiveForm::end(); ?>

