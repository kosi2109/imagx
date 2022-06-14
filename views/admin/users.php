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
                        <button class="btn">Search</button>
                    </div>
                </div>
            </form>
            <?php if (count($users) > 0) : ?>
                <div class="table-responsive">
                    <table class="table table-dark align-middle">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Full Name</th>
                                <th scope="col">Username</th>
                                <th scope="col">Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $key => $user) : ?>
                                <tr>
                                    <th scope="row"><?= $key+1 ?></th>
                                    <td><?= $user['full_name'] ?></td>
                                    <td><?= $user['username'] ?></td>
                                    <td><?= $user['email'] ?></td>
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