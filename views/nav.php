<div class="nav py-3 fixed-top <?= $_SERVER["REQUEST_URI"] == "/" ? "homeNav"  : "" ?>">
    <div class="container d-flex flex-row justify-content-between" style="height: 100%;">
        <div class="logocontainer">
            <h2 class="logo">IMAG<span>X</span></h2>
            <h3>Cinema</h3>
        </div>
        <div class="d-flex leftNav align-items-start">
            <ul class="nav-links d-flex justify-content-between">
                <li><a href="/" class="nav-link">Home</a></li>
                <li><a href="/schedule" class="nav-link">Schedule</a></li>
                <li><a href="/movies" class="nav-link">Movies</a></li>
            </ul>
            <?php if($_SESSION['auth']) :?>
                <form action="/logout" method="POST">
                    <button class="btn signinBtn">Logout</button>
                </form>
            <?php else:?>
                <a href="/login">
                    <button class="btn signinBtn">Login</button>
                </a>
            <?php endif ; ?>
        </div>
        <button id="burger" class="burger">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </button>
    </div>
</div>