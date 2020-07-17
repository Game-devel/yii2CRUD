<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RegistrationForm */
/* @var $form ActiveForm */

$this->title = 'Registration';
$this->params['breadcrumbs'][] = 'Registration';
?>
<div class="site-registration">
    <div class="jumbotron">
         <h3>Registration</h3>
    </div>
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
                <?= $form->field($model, 'surname')->textInput() ?>
                <?= $form->field($model, 'patronymic')->textInput() ?>
                <?= $form->field($model, 'email')->widget(\yii\widgets\MaskedInput::className(), ['clientOptions' => ['alias' =>  'email']])->textInput() ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::className(), ['mask' => '+ 9 ( 999 ) 999 - 9999'])->textInput() ?>
                <?= $form->field($model, 'organization')->textInput() ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'idCard')->fileInput() ?>
            </div>
        </div>
        <div class="form-group text-right">
            <?= Html::submitButton('Register', ['class' => 'btn']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-registration -->
