<?php 
    $admin_routes = [];
    // $admin_routes[] = ['route'=>'/admin/create-movie','name'=>'Create Movie Schdule'];
    $admin_routes[] = ['route'=>'/admin/show-time-and-genre','name'=>'
    <div class="d-flex flex-column text-center">
    <i class="fa-solid fa-calendar-check mb-1"></i>
    Time&Genre
    </div>
    '];
    $admin_routes[] = ['route'=>'/admin/view-movies','name'=>'
    <div class="d-flex flex-column text-center">
    <i class="fa-solid fa-film mb-1"></i>
    Movies
    </div>
    '];
    $admin_routes[] = ['route'=>'/admin/view-bookings','name'=>'
    <div class="d-flex flex-column text-center">
    <i class="fa-solid fa-list mb-1"></i>
    Order List
    </div>
    '];
?>
<div class="fixed-bottom d-md-none">
    <div class="container d-flex text-center justify-content-between py-2 px-3 mobileNav">
        <?php foreach($admin_routes as $route) : ?>
            <a href="<?= $route['route'] ?>"><?= $route['name'] ?></a>
        <?php endforeach; ?>
    </div>
</div>