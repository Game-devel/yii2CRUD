<?php

use yii\widgets\Menu;
use yii\bootstrap\Nav;


?>

<div class="admin-menu">
   <?php echo Nav::widget([
    
    'items' => [
        ['label' => 'Контент', 'url' => '#', 'items' => [
            ['label' => 'Видео (О компаний)', 'url' => ['video-about-company/index']],
            ['label' => 'Партнеры', 'url' => ['logo/index']],
            ['label' => 'Лицензии и Сертификаты', 'url' => ['licences/index']],
            ['label' => 'Страницы', 'url' => ['pages/index']],            
            ['label' => 'Фотогалерея', 'url' => ['photogallery/index']],
            // ['label' => 'Новости', 'url' => ['news/index']],
            ['label' => 'Наша команда', 'url' => ['team/index']],
            // ['label' => 'Отзывы', 'url' => ['reviews/index']],
            // ['label' => 'Ответы экспертов', 'url' => ['answers/index']],
        ]],
        ['label' => 'Обучение', 'url' => '#', 'items' => [
            ['label' => 'Тесты', 'url' => ['test/index']],
            ['label' => 'Вопросы', 'url' => ['question/index']],
        ]],
        ['label' => 'Тренинги', 'url' => ['trainings/index']],
        ['label' => 'Записи', 'url' => ['entries/index']],
        ['label' => 'Видео Категория', 'url' => ['videos-category/index']],
        ['label' => 'Видео', 'url' => ['videos/index']],
        ['label' => 'Записи на Видео Уроки', 'url' => ['record-video-lesson/index']],
        ['label' => 'Пользователи', 'url' => ['users/index']],
        ['label' => 'Документы', 'url' => ['documents/index']],
        ['label' => 'Рассылка', 'url' => ['email-send/send']]
    ],
	'options' => [
		'class'=>'admin-nav',
	],
    'encodeLabels' =>'false',
   
    
]);?>
</div>