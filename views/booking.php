<?php $title = "Schedule" ?>
<?php require_once __DIR__ . "/layouts/header.php" ?>
<?php require_once __DIR__ . "/nav.php" ?>
<!-- enter your html -->
<div class="container main">
    <div class="row">
        <div class="col-md-3">
            <div class="movieDetailCard">
                <img class="thumbnail" src="<?= $movie['movie_img'] ?>" alt="">
                <div class="p-2">
                    <h3 class="card-title">Director</h3>
                    <p class="card-detail p-0 m-0"><?= $movie['director'] ?></p>
                </div>
                <div class="p-2">
                    <h3 class="card-title">Casts</h3>
                    <p class="card-detail p-0 m-0"><?= $movie['casts'] ?></p>
                </div>
                <div class="p-2">
                    <h3 class="card-title">Genere</h3>
                    <p class="card-detail p-0 m-0">Action</p>
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
                <h1 class="movieName"><?= $movie['name'] ?></h1>
            </div>
            <div class="row mt-3">
                <div class="col-lg-6 user-select-none">
                    <h3 class="dateTitle">Date</h3>
                    <div class="d-flex justify-content-start align-items-center">
                        <?php foreach ($period as $p) : ?>
                            <div data-date="<?= $p->format('Y-m-d') ?>" class="date me-3 d-flex flex-column align-items-center justify-content-center">
                                <h4 class="dateItem p-0 m-0"><?= $p->format('D') ?></h4>
                                <h4 class="dateItem p-0 m-0"><?= $p->format('d') ?></h4>
                            </div>
                        <?php endforeach; ?>

                    </div>

                </div>
                <div class="col-lg-6 user-select-none">
                    <h3 class="dateTitle">Show Time</h3>
                    <div class="row">
                        <?php foreach ($show_times as $key => $time) : ?>
                            <div class="col-3">
                                <div class="time me-2 p-2">
                                    <h4 class="dateItem p-0 m-0 text-center <?= $key == 0 ? "active" : "" ?> "><?= date('H:i', strtotime($time['show_time'])) ?></h4>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="screen mt-4">
                <h5 class="screenText">Screen</h5>
            </div>

            <!-- seats -->
            <div class="seats mt-4">
                <!-- start alpha from J -->
                <?php $letterAscii = ord("J"); ?>

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
                                    <!-- middle seat -->
                                    <?php if ($col == 6) : ?>
                                        <div class="col-1 p-0 p-md-1 left-end-seat">
                                            <img class='me-2 seat' data-seat="<?= chr($letterAscii) . $col ?>" width='20' height='20' src="<?= asset('assets/seat.png') ?>" alt='image'>

                                        </div>
                                        <!-- middle seat -->
                                    <?php elseif ($col == 7) : ?>
                                        <div class="col-1 p-0 p-md-1 right-end-seat">
                                            <img class='me-2 seat' data-seat="<?= chr($letterAscii) . $col  ?>" width='20' height='20' src="<?= asset('assets/seat.png') ?>" alt='image'>
                                        </div>
                                    <?php else : ?>
                                        <div class="col-1 p-0 p-md-1">
                                            <img class='me-2 seat' data-seat="<?= chr($letterAscii) . $col  ?>" width='20' height='20' src="<?= asset('assets/seat.png') ?>" alt='image'>
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

                    <a href="/bookings/step2?movie=<?= $movie['name'] ?>">
                        <button class="bookingStep" disabled="true" id="purchase">Purchase</button>
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

<script>
    const time = document.querySelectorAll('.time');
    const date = document.querySelectorAll('.date');
    let selected_date;
    let show_time;

    date.forEach((t, i) => {
        if (new Date("<?= $show_date ? $show_date : $today_date ?>").toISOString().slice(0, 10) === t.dataset.date) {
            t.children[1].classList.add('active');
            selected_date = t.dataset.date
        }
        t.addEventListener('click', function() {
            selected_date = t.dataset.date;
            date.forEach((t2, i2) => {
                if (i2 == i) {
                    t2.children[1].classList.add('active');
                } else {
                    t2.children[1].classList.remove('active');
                }
            })
            fetchSeatController();
            fetchSeats();
        })
    })

    time.forEach((t, i) => {
        if (i == 0) {
            show_time = t.innerText;
        }
        t.addEventListener('click', function() {

            time.forEach((t2, i2) => {
                if (i2 == i) {
                    t2.children[0].classList.add('active');
                } else {
                    t2.children[0].classList.remove('active');
                }
            })
            show_time = t.children[0].innerText;
            fetchSeatController();
            fetchSeats();
        })
    })


    function fetchSeats() {
        
        let req = new XMLHttpRequest();
        req.onreadystatechange = function() {
            if (req.readyState == 4 && req.status === 200) {
                addClickEvent(JSON.parse(req.responseText))
            }
        }
        req.open('GET', `/get-seats?movie_name=<?= $movie['name'] ?>&movie_date=${selected_date}&movie_time=${show_time}&movie_id=<?= $movie['id'] ?>`, true);
        req.send();
    }


    let seat_from_session = <?= $selected_seat ?>;
    let seatArray = (seat_from_session) ? seat_from_session : [];

    // disable button if any seat is selected
    function disableBtn() {
        const purchase = document.getElementById('purchase');
        if (seatArray.length == 0) {
            purchase.disabled = true;
        } else {
            purchase.disabled = false;
        }
    }


    function addClickEvent(sold_seats) {
        let seats = document.querySelectorAll('.seat');

        seats.forEach((seat) => {
            let seatNo = seat.dataset.seat;
            let is_sold = sold_seats.includes(seatNo);
            let is_selected = seatArray.includes(seatNo);
            if (is_sold) {
                seat.src = "<?= asset('assets/taken.png') ?>";
            }else if(is_selected){
                seat.src = "<?= asset('assets/available.png') ?>";
            }else{
                seat.src = "<?= asset('assets/seat.png') ?>";
            }
            seat.addEventListener('click', () => {
                seatNo = seat.dataset.seat;
                is_sold = sold_seats.includes(seatNo);
                is_selected = seatArray.includes(seatNo);
                <?php if (!auth()) : ?>
                    Toastify({
                        text: "Please Login to Purchase",
                    }).showToast();
                <?php else : ?>
                    if (is_selected && !is_sold) {
                        seatArray = seatArray.filter(se => se !== seatNo)
                        seat.src = "<?= asset('assets/seat.png') ?>";
                    } else if(!is_selected && !is_sold) {
                        seatArray.push(seatNo)
                        seat.src = "<?= asset('assets/available.png') ?>";
                    }
                    fetchSeatController();
                <?php endif; ?>
                disableBtn();
                console.log(seatArray);
            })
        })
    }


    // seat controller 
    function fetchSeatController() {
        let req = new XMLHttpRequest();

        req.onreadystatechange = function() {
            if (req.readyState == 4 && req.status !== 200) {
                console.log(req.responseText);
            }
        }
        if (seatArray.length > 0) {
            data = `movie=<?= $movie['name'] ?>&date=${selected_date}&time=${show_time}&seats=${seatArray}`;
        } else {
            data = "movie=venom";
        }
        req.open('POST', '/bookings/seathandler', true);
        req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        req.send(data);
    }




    fetchSeats();
    disableBtn();
</script>

<?php require_once __DIR__ . "/layouts/footer.php" ?>