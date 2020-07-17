<?php

use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'Добавление книг';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12" id="booksTable">
        <h3><?= $this->title ?></h3>
        <p><a href="<?= Url::toRoute('books/') ?>" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-arrow-left"></span> Назад к книгам</a></p>
        <?php echo $this->render('_booksform', ['model' => $model, 'authors' => $authors, 'action' => 'create']);?>
    </div>
</div>

<?php 

$script = <<< JS

JS;

$this->registerJs($script, yii\web\View::POS_READY);

?>