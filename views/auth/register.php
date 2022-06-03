<?php $title = "Register" ?>
<?php require_once __DIR__ . "/../layouts/header.php" ?>
<?php require_once __DIR__ . "/../nav.php" ?>
<!-- enter your html -->
<div class="container main">
    <div class="row">
        <div class="offset-md-4 col-md-4">
            <div class="movieHeader py-2 mb-4">
                <h1 class="movieName">Register</h1>
            </div>
            <form action="/register" method="POST" class="mb-5 d-flex flex-column">
                <input required value="<?= old('username') ? old('username') : '' ?>" class="mb-4 input" type="text" name="username" placeholder="Username">
                <input required value="<?= old('full_name') ? old('full_name') : '' ?>" class="mb-4 input" type="text" name="full_name" placeholder="FullName">
                <input required class="mb-4 input" type="password" name="password" placeholder="Password">
                <input required class="mb-4 input" type="password" name="password2" placeholder="Comfirm Password">
                <button class="btn">Register</button>
            </form>
            <h5 class="formChangeText">Do you already have an account ? <a href="/login">Login</a></h5>
        </div>
    </div>
    
</div>

    
<?php require_once __DIR__ . "/../layouts/footer.php" ?>