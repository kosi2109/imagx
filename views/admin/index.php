<?php $title = 'Admin Dashboard' ?>
<?php require_once __DIR__ . "/../layouts/header.php" ?>
<?php require_once __DIR__ . "/../nav.php" ?>
<!-- enter your html -->
<div class="container main">
    <div class="row">
        <div class="d-none d-md-block col-md-5 col-lg-4">
            <?php require_once __DIR__ . "/adminNav.php" ?>
        </div>
        <div class="col-12 col-md-7 col-lg-8">
            <a href="/admin/create-movie">
                <button class="btn mb-2">Create</button>
            </a>
            <div class="row">
                <?php foreach ($movies as $movie) : ?>
                    <div class="col-md-4 col-lg-3 p-2 mb-3">
                        <a href="/admin/edit-movie?slug=<?= $movie['slug'] ?>">
                            <div class="movieCard">
                                <div class="mov_img">
                                    <img src="<?= $movie['movie_img'] ?>" alt="<?= $movie['name'] ?>">
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
    <?php require_once __DIR__ . "/mobileNav.php" ?>   
</div>


<?php require_once __DIR__ . "/../layouts/footer.php" ?>