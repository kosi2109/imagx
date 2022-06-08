<?php $title = 'Admin Dashboard' ?>
<?php require_once __DIR__ . "/../layouts/header.php" ?>
<?php require_once __DIR__ . "/../nav.php" ?>
<!-- enter your html -->
<div class="container main">
    <div class="row">
        <div class="col-md-3 d-none d-md-block">
            <?php require_once __DIR__ . "/adminNav.php" ?>
        </div>
        <div class="col-md-9">
            <div class="row">
                <?php foreach($movies as $movie) :?>
                <div class="col-md-3 p-2">
                    <a href="/admin/edit-movie?slug=<?= $movie['slug'] ?>">
                        <div class="movieCard">
                            <div>
                                <img style="width: 100%;height:300px" src="<?= $movie['movie_img'] ?>" alt="<?= $movie['name'] ?>">
                            </div>
                            <div class="card-bd my-2">
                                <h2><?= $movie['name'] ?></h2>
                                <h3><?= $movie['runtime'] ?> mins</h3>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>


<?php require_once __DIR__ . "/../layouts/footer.php" ?>