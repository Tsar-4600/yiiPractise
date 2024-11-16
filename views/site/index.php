<?php

/** @var yii\web\View $this */

$this->title = 'NeNetFlix кинотеатр';
?>
<div class="site-index">
   
    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Добро пожаловать 
            <?php if(!(Yii::$app->user->isGuest)):?>
                <?= $user['name']," ",$user['surname']?> !</h1>
            <?php else: ?>
                <?='Гость'?>
            <?php endif;?>
    </div>
    <div class="body-content container">
        <div class =  "container slider-block d-flex justify-content-center">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <?php foreach ($catalogFilm as $index => $catalogFilm_item): ?>
                        <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                            <img src="/web/images/<?= $catalogFilm_item->photo_path ?>" class="d-block" width="500px" height="600px" alt="">
                        </div>
                    <?php endforeach; ?>
                </div>
                <button class="carousel-control-prev" type="button" data-target="#carouselExampleControls" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-target="#carouselExampleControls" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </button>
            </div>
        </div>
        <div class = "container card-list d-flex flex-wrap" >
            <?php foreach($catalogFilm as $catalogFilm_item):?>
                <?//var_dump($catalogFilm_item->genre->name) ?>
                <div class="col-md-4">
                    <div class="card-list__card mb-5">
                        <img src="/web/images/<?= $catalogFilm_item->photo_path ?>" alt="">
                        <div class="card__content">
                            <div class="content__name-film">
                                <strong>Название:</strong> <?= $catalogFilm_item->name ?>
                            </div>
                            <div class="content__genre">
                                <strong>Жанр:</strong> <?= $catalogFilm_item->genre->name?>
                            </div>
                            <div class="content__genre">
                               <strong>Цена:</strong> <?= $catalogFilm_item->price?> руб.
                            </div>
                            <button class = "btn btn-primary">Добавить в корзину</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
