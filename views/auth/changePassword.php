<?php $title = "Change Password" ?>
<?php require_once __DIR__ . "/../layouts/header.php" ?>
<?php require_once __DIR__ . "/../nav.php" ?>
<!-- enter your html -->
<div class="container main">
    <div class="row">
        <div class="offset-md-4 col-md-4">
            <div class="movieHeader py-2 mb-4">
                <h1 class="movieName">Change Password</h1>
            </div>
            <form action="/change-password" method="POST" class="mb-5 d-flex flex-column">
                <input required class="mb-4 input" type="password" name="old_password" placeholder="Old Password">
                <input required class="mb-4 input" type="password" name="new_password" placeholder="New Password">
                <input required class="mb-4 input" type="password" name="com_password" placeholder="Comfirm Password">
                <button class="btn">Change Password</button>
            </form>            
        </div>
    </div>
</div>

<?php require_once __DIR__ . "/../layouts/footer.php" ?>