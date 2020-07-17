<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Tabs;
?>
    <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'author_id')->dropDownList(ArrayHelper::map($authors, 'id', 'name'), ['prompt' => 'Select...']) ;?>
            </div>
            <div class="col-md-12">
                <?= $form->field($model, 'name')->textInput() ?>
            </div>            
        </div>
      
        <div class="form-group text-right">
            <?= Html::submitButton( ($action == 'create') ? 'Добавить' : 'Обновить', ['class' => 'btn']) ?>
        </div>
    <?php ActiveForm::end(); ?>
    