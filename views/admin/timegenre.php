<?php $title = 'Time & Genre' ?>
<?php require_once __DIR__ . "/../layouts/header.php" ?>
<?php require_once __DIR__ . "/../nav.php" ?>
<!-- enter your html -->
<div class="container main">

  <div class="row">
    <div class="d-none d-md-block col-md-5 col-lg-4">
      <?php require_once __DIR__ . "/adminNav.php" ?>
    </div>
    <div class="col-12 col-md-7 col-lg-8">
      <div class="row mb-3">
        <div class="col-lg-6 mb-3">
          <div class="d-flex justify-content-start align-items-center">
            <h3 class="me-3">Show Times</h3>
            <button type="button" data-type="time" class="btn createBtn" data-bs-toggle="modal" data-bs-target="#createModal">Add</button>
          </div>
          <div class="row">
            <?php foreach ($times as $time) : ?>
              <div class="col-6">
                <div class="d-flex justify-content-start align-items-center py-3">
                  <button data-type="time" data-value="<?= $time['show_time'] ?>" data-id="<?= $time['id'] ?>" class="me-3 edit action warning" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa-solid fa-pen-to-square"></i></button>
                  <button data-type="time" data-id="<?= $time['id'] ?>" class="me-3 delete action danger" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fa-solid fa-trash"></i></button>
                  <h5 class="my-0 me-3"><?= $time['show_time'] ?></h5>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="d-flex justify-content-start align-items-center">
            <h3 class="me-3">Genres</h3>
            <button class="btn createBtn" type="button" data-type="genre" data-bs-toggle="modal" data-bs-target="#createModal">Add</button>
          </div>
          <div class="row">
            <?php foreach ($genres as $genre) : ?>
              <div class="col-6">
                <div class="d-flex justify-content-start align-items-center py-3">
                  <button data-type="genre" data-value="<?= $genre['genre'] ?>" data-id="<?= $genre['id'] ?>" class="me-3 edit action warning" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa-solid fa-pen-to-square"></i></button>
                  <button data-type="genre" data-id="<?= $genre['id'] ?>" class="me-3 delete action danger" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fa-solid fa-trash"></i></button>
                  <h5 class="my-0 me-3"><?= $genre['genre'] ?></h5>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php require_once __DIR__ . "/mobileNav.php" ?>
</div>


<!-- Delete Modal -->
<div class="modal fade " id="deleteModal" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content bg-dark">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModal">Delete Item</h5>
        <button class="modalColse" type="button" data-bs-dismiss="modal" aria-label="Close">
        <i class="fa-solid fa-xmark"></i>
        </button>
      </div>
      <div class="modal-body">
        <form id="deleteForm" action="/admin/delete-time-genre" method="POST">
          <input id="delete-id" type="hidden" name="id">
          <input id="delete-type" type="hidden" name="type">
        </form>
        <p>Are You Sure to Delete ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
        <button type="button" id="deleteComfirm" class="btn">Delete</button>
      </div>
    </div>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal fade " id="editModal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content bg-dark">
      <div class="modal-header">
        <h5 class="modal-title" id="editModal">Edit Item</h5>
        <button class="modalColse" type="button" data-bs-dismiss="modal" aria-label="Close">
        <i class="fa-solid fa-xmark"></i>
        </button>
      </div>
      <div class="modal-body">
        <form id="editForm" action="/admin/update-time-genre" method="POST">
          <input id="edit-id" type="hidden" name="id">
          <input id="edit-type" type="hidden" name="type">
          <input type="text" name="name" class="form-control" id="name">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
        <button type="button" id="editComfirm" class="btn">Edit</button>
      </div>
    </div>
  </div>
</div>

<!-- Create Modal -->
<div class="modal fade " id="createModal" tabindex="-1" aria-labelledby="createModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content bg-dark">
      <div class="modal-header">
        <h5 class="modal-title" id="createModal">Create Item</h5>
        <button class="modalColse" type="button" data-bs-dismiss="modal" aria-label="Close">
        <i class="fa-solid fa-xmark"></i>
        </button>
      </div>
      <div class="modal-body">
        <form id="createForm" action="/admin/create-time-genre" method="POST">
          <input id="createType" type="hidden" name="type">
          <input type="text" name="value" class="form-control" id="name">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
        <button type="button" id="createComfirm" class="btn">Create</button>
      </div>
    </div>
  </div>
</div>



<script>
  const deleteBtns = document.querySelectorAll('.delete');
  const deleteId = document.getElementById('delete-id');
  const deleteType = document.getElementById('delete-type');
  const deleteComfirm = document.getElementById('deleteComfirm');
  const deleteForm = document.getElementById('deleteForm');
  deleteBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      deleteId.value = btn.dataset.id;
      deleteType.value = btn.dataset.type;
    })
  })
  deleteComfirm.addEventListener('click', () => {
    deleteForm.submit();
  })


  const editBtns = document.querySelectorAll('.edit');
  const name = document.getElementById('name');
  const editComfirm = document.getElementById('editComfirm');
  const editForm = document.getElementById('editForm');
  const editId = document.getElementById('edit-id');
  const editType = document.getElementById('edit-type');
  editBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      editId.value = btn.dataset.id;
      editType.value = btn.dataset.type;
      name.value = btn.dataset.value;
    })
  })
  editComfirm.addEventListener('click', () => {
    editForm.submit();
  })

  const createBtn = document.querySelectorAll('.createBtn');
  const createType = document.getElementById('createType');
  const createComfirm = document.getElementById('createComfirm');
  const createForm = document.getElementById('createForm');

  createBtn.forEach((btn) => {
    btn.addEventListener('click', () => {
      createType.value = btn.dataset.type;
    })
  })

  createComfirm.addEventListener('click', () => {
    createForm.submit();
  })
</script>

<?php require_once __DIR__ . "/../layouts/footer.php" ?>