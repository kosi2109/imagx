<?php $title = "Login" ?>
<?php require_once __DIR__ . "/../layouts/header.php" ?>
<?php require_once __DIR__ . "/../nav.php" ?>
<!-- enter your html -->
<div class="container main">
    <div class="row">
        <div class="offset-md-4 col-md-4">
            <div class="movieHeader py-2 mb-4">
                <h1 class="movieName">Login</h1>
            </div>
            <form action="/login" method="POST" class="mb-5 d-flex flex-column">
                <input required value="<?= $_SESSION["error"]["username"] ? $_SESSION["error"]["username"]  : '' ?>" class="mb-4 input" type="text" name="username" placeholder="Username">
                <input required class="mb-4 input" type="password" name="password" placeholder="Password">
                <button class="authBtn">Login</button>
            </form>
            
            <h5 class="formChangeText">You don’t have an account ? <a href="/register">Register</a></h5>
        </div>
    </div>
</div>
<script>
    <?php if(error("message")) :?>
        Toastify({
        text: "<?= error("message") ?>",
        }).showToast();
        <?php unset($_SESSION["error"]) ; ?>
    <?php endif ;?>

    <?php if(isset($_SESSION["success"])) :?>
        Toastify({
        text: "<?= $_SESSION["success"] ?>",
        }).showToast();
        <?php unset($_SESSION["success"]) ; ?>
    <?php endif ;?>
</script>
<?php require_once __DIR__ . "/../layouts/footer.php" ?>