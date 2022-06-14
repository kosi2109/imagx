<?php $title = "Schedule" ?>
<?php require_once __DIR__ . "/layouts/header.php" ?>
<?php require_once __DIR__ . "/nav.php" ?>
<!-- enter your html -->
<div class="container main">
    <div class="row">
        <div class="col-md-4 col-lg-3">
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
                    <h3 class="card-title">Genre</h3>
                    <p class="card-detail p-0 m-0">
                        <?php $string = ''; ?>
                        <?php foreach ($genres as $genre) : ?>
                            <?php
                            $string .= $genre['genre'] . " , ";
                            ?>
                        <?php endforeach; ?>
                        <?= rtrim($string, ", ") ?>
                    </p>
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
        <div class="col-md-8 col-lg-9 px-md-5">
            <div class="movieHeader py-2 mb-2">
                <h1 class="movieName"><?= $movie['name'] ?></h1>
            </div>
            <div class="row mt-3">
                <div class="col-lg-6 user-select-none">
                    <h3 class="dateTitle"><?= $movie['start_date'] ." to ".  $movie['end_date']  ?> </h3>
                    <div class="d-flex justify-content-start align-items-center">
                        <button id="dateScrollBacBtn" class="dateScrollBtn">
                            <i class="fa-solid fa-caret-left"></i>
                        </button>
                        <div id="dateContainer" class="d-flex justify-content-start align-items-center dateContainer">
                            <?php foreach ($period as $key => $p) : ?>
                                <?php if ($key == 0) : ?>
                                    <div id="firstDate" data-date="<?= $p->format('Y-m-d') ?>" class="date d-flex flex-column align-items-center justify-content-center">
                                        <h4 class="dateItem p-0 m-0"><?= $p->format('D') ?></h4>
                                        <h4 class="dateItem p-0 m-0"><?= $p->format('d') ?></h4>
                                    </div>
                                <?php elseif (count($period) == $key + 1) : ?>
                                    <div id="lastDate" data-date="<?= $p->format('Y-m-d') ?>" class="date d-flex flex-column align-items-center justify-content-center">
                                        <h4 class="dateItem p-0 m-0"><?= $p->format('D') ?></h4>
                                        <h4 class="dateItem p-0 m-0"><?= $p->format('d') ?></h4>
                                    </div>
                                <?php else : ?>
                                    <div data-date="<?= $p->format('Y-m-d') ?>" class="date d-flex flex-column align-items-center justify-content-center">
                                        <h4 class="dateItem p-0 m-0"><?= $p->format('D') ?></h4>
                                        <h4 class="dateItem p-0 m-0"><?= $p->format('d') ?></h4>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                        <button id="dateScrollNexBtn" class="dateScrollBtn">
                            <i class="fa-solid fa-caret-right"></i>
                        </button>
                    </div>

                </div>
                <div class="col-lg-6 user-select-none">
                    <h3 class="dateTitle">Show Time</h3>
                    <div class="row">
                        <?php foreach ($show_times as $key => $time) : ?>
                            <div class="col-3">
                                <div class="time me-2 p-2">
                                    <h4 class="timeItem p-0 m-0 text-center <?= $key == 0 ? "active" : "" ?> "><?= date('H:i', strtotime($time['show_time'])) ?></h4>
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
                                    <div class="col-1 p-0 p-md-1">
                                        <img class='me-2 seat' data-seat="<?= chr($letterAscii) . $col  ?>" width='20' height='20' src="<?= asset('assets/seat.png') ?>" alt='image'>
                                    </div>
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

                    <a href="/bookings/step2?movie=<?= $movie['slug'] ?>">
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

