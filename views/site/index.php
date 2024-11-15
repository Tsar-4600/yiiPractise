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

    <div class="body-content container flex-wrap">
        <!-- <div id="carouselExampleControl" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <?php //foreach($catalogFilm as $catalogFilm_item):?>
                    <div class="carousel-item active">
                        <img src="/web/images/<? //$catalogFilm_item->photo_path ?>" class="d-block w-50" alt="">
                    </div>
                <?php // endforeach; ?>
            </div>
            <button class="carousel-control-prev" type="button" data-target="#carouselExampleControls" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-target="#carouselExampleControls" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </button>
        </div> -->
        <div class = "container card-list d-flex flex-wrap" >
            <?php foreach($catalogFilm as $catalogFilm_item):?>
                <?//var_dump($catalogFilm_item->genre->name) ?>
                <div class="col-md-4">
                    <div class="card-list__card ">
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
    </div>
</div>
