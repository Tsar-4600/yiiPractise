<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Catalog';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-catalog">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class = "container card-list" >
        <?php foreach($catalogfilm as $catalogFilm_item):?>
            <?//var_dump($catalogFilm_item->genre->name) ?>
            <div class="col-md-4">
                <div class="card-list__card">
                    <img src="/web/images/<?= $catalogFilm_item->photo_path ?>" alt="">
                    <div class="card__content">
                        <div class="content__name-film">
                               <?= $catalogFilm_item->name ?>
                        </div>
                        <div class="content__genre">
                            <?= $catalogFilm_item->genre->name?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <code><?= __FILE__ ?></code>
</div>