<!-- i want to use data from php so i did't split -->
<script>
    const time = document.querySelectorAll('.time');
    const date = document.querySelectorAll('.date');
    const seats = document.querySelectorAll('.seat');
    let selected_date;
    let show_time;
    let seat_from_session = <?= $selected_seat ?>;
    let seatArray = (seat_from_session) ? seat_from_session : [];
    var sold_seats = [];
    const dateScrollNexBtn = document.getElementById('dateScrollNexBtn');
    const dateScrollBacBtn = document.getElementById('dateScrollBacBtn');
    const dateContainer = document.getElementById('dateContainer');

    function findFirstOrLastDate() {

        let options = {
            root: dateContainer,
            rootMargin: '0px',
            threshold: 1.0
        }

        let callback = (entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    if (entry.target.id == "firstDate") {
                        dateScrollBacBtn.classList.add('active')
                    }

                    if (entry.target.id == "lastDate") {
                        dateScrollNexBtn.classList.add('active')
                    }
                } else {
                    if (entry.target.id == "firstDate") {
                        dateScrollBacBtn.classList.remove('active')
                    }

                    if (entry.target.id == "lastDate") {
                        dateScrollNexBtn.classList.remove('active')
                    }

                }

            });
        };

        let observer = new IntersectionObserver(callback, options);

        let target = document.getElementById('firstDate');
        let target2 = document.getElementById('lastDate');

        observer.observe(target);
        observer.observe(target2);
    }




    dateScrollNexBtn.addEventListener('click', () => {
        dateContainer.scrollBy((date[0].clientWidth * 6), 0)
    })

    dateScrollBacBtn.addEventListener('click', () => {
        dateContainer.scrollBy(-(date[0].clientWidth * 6), 0)
    })

    // add click event for time and select first date
    date.forEach((t, i) => {
        // select date today 
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
            seatArray = [];
            fetchSeats();
            fetchSeatController();
        })
    })

    if (!selected_date) {
        date[0].children[1].classList.add('active');
        selected_date = date[0].dataset.date
    }

    // add click event for time and select first time
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
            seatArray = [];
            fetchSeats();
            fetchSeatController();
        })
    })


    // fetch seat by date and time
    function fetchSeats() {
        let req = new XMLHttpRequest();
        req.onreadystatechange = function() {
            if (req.readyState == 4 && req.status === 200) {
                sold_seats = JSON.parse(req.responseText);
                renderSeats();
            }
        }
        req.open('GET', `/get-seats?movie_date=${selected_date}&movie_time=${show_time}&movie_id=<?= $movie['id'] ?>`, true);
        req.send();
    }

    // disable button if any seat is selected
    function disableBtn() {
        const purchase = document.getElementById('purchase');
        if (seatArray.length == 0) {
            purchase.disabled = true;
        } else {
            purchase.disabled = false;
        }
    }

    function renderSeats() {
        seats.forEach((seat) => {
            let seatNo = seat.dataset.seat;
            let is_sold = sold_seats.includes(seatNo);
            let is_selected = seatArray.includes(seatNo);
            if (is_sold) {
                seat.src = "<?= asset('assets/taken.png') ?>";
            } else if (is_selected) {
                seat.src = "<?= asset('assets/available.png') ?>";
            } else {
                seat.src = "<?= asset('assets/seat.png') ?>";
            }
        })
    }

    // click event for seat and render seat conditionally
    function addClickEvent() {

        seats.forEach((seat) => {
            seat.addEventListener('click', () => {
                // fontend check for sold seats
                <?php if (auth()) : ?>
                    let seatNo = seat.dataset.seat;
                    let is_sold = sold_seats.includes(seatNo);
                    let is_selected = seatArray.includes(seatNo);
                    if (!is_selected && !is_sold) {
                        seatArray.push(seatNo)
                        seat.src = "<?= asset('assets/available.png') ?>";

                    } else if (is_selected && !is_sold) {
                        seatArray = seatArray.filter(se => se !== seatNo)
                        seat.src = "<?= asset('assets/seat.png') ?>";
                    }
                    fetchSeatController();
                    disableBtn();
                <?php else : ?>
                    Toastify({
                        text: "Login required",
                    }).showToast();
                <?php endif; ?>
            })
        })

    }



    // add selected seats to session  
    function fetchSeatController() {
        let req = new XMLHttpRequest();

        req.onreadystatechange = function() {
            if (req.readyState == 4 && req.status !== 200) {
                console.log(req.responseText);
            }
        }
        if (seatArray.length > 0) {
            data = `movie_slug=<?= $movie['slug'] ?>&date=${selected_date}&time=${show_time}&seats=${seatArray}`;
        } else {
            data = "movie_slug=<?= $movie['slug'] ?>";
        }
        req.open('POST', '/bookings/seathandler', true);
        req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        req.send(data);
    }

    findFirstOrLastDate();
    fetchSeats();
    addClickEvent();
    disableBtn();
</script>

<?php require_once __DIR__ . "/layouts/footer.php" ?>