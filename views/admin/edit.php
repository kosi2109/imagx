<?php

use Carbon\Carbon;

$title = 'Admin Dashboard' ?>
<?php require_once __DIR__ . "/../layouts/header.php" ?>
<?php require_once __DIR__ . "/../nav.php" ?>

<!-- enter your html -->
<div class="container main">
    <div class="row">
        <div class="col-md-4 col-lg-3 d-none d-md-block">
            <?php require_once __DIR__ . "/adminNav.php" ?>
        </div>
        <div class="col-12 col-md-8 col-lg-9">
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $movie['id'] ?>">
                <div class="d-flex flex-column flex-md-row justify-content-between">
                    <div class="d-flex flex-column input-div">
                        <label for="name">Movie Name</label>
                        <input id="name" class="text-black" type="text" value="<?= $movie['name'] ?>" name="name">
                    </div>
                    <div class="d-flex flex-column input-div">
                        <label for="slug">Slug</label>
                        <input id="slug" class="text-black" type="text" value="<?= $movie['slug'] ?>" name="slug">
                    </div>
                </div>

                <div class="d-flex flex-column flex-md-row justify-content-between">
                    <div class="d-flex flex-column input-div">
                        <label for="start_date">Start From</label>
                        <input id="start_date" class="text-black" type="date" value="<?= $movie['start_date'] ?>" name="start_date">
                    </div>
                    <div class="d-flex flex-column input-div">
                        <label for="end_date">End</label>
                        <input id="end_date" class="text-black" type="date" value="<?= $movie['end_date'] ?>" name="end_date">
                    </div>
                </div>

                <div class="d-flex flex-column flex-md-row justify-content-between mb-3">

                    <div class="d-flex flex-column input-div">
                        <label for="movie_pg">PG</label>
                        <input id="movie_pg" class="text-black" type="text" value="<?= $movie['movie_pg'] ?>" name="movie_pg">
                    </div>


                    <div class="d-flex flex-column input-div">
                        <label for="director">Director</label>
                        <input id="director" class="text-black" type="text" value="<?= $movie['director'] ?>" name="director">
                    </div>
                </div>
                <div class="d-flex flex-column input-div">
                    <label for="casts">Casts (use comma between them)</label>
                    <input id="casts" class="text-black" type="text" value="<?= $movie['casts'] ?>" name="casts">
                </div>
                <div class="d-flex flex-column flex-md-row justify-content-between mb-3">
                    <div class="d-flex flex-column input-div">
                        <label for="runtime">Runtime</label>
                        <input id="runtime" class="text-black" min='30' type="number" value="<?= $movie['runtime'] ?>" name="runtime">
                    </div>
                    <div class="d-flex flex-column input-div">
                        <label for="can_book_at">Book at</label>
                        <input id="can_book_at" class="text-black" type="date" value="<?= $movie['can_book_at'] ?>" name="can_book_at">
                    </div>
                </div>

                <div class="d-flex flex-column flex-md-row justify-content-between mb-3">
                    <div class="d-flex ">
                        <img width="15%" src="<?= $movie['movie_img'] ?>" alt="<?= $movie['name'] ?>">
                        <div class="d-flex flex-column justify-content-center input-div">
                            <input id="movie_img" class="text-black" type="file" name="movie_img">
                            <input id="movie_img" value="<?= $movie['movie_img'] ?>" class="text-black" type="text" name="movie_img">
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label style="font-size: 1.2rem;">Show Time</label>
                        <div class="row">
                            <?php foreach ($times as $time) : ?>
                                <div class="col-4 d-flex align-items-center">
                                    <input name="times[]" class="me-2" <?= in_array($time, $show_times) ? 'checked' : "" ?> id="t-<?= $time['id'] ?>" type="checkbox" value="<?= $time['id'] ?>">
                                    <label for="t-<?= $time['id'] ?>"><?php $t = new Carbon($time['show_time']);
                                                                        echo $t->format("g:i a") ?></label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label style="font-size: 1.2rem;">genre</label>
                        <div class="row">
                            <?php foreach ($genres as $genre) : ?>
                                <div class="col-4 d-flex align-items-center">
                                    <input name="genres[]" class="me-2" <?= in_array($genre, $movie_genres) ? 'checked' : "" ?> id="g-<?= $genre['id'] ?>" type="checkbox" value="<?= $genre['id'] ?>">
                                    <label for="g-<?= $genre['id'] ?>"><?= $genre['genre'] ?></label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-start">
                    <button type="button" class="btn me-3" data-bs-toggle="modal" data-bs-target="#deleteModal">
                        Delete
                    </button>
                    <button class="btn">
                        Edit
                    </button>
                </div>
            </form>
            
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade " id="deleteModal" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content bg-dark">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModal">Delete Movie</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form id="deleteForm" action="/admin/delete-movie" method="POST">
                <input type="hidden" name="movie_id" value="<?= $movie['id'] ?>">
            </form>
            <p>Are You Sure to Delete <?= $movie['name'] ?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
        <button type="button" id="deleteComfirm" class="btn">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script>
    const deleteForm = document.getElementById('deleteForm');
    const deleteComfirm = document.getElementById('deleteComfirm');
    deleteComfirm.addEventListener('click',function(){
        deleteForm.submit();    
    })
</script>

<?php require_once __DIR__ . "/../layouts/footer.php" ?>