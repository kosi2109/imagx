<?php 
    $admin_routes = [];
    $admin_routes[] = ['route'=>'/admin/create-movie','name'=>'Create Movie Schdule'];
    $admin_routes[] = ['route'=>'/admin/show-time-and-genre','name'=>'View Show Time & genre'];
    $admin_routes[] = ['route'=>'/admin/view-movies','name'=>'View Movie Schedules'];
    $admin_routes[] = ['route'=>'/admin/view-bookings','name'=>'View Bookings'];
?>
<div class="d-flex flex-column text-center adminNav">
    <?php foreach($admin_routes as $route) : ?>
        <a href="<?= $route['route'] ?>" class="py-4"><?= $route['name'] ?></a>
    <?php endforeach; ?>
</div>