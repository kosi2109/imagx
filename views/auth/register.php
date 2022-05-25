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
            <form action="/" class="mb-5 d-flex flex-column">
                <input class="mb-4 input" type="text" name="username" placeholder="Username">
                <input class="mb-4 input" type="password" name="password" placeholder="Password">
                <input class="mb-4 input" type="password" name="password" placeholder="Comfirm Password">
                <button class="authBtn">Register</button>
            </form>
            <h5 class="formChangeText">Do you already have an account ? <a href="/login">Login</a></h5>
        </div>
    </div>
</div>

<?php require_once __DIR__ . "/../layouts/footer.php" ?>