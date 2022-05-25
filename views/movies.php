<?php $title = "Movies" ?>
<?php require_once __DIR__ . "/layouts/header.php" ?>
<?php require_once __DIR__ . "/nav.php" ?>
<!-- enter your html -->
<div class="container main">
    <div class="movieHeader py-2 mb-2">
        <h1 class="movieName">Showing</h1>
    </div>
    <div class="row">
        <div class="col-md-3 p-2">
            <?php require __DIR__ . "/components/card.php" ?>
        </div>
        <div class="col-md-3 p-2">
            <div class="movieCard">
                <div>
                    <img class="thumbnail" src="<?= asset('/assets/thumbnail2.jpg') ?>" alt="">
                </div>
                <div class="card-bd my-2">
                    <h2>Venom</h2>
                    <h3>120min | superhero</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 p-2">
            <?php require __DIR__ . "/components/card.php" ?>
        </div>
        <div class="col-md-3 p-2">
            <?php require __DIR__ . "/components/card.php" ?>
        </div>
        <div class="col-md-3 p-2">
            <?php require __DIR__ . "/components/card.php" ?>
        </div>
    </div>

    <div class="movieHeader py-2 mb-2">
        <h1 class="movieName">Comming Soon</h1>
    </div>
    <div class="row">
        <div class="col-md-3 p-2">
            <?php require __DIR__ . "/components/card.php" ?>
        </div>
        <div class="col-md-3 p-2">
            <?php require __DIR__ . "/components/card.php" ?>
        </div>
    </div>
</div>

<?php require_once __DIR__ . "/layouts/footer.php" ?>