<?php 
    $admin_routes = [];
    $admin_routes[] = ['route'=>'/admin/show-time-and-genre','name'=>'Show Time & genre'];
    $admin_routes[] = ['route'=>'/admin/view-movies','name'=>'Movies'];
    $admin_routes[] = ['route'=>'/admin/view-bookings','name'=>'Bookings'];
    $admin_routes[] = ['route'=>'/admin/view-users','name'=>'Users'];
?>
<div class="d-flex flex-column text-center justify-content-between px-3 adminNav">
    <?php foreach($admin_routes as $route) : ?>
        <a href="<?= $route['route'] ?>" class="py-4"><?= $route['name'] ?></a>
    <?php endforeach; ?>
    <form class="d-none d-md-block d-lg-none" action="/logout" method="POST">
        <button class="py-4" style="background-color: inherit ;border:none;outline:none;color:var(--white)">Logout</button>
    </form>
</div>