<?php $title = "Schedule" ?>
<?php require_once __DIR__ . "/layouts/header.php" ?>
<?php require_once __DIR__ . "/nav.php" ?>
<!-- enter your html -->
<div class="container main">
    <?php foreach($movies as $movie) : ?>
    <div class="movieContainer mb-2">
        <div class="movieHeader py-2 mb-2">
            <h1 class="movieName"><?= $movie['name'] ?></h1>
        </div>
        <div class="movieBody">
            <div class="row my-2">
                <div class="col-md-3">
                    <img class="thumbnail" src="<?= $movie['movie_img'] ?>" alt="">
                </div>
                <div class="col-md-9 my-2 my-md-0 px-2 d-flex flex-column justify-content-between">
                    <div>
                        <h2>TIME</h2>
                        <div class="row my-2">
                            <?php foreach($movie['times'] as $time) : ?>
                            <div class="col-3 col-md-2">
                                <button class="timeBridge">
                                    <?= $time['show_time'] ?>
                                </button>
                            </div>
                            <?php endforeach ; ?>
                        </div>
                        <h2>CASTS</h2>
                        <?php $casts = explode(', ',$movie['casts']) ?>
                        <ul>
                            <?php foreach($casts as $cast) : ?>
                            <li><?= $cast ?></li>
                            <?php endforeach ; ?>
                        </ul>
                    </div>
                    <div class="d-flex flex-column flex-md-row justify-content-md-between">
                        <h2>Directed by - <?= $movie['director'] ?></h2>
                        <a href="/bookings/step1?movie=<?= $movie['slug']  ?>">
                            <button class="btn">
                                Book
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach ; ?>
</div>


<?php require_once __DIR__ . "/layouts/footer.php" ?>