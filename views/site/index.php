<?php

/* @var $this yii\web\View */
use yii\helpers\Html;

$this->title = 'Книги';
?>
<div class="site-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Book name</th>
                <th scope="col">Author</th>
                <th scope="col">Contact</th>
            </tr>
        </thead>
        <tbody>
            <?php $count = 1; foreach ($books as $book): ?>
            <tr>
                <th scope="row"><?=$count?></th>
                <td><?=$book->name?></td>
                <td><?=$book->author->name?></td>
                <td><?=$book->author->contact?></td>
            </tr>
            <?php $count++; endforeach; ?>            
        </tbody>
        </table>
    
</div>
