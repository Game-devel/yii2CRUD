<?php 
    use yii\helpers\Html;
    use yii\bootstrap\NavBar;
    use yii\bootstrap\Nav;
?>

<?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name.': административная панель',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
        'innerContainerOptions' => ['class' => 'container-fluid']
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            Yii::$app->user->isGuest ? (
                    ['label' => 'Войти', 'url' => ['/user/login']]
            ) : (
                [
                'label' => Yii::$app->user->identity->username,
                'items' => [
                    ['label' => 'Профиль', 'url' => ['/user/profile']],
                    '<li class="divider"></li>'
                    .'<li>'
                    . Html::beginForm(['/site/logout'], 'post')
                    . Html::submitButton(
                        'Выйти',
                        ['class' => 'btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>'
                    ]
                ]
            ),
        ]
    ]);
    NavBar::end();
    ?>