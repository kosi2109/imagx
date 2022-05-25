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
            <h4>VENOM</h4>
            <h3>Show Time</h3>
            <h4>3 : 00 PM</h4>
            <h3>Date</h3>
            <h4>January , 21</h4>
        </div>
        <div class="col-md-6 mb-3">
            <h3>Detail</h3>
            <div class="d-flex justify-content-between">
                <h4>A2 to A7</h4>
                <h4>5000 x 4 = 20000 Ks</h4>
            </div>

            <div class="mt-5 total d-flex justify-content-between">
                <h4>Total</h4>
                <h4>20000 Ks</h4>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-4 d-flex justify-content-center align-items-center">
            <a href="/bookings/step1">
                <button class="bookingStep">CHOOSE SEAT</button>
            </a>
        </div>
        <div class="col-4 d-flex justify-content-center align-items-center">
            <h4 class="curStep text-center"><span>02</span> PURCHASE</h4>
        </div>
        <div class="col-4 d-flex justify-content-center align-items-center">
            <a href="/bookings/step3">
                <button class="bookingStep">COMFIRM</button>
            </a>
        </div>
    </div>
</div>

<?php require_once __DIR__ . "/layouts/footer.php" ?>