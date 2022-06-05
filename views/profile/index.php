<?php $title = auth()['username'] ?>
<?php require_once __DIR__ . "/../layouts/header.php" ?>
<?php require_once __DIR__ . "/../nav.php" ?>
<!-- enter your html -->
<div class="container main">
    
    <?php if(!empty($bookings)) : ?>
    <div class="movieHeader py-2 mb-2">
        <h1 class="movieName"><?= auth()['username'] ?>'s Order List</h1>
    </div>
    <?php foreach ($bookings as $key => $booking) : ?>
        <div class="row purchase py-5" <?= $key != 0 ? "style='border-top: 1px dotted grey'" : '' ?>  >
            <div class="col-md-6 mb-3">
                <h3>Movie Name</h3>
                <h4><?= $booking['movie_name'] ?></h4>
                <h3>Show Time</h3>
                <h4><?= $booking['show_time'] ?></h4>
                <h3>Date</h3>
                <h4><?= $booking['date'] ?></h4>
            </div>
            <div class="col-md-6 mb-3">
                <h3>Detail</h3>
                <!-- caculate total  -->
                <?php $grand_total = 0; ?>
                <?php foreach ($booking['seats'] as $key => $seat) : ?>
                    <div class="d-flex justify-content-between">
                        <!-- group the same row(A1,A2,A3) -->
                        <?php
                        $se_string = "";
                        foreach ($seat as $st) {
                            $se_string .= "$st,";
                        }
                        $se_string = rtrim($se_string, ',');
                        ?>
                        <h4><?= $se_string ?></h4>

                        <!-- caculation -->
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
        <?php endforeach; ?>
    <?php else : ?>
        <div class="complete">
            <h2>No Order to show "<?= auth()['username'] ?>"</h2>
            <a href="/schedule">
                <button class="btn">Book Now</button>
            </a>
        </div>
    <?php endif ; ?>
</div>


<?php require_once __DIR__ . "/../layouts/footer.php" ?>