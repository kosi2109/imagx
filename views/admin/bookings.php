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
            <form>
                <div class="row my-3">
                    <div class="col-lg-3 mb-3">
                        <select name="mid" class="form-control">
                            <option value="" selected>Movie Name</option>
                            <?php foreach ($movies as $movie) : ?>
                                <option <?= $movie['id'] == request('mid') ? "selected" : "" ?> value="<?= $movie['id'] ?>"><?= $movie['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-lg-3 mb-3">
                        <input type="date" value="<?= $today ?>" class="form-control" name="date">
                    </div>
                    <div class="col-lg-3 mb-3">
                        <select name="time" class="form-control">
                            <option value="" selected>Time</option>
                            <?php foreach ($times as $time) : ?>
                                <option <?= $time['show_time'] == request('time') ? "selected" : "" ?> value="<?= $time['show_time'] ?>"><?= $time['show_time'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-lg-3 mb-3">
                        <button class="btn">Search</button>
                    </div>
                </div>
            </form>
            <?php if (count($bookings) > 0) : ?>
                <div class="table-responsive">
                    <table class="table table-dark align-middle">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Cu Name</th>
                                <th scope="col">Seats</th>
                                <th scope="col">Date</th>
                                <th scope="col">Time</th>
                                <th scope="col">Mov Name</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($bookings as $booking) : ?>
                                <tr>
                                    <th scope="row">1</th>
                                    <td><?= $booking['username'] ?></td>
                                    <td><?= $booking['seats'] ?></td>
                                    <td><?= $booking['date'] ?></td>
                                    <td><?= $booking['show_time'] ?></td>
                                    <td><?= $booking['movie_name'] ?></td>
                                    <td><?= $booking['total'] ?></td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>

                </div>
            <?php else : ?>
                <h2>No Data Found</h2>
            <?php endif; ?>
        </div>
    </div>
    <?php require_once __DIR__ . "/mobileNav.php" ?>
</div>


<?php require_once __DIR__ . "/../layouts/footer.php" ?>