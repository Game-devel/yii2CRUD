<?php

use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\UserPermit;
use yii\grid\GridView;
use yii\widgets\DetailView;

use yii\bootstrap\Modal;

/* @var $this yii\web\View */

$this->title = 'Просмотр пользователя ID: ' . $model->id;
?>
<div class="row">
    <div class="col-md-12" id="teamTable">
        <h3><?= $this->title ?></h3>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'email',
                'name',
                'surname',
                'patronymic',
                'organization'
            ]
        ]); ?>

        <?php $dataProvider = new ActiveDataProvider([
            'query' => UserPermit::find()->where(['user' => $model->id]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'label' => 'Тип',
                    'value' => function ($data) {
                        if ($data->training != 0) {
                            return $data->training_title->categoryData->description;
                        } else {
                            return 'Видео урок';
                        }
                    }
                ],
                [
                    'label' => 'Название',
                    'value' => function ($data) {
                        if ($data->training != 0) {
                            return $data->training_title['title'];
                        } else {
                            return $data->video_cat_name['name'];
                        }
                    }
                ],
                [
                    'label' => 'Баллы',
                    'attribute' => 'rating'
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view}',
                    'buttons' => [
                        'view' => function ($url, $permit) {
                            return Html::a(
                                '<span class="glyphicon glyphicon-eye-open"></span>',
                                'javascript:void(0);',
                                [
                                    'title' => 'Просмотреть',
                                    'onclick' => 'viewResult(event,' . $permit->id . ')'
                                ]
                            );
                        },
                    ],
                    'headerOptions' => ['style' => 'width: 60px; max-width: 60px;'],
                    'contentOptions' => ['style' => 'width: 60px; max-width: 60px;', 'class' => 'text-center'],
                ],
            ]
        ]); ?>

        <?php
        Modal::begin([
            'header' => '<h4 class="modal-title">Просмотр результатов тестирования</h4>',
            'id' => 'modalResults',
            'size' => 'modal-lg'

        ]); ?>
        <button id="downloadResultDoc" class="btn btn-success">Скачать как Word</button>
        <button id="downloadResultPdf" class="btn btn-success">Скачать как Pdf</button>
        <div class="content">
            <div class="inner"></div>
        </div>
        <?php
        Modal::end();
        ?>
        <div style="display: none;" id="printContent">
             <div class="contentPrint">
                <div style="width: 40vw; height: 135vh;" class="inner_top"></div>
                <div class="inner_down"></div>
            </div>
        </div>

        <?php
        $url = Url::toRoute('users/permit');

        $script = <<< JS
$('#downloadResultDoc').on('click', function(){
        $('#printContent .contentPrint').wordExport('Результаты');                        
})
$('#downloadResultPdf').on('click', function() {
    var html = document.getElementsByClassName('contentPrint')[0]
    var clHtml = html.cloneNode(true)       
    clHtml.style.color = 'black';
    clHtml.style.padding = '8%';
    html2pdf()
        .from(clHtml)
        .toPdf()
        .save();
    
    // const filename  = 'ThisIsYourPDFFilename.pdf';
    // var html = document.getElementsByClassName('content')[0]
    // html.style.padding = '8%';
    // html2canvas(html).then(canvas => {
    // 	let pdf = new jsPDF('p', 'mm', 'a4');
    // 	pdf.addImage(canvas.toDataURL('image/png'), 'PNG', 0, 0, 211, 298);
    // 	pdf.save(filename);
    // });
})
window.viewResult = function(event, id){
    event.stopPropagation()
    $.ajax({
        method: "POST",
        url: '$url',
        data: { action: "view", id: id }
    })
    .done(function( response ) {
        if (response != false) {
            $('#modalResults .inner').html(response['result'] + response['table']);
            $('#printContent .inner_top').html(response['result']);
            $('#printContent .inner_down').html(response['table']);
            $('#modalResults').modal('show');
        }
        
    })
}

JS;

        $this->registerJs($script, yii\web\View::POS_READY);

        ?>