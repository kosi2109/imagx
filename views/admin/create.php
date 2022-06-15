<?php

use Carbon\Carbon;

$title = 'Create Movie' ?>
<?php require_once __DIR__ . "/../layouts/header.php" ?>
<?php require_once __DIR__ . "/../nav.php" ?>

<!-- enter your html -->
<div class="container main">
    <div class="row">
        <div class="d-none d-md-block col-md-5 col-lg-4">
            <?php require_once __DIR__ . "/adminNav.php" ?>
        </div>
        <div class="col-12 col-md-7 col-lg-8">
            <form method="POST" enctype="multipart/form-data">
                <h2>Create Movie</h2>
                <div class="d-flex flex-column flex-md-row justify-content-between">
                    <div class="d-flex flex-column input-div">
                        <label for="name">Movie Name</label>
                        <input id="name" value="<?= old('name') ? old('name') : "" ?>" class="text-black" type="text" name="name">
                    </div>
                    <div class="d-flex flex-column input-div">
                        <label for="slug">Slug</label>
                        <input id="slug" value="<?= old('slug') ? old('slug') : "" ?>" class="text-black" type="text" name="slug">
                    </div>
                </div>

                <div class="d-flex flex-column flex-md-row justify-content-between">
                    <div class="d-flex flex-column input-div">
                        <label for="start_date">Start From</label>
                        <input id="start_date" value="<?= old('start_date') ? old('start_date') : "" ?>" class="text-black" type="date" name="start_date">
                    </div>
                    <div class="d-flex flex-column input-div">
                        <label for="end_date">End</label>
                        <input id="end_date" value="<?= old('end_date') ? old('end_date') : "" ?>" class="text-black" type="date" name="end_date">
                    </div>
                </div>

                <div class="d-flex flex-column flex-md-row justify-content-between mb-3">

                    <div class="d-flex flex-column input-div">
                        <label for="movie_pg">PG</label>
                        <input id="movie_pg" value="<?= old('movie_pg') ? old('movie_pg') : "" ?>" class="text-black" type="text" name="movie_pg">
                    </div>


                    <div class="d-flex flex-column input-div">
                        <label for="director">Director</label>
                        <input id="director" value="<?= old('director') ? old('director') : "" ?>" class="text-black" type="text" name="director">
                    </div>
                </div>
                <div class="d-flex flex-column input-div">
                    <label for="casts">Casts (use comma between them)</label>
                    <input id="casts" value="<?= old('casts') ? old('casts') : "" ?>" class="text-black" type="text" name="casts">
                </div>
                <div class="d-flex flex-column flex-md-row justify-content-between mb-3">
                    <div class="d-flex flex-column input-div">
                        <label for="runtime">Runtime</label>
                        <input id="runtime" value="<?= old('runtime') ? old('runtime') : "" ?>" class="text-black" min='30' type="number" name="runtime">
                    </div>
                    <div class="d-flex flex-column input-div">
                        <label for="can_book_at">Book at</label>
                        <input id="can_book_at" value="<?= old('can_book_at') ? old('can_book_at') : "" ?>" class="text-black" type="date" name="can_book_at">
                    </div>
                </div>

                <div class="d-flex flex-column justify-content-between mb-3">
                    <div class="form-check form-switch">
                        <input name="use_url" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                        <label class="form-check-label" for="flexSwitchCheckDefault">Use Image Url</label>
                    </div>
                    <div class="d-flex flex-column">
                        <input id="movie_img" class="text-black form-control" type="file" name="movie_img">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label style="font-size: 1.2rem;">Show Time</label>
                        <div class="row">
                            <?php $old_times = old("times") ? old("times") : []  ?>
                            <?php foreach ($times as $time) : ?>
                                <div class="col-4 d-flex align-items-center">
                                    <input class="form-check-input me-2" <?= in_array($time['id'], $old_times) ? 'checked' : "" ?> name="times[]" id="t-<?= $time['id'] ?>" type="checkbox" value="<?= $time['id'] ?>">
                                    <label class="form-check-label" for="t-<?= $time['id'] ?>"><?php $t = new Carbon($time['show_time']);
                                                                                                echo $t->format("g:i a") ?></label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label style="font-size: 1.2rem;">genre</label>
                        <div class="row">
                            <?php $old_genres = old("genres") ? old("genres") : []  ?>
                            <?php foreach ($genres as $genre) : ?>
                                <div class="col-4 d-flex align-items-center">
                                    <input class="form-check-input me-2" <?= in_array($genre['id'], $old_genres) ? 'checked' : "" ?> name="genres[]" id="g-<?= $genre['id'] ?>" type="checkbox" value="<?= $genre['id'] ?>">
                                    <label class="form-check-label" for="g-<?= $genre['id'] ?>"><?= $genre['genre'] ?></label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <button class="btn">
                    Create
                </button>
            </form>
        </div>
    </div>
    <?php require_once __DIR__ . "/mobileNav.php" ?>
</div>

<script>
    const movie_img  = document.getElementById('movie_img');
    const swit = document.getElementById('flexSwitchCheckDefault');
    swit.addEventListener('change',()=>{
        if(swit.checked){
            movie_img.setAttribute('type','text')
        }else{
            movie_img.setAttribute('type','file')
        }
    })

    if(swit.checked){
            movie_img.setAttribute('type','text')
    }else{
            movie_img.setAttribute('type','file')
    }

</script>

<?php require_once __DIR__ . "/../layouts/footer.php" ?>