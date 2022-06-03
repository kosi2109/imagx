<?php $title = "02 Purchase" ?>
<?php require_once __DIR__ . "/layouts/header.php" ?>
<?php require_once __DIR__ . "/nav.php" ?>
<!-- enter your html -->
<div class="container main">
    <div class="movieHeader py-2 mb-2">
        <h1 class="movieName">PLease Double Check Before Comfirm</h1>
    </div>
    <div class="row purchase">
        <div class="col-md-6 mb-3">
            <h3>Movie Name</h3>
            <h4><?= $movie['name'] ?></h4>
            <h3>Show Time</h3>
            <h4><?= $time ?></h4>
            <h3>Date</h3>
            <h4><?= $date ?></h4>
        </div>
        <div class="col-md-6 mb-3">
            <h3>Detail</h3>
            <!-- caculate total  -->
            <?php $grand_total = 0; ?>
            <?php foreach ($seats as $key => $seat) : ?>
                <div class="d-flex justify-content-between">
                    <?php
                    $se_string = "";
                    foreach ($seat as $st) {
                        $se_string .= "$st,";
                    }
                    $se_string = rtrim($se_string, ',');
                    ?>


                    <h4><?= $se_string ?></h4>
                    <?php
                    $seats_count = count($seat);
                    $seat_price = get_seat_price($key);
                    $total = $seats_count * $seat_price;
                    $grand_total += $total;
                    ?>
                    <h4><?= $seat_price ?> x <?= $seats_count ?> = <?= $total ?> Ks</h4>
                </div>
            <?php endforeach; ?>


            <div class="mt-5 total d-flex justify-content-between">
                <h4>Total</h4>
                <h4><?= $grand_total ?> Ks</h4>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-4 d-flex justify-content-center align-items-center">
            <a href="/bookings/step1?movie=<?= $movie['name'] ?>">
                <button class="bookingStep">CHOOSE SEAT</button>
            </a>
        </div>
        <div class="col-4 d-flex justify-content-center align-items-center">
            <h4 class="curStep text-center"><span>02</span> PURCHASE</h4>
        </div>
        <div class="col-4 d-flex justify-content-center align-items-center">
            <form method="POST">
                <input type="hidden" name="movie_name" value="<?= $movie['name'] ?>">
                <button class="bookingStep" <?= empty($seats) ? "disabled" : "" ?>>COMFIRM</button>
            </form>
        </div>
    </div>
</div>


<?php require_once __DIR__ . "/layouts/footer.php" ?>