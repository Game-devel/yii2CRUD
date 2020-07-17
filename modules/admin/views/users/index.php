<?php

use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */

$this->title = 'Записи на тренинги';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12" id="teamTable">
        <h3><?= $this->title ?></h3>
        <?php Pjax::begin(); ?>
        <?php // echo $this->render('_search', ['model' => $searchModel]); 
        ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'surname',
                'name',
                'patronymic',
                'attribute' => 'phone',
                [
                    'label' => 'Почта',
                    'attribute' => 'email',

                    'contentOptions' => ['style' => 'width:10%;']
                ],
                'organization',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view}',
                    'headerOptions' => ['style' => 'width: 60px; max-width: 60px;'],
                    'contentOptions' => ['style' => 'width: 60px; max-width: 60px;', 'class' => 'text-center'],
                ],

            ],
        ]); ?>
        <?php Pjax::end(); ?>
    </div>
</div>