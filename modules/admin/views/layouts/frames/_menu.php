<?php

use yii\widgets\Menu;
use yii\bootstrap\Nav;


?>

<div class="admin-menu">
   <?php echo Nav::widget([
    
    'items' => [        
        ['label' => 'Авторы', 'url' => ['authors/index']],
        ['label' => 'Книги', 'url' => ['books/index']],        
    ],
	'options' => [
		'class'=>'admin-nav',
	],
    'encodeLabels' =>'false',
   
    
]);?>
</div>