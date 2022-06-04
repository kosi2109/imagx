<?php $title = "Movies" ?>
<?php require_once __DIR__ . "/layouts/header.php" ?>
<?php require_once __DIR__ . "/nav.php" ?>
<!-- enter your html -->
<div class="container main">
    <div class="movieHeader py-2 mb-2">
        <h1 class="movieName">Showing</h1>
    </div>
    <div class="row">
        <?php foreach($showing as $movie) : ?>
        <div class="col-md-3 p-2">
            <div class="movieCard">
                <div>
                    <img class="thumbnail" src="<?= $movie['movie_img'] ?>" alt="<?= $movie['name'] ?>">
                </div>
                <div class="card-bd my-2">
                    <h2><?= $movie['name'] ?></h2>
                    <h3><?= $movie['runtime'] ?> mins | superhero</h3>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="movieHeader py-2 mb-2">
        <h1 class="movieName">Comming Soon</h1>
    </div>
    <div class="row">
    <?php foreach($comming_soon as $movie) : ?>
        <div class="col-md-3 p-2">
            <div class="movieCard">
                <div>
                    <img class="thumbnail" src="<?= $movie['movie_img'] ?>" alt="<?= $movie['name'] ?>">
                </div>
                <div class="card-bd my-2">
                    <h2><?= $movie['name'] ?></h2>
                    <h3><?= $movie['runtime'] ?> mins | superhero</h3>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require_once __DIR__ . "/layouts/footer.php" ?>