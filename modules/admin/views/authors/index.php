<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */

$this->title = 'Список авторов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12" id="teamTable">
        <h3><?= $this->title ?></h3>        
        <p><a href="<?= Url::toRoute('authors/create') ?>" class="btn btn-sm btn-success">Добавить автора</a></p>                
        <?php Pjax::begin();?>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?=GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],                
                'name',
                'contact',
                'address',
                [   
                    'label' => 'Count Book',                    
                    'value' => 'books',
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update}{delete}',
                    'headerOptions' => ['style' => 'width: 60px; max-width: 60px;'],
                    'contentOptions' => ['style' => 'width: 60px; max-width: 60px;', 'class' => 'text-center'],
                ],

            ],
        ]);?>
        <?php Pjax::end();?>
    </div>
</div>