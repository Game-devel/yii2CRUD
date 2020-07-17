<?php

use yii\helpers\Html;
use app\assets\AppAsset;
use app\widgets\Alert;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<?php
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Expires: " . date("r"));
?>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
     <link href="/css/admin.css" rel="stylesheet">
</head>
<body>
<?php $this->beginBody() ?>

    <?php $this->beginContent('@app/modules/admin/views/layouts/frames/_top.php'); ?>

    <?php $this->endContent(); ?>

    <div class="admin-main d-flex">
        <?php $this->beginContent('@app/modules/admin/views/layouts/frames/_menu.php'); ?>

        <?php $this->endContent(); ?>

        <div class="admin-content">
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>