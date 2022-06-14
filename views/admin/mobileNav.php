<?php 
    $admin_routes = [];
    // $admin_routes[] = ['route'=>'/admin/create-movie','name'=>'Create Movie Schdule'];
    $admin_routes[] = ['route'=>'/admin/show-time-and-genre','name'=>'
    <div class="d-flex m-0 flex-column text-center" style="width : 100%">
    <i class="fa-solid fa-calendar-check mb-1"></i>
    T & G
    </div>
    '];
    $admin_routes[] = ['route'=>'/admin/view-movies','name'=>'
    <div class="d-flex m-0 flex-column text-center" style="width : 100%">
    <i class="fa-solid fa-film mb-1"></i>
    Movies
    </div>
    '];
    $admin_routes[] = ['route'=>'/admin/view-bookings','name'=>'
    <div class="d-flex m-0 flex-column text-center" style="width : 100%">
    <i class="fa-solid fa-list mb-1"></i>
    Order List
    </div>
    '];
    $admin_routes[] = ['route'=>'/admin/view-users','name'=>'
    <div class="d-flex m-0 flex-column text-center justify-content-center align-items-center" style="width : 100%">
    <i class="fa-solid fa-users mb-1"></i>
    Users
    </div>
    '];
?>
<div class="fixed-bottom d-md-none">
    <div style="width: 100%;" class="container d-flex text-center justify-content-between align-items-center py-2 px-3 mobileNav">
        <?php foreach($admin_routes as $route) : ?>
            <a style="width : 25%" href="<?= $route['route'] ?>"><?= $route['name'] ?></a>
        <?php endforeach; ?>
    </div>
</div>