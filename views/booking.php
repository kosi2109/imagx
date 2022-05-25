<?php $title = "Schedule" ?>
<?php require_once __DIR__ . "/layouts/header.php" ?>
<?php require_once __DIR__ . "/nav.php" ?>
<!-- enter your html -->
<div class="container main">
    <div class="row">
        <div class="col-md-3">
            <div class="movieDetailCard">
                <img class="thumbnail" src="<?= asset('/assets/thumbnail.jpg') ?>" alt="">
                <div class="p-2">
                    <h3 class="card-title">Director</h3>
                    <p class="card-detail p-0 m-0">Si Thu Htet</p>
                </div>
                <div class="p-2">
                    <h3 class="card-title">Director</h3>
                    <p class="card-detail p-0 m-0">Si Thu Htet , winn haemahn kyaw , si thu hett</p>
                </div>
                <div class="p-2">
                    <h3 class="card-title">Director</h3>
                    <p class="card-detail p-0 m-0">Si Thu Htet</p>
                </div>
            </div>
            <div class="d-none d-md-block mt-2">
                <h5>Description</h5>
                <div class="d-flex flex-column">
                    <div class="d-flex me-2">
                        <img class="me-2" width="20" height="20" src="<?= asset('/assets/taken.png') ?>" alt="">
                        <h6> - Taken</h6>
                    </div>
                    <div class="d-flex me-2">
                        <img class="me-2" width="20" height="20" src="<?= asset('/assets/seat.png') ?>" alt="">
                        <h6> - Available</h6>
                    </div>
                    <div class="d-flex me-2">
                        <img class="me-2" width="20" height="20" src="<?= asset('/assets/available.png') ?>" alt="">
                        <h6> - Selected</h6>
                    </div>
                </div>
                <h5>Prices</h5>
                <div class="d-flex me-2">
                    <h6>A to C</h6>
                    <h6> - 5000 Ks</h6>
                </div>
                <div class="d-flex me-2">
                    <h6>D to F</h6>
                    <h6> - 3500 Ks</h6>
                </div>
                <div class="d-flex me-2">
                    <h6>G to J</h6>
                    <h6> - 2000 Ks</h6>
                </div>
            </div>

        </div>
        <div class="col-md-9 px-md-5">
            <div class="movieHeader py-2 mb-2">
                <h1 class="movieName">Venom</h1>
            </div>
            <div class="row mt-3">
                <div class="col-md-6 user-select-none">
                    <h3 class="dateTitle">Tuesday , 4 May</h3>
                    <div class="d-flex justify-content-start align-items-center">
                        <div class="date me-3 d-flex flex-column align-items-center justify-content-center">
                            <h4 class="dateItem p-0 m-0">MON</h4>
                            <h4 class="dateItem p-0 m-0">1</h4>
                        </div>
                        <div class="me-3 d-flex flex-column align-items-center justify-content-center">
                            <h4 class="dateItem p-0 m-0">TUE</h4>
                            <h4 class="dateItem p-0 m-0 active">2</h4>
                        </div>
                        <div class="me-3 d-flex flex-column align-items-center justify-content-center">
                            <h4 class="dateItem p-0 m-0">WED</h4>
                            <h4 class="dateItem p-0 m-0">3</h4>
                        </div>
                        <div class="me-3 d-flex flex-column align-items-center justify-content-center">
                            <h4 class="dateItem p-0 m-0">TUE</h4>
                            <h4 class="dateItem p-0 m-0">4</h4>
                        </div>
                        <div class="me-3 d-flex flex-column align-items-center justify-content-center">
                            <h4 class="dateItem p-0 m-0">FRI</h4>
                            <h4 class="dateItem p-0 m-0">5</h4>
                        </div>
                        <div class="me-3 d-flex flex-column align-items-center justify-content-center">
                            <h4 class="dateItem p-0 m-0">SAT</h4>
                            <h4 class="dateItem p-0 m-0">6</h4>
                        </div>
                        <div class="me-3 d-flex flex-column align-items-center justify-content-center">
                            <h4 class="dateItem p-0 m-0">SUN</h4>
                            <h4 class="dateItem p-0 m-0">7</h4>
                        </div>
                    </div>

                </div>
                <div class="col-md-6 user-select-none">
                    <h3 class="dateTitle">Show Time</h3>
                    <div class="row">
                        <div class="col-3">
                            <div class="time me-2 p-2">
                                <h4 class="dateItem p-0 m-0 text-center">12:30 PM</h4>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="time me-2 p-2">
                                <h4 class="dateItem active p-0 m-0 text-center">12:30 PM</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="screen mt-4">
                <h5 class="screenText">Screen</h5>
            </div>

            <!-- seats -->
            <div class="seats mt-4">
                <?php
                $letterAscii = ord("J");
                ?>
                <!-- loop seats -->
                <?php foreach (range(0, 9) as $row) : ?>
                    <div class="row text-center mb-1">
                        <div class="col-1 d-flex justify-content-center align-items-center">
                            <h5 class="seatNo">
                                <?= chr($letterAscii)  ?>
                            </h5>
                        </div>
                        <div class="col-10">
                            <div class="row mb-2">
                                <?php foreach (range(1, 12) as $col) : ?>
                                    <?php if ($col == 6) : ?>
                                        <div class="col-1 p-0 p-md-1 left-end-seat">
                                            <img class="seat" src="<?= asset('/assets/seat.png') ?>" alt="">
                                        </div>
                                    <?php elseif ($col == 7) : ?>
                                        <div class="col-1 p-0 p-md-1 right-end-seat">
                                            <img class="seat" src="<?= asset('/assets/seat.png') ?>" alt="">
                                        </div>
                                    <?php else : ?>
                                        <div class="col-1 p-0 p-md-1">
                                            <img class="seat" src="<?= asset('/assets/seat.png') ?>" alt="">
                                        </div>
                                    <?php endif; ?>

                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="col-1 d-flex justify-content-center align-items-center">
                            <h5 class="seatNo">
                                <?= chr($letterAscii)  ?>
                            </h5>
                        </div>
                        <?php $letterAscii--; ?>
                    </div>
                <?php endforeach; ?>

                <div class="row text-center">
                    <div class="col-1"></div>
                    <div class="col-10">
                        <div class="row">
                            <?php foreach (range(1, 12) as $col) : ?>
                                <div class="col-1">
                                    <h5 class="seatNo">
                                        <?= $col  ?>
                                    </h5>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="col-1"></div>
                </div>

            </div>
            <div class="row mt-4">
                <div class="col-4 d-flex justify-content-center align-items-center">
                    <button class="bookingStep">Back</button>
                </div>
                <div class="col-4 d-flex justify-content-center align-items-center">
                    <h4 class="curStep text-center"><span>01</span> CHOOSE SEATS</h4>
                </div>
                <div class="col-4 d-flex justify-content-center align-items-center">
                    <a href="/bookings/step2">
                        <button class="bookingStep">Purchase</button>
                    </a>
                </div>
                
            </div>
            <div class="row mt-3 d-md-none">
                <div class="col-6">
                    <h5>Description</h5>
                    <div class="d-flex flex-column">
                        <div class="d-flex me-2">
                            <img class="me-2" width="20" height="20" src="<?= asset('/assets/taken.png') ?>" alt="">
                            <h6> - Taken</h6>
                        </div>
                        <div class="d-flex me-2">
                            <img class="me-2" width="20" height="20" src="<?= asset('/assets/seat.png') ?>" alt="">
                            <h6> - Available</h6>
                        </div>
                        <div class="d-flex me-2">
                            <img class="me-2" width="20" height="20" src="<?= asset('/assets/available.png') ?>" alt="">
                            <h6> - Selected</h6>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <h5>Prices</h5>
                    <div class="d-flex me-2">
                        <h6>A to C</h6>
                        <h6> - 5000 Ks</h6>
                    </div>
                    <div class="d-flex me-2">
                        <h6>D to F</h6>
                        <h6> - 3500 Ks</h6>
                    </div>
                    <div class="d-flex me-2">
                        <h6>G to J</h6>
                        <h6> - 2000 Ks</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . "/layouts/footer.php" ?>