<?php $this->view('includes/navigation', ['title' => 'Create task']); ?>
<div class="container-fluid vh-75 mt-4">
  <div class="rounded d-flex justify-content-center">
    <div class="col-md-4 col-sm-12 shadow-lg p-5 bg-light">
      <div class="text-center">
        <h1 class="info">New task</h1>
      </div>
      <?php if (isset($errors) && count($errors) > 0) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Errors:</strong>
          <?php foreach ($errors as $error) : ?>
            <br><?= $error ?>
          <?php endforeach; ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif; ?>
      <div class="p-4">
        <form method="POST" >

          <div class="input-group mb-3">
            <input type="text" name="title" class="form-control" placeholder="Title">
          </div>

          <div class="input-group mb-3">
            <textarea name="description" placeholder="Description" rows="4" class="form-control "></textarea>
          </div>
          <select name="subject" class="form-select mb-3" aria-label="Default select example">
            <option selected>Choose subject</option>
            <?php foreach (POSSIBLE_SUBJECTS as $subject) : ?>
              <option value="<?= $subject ?>"><?= $subject ?></option>

            <?php endforeach; ?>
          </select>
          <select name="type" class="form-select mb-3" aria-label="Default select example">
            <option selected>Choose type</option>
            <?php foreach (TYPES as $type) : ?>
              <option value="<?= $type ?>"><?= $type?></option>

            <?php endforeach; ?>
          </select>

          <div class="input-group mb-3">
            <input type="date" name="deadline" class="form-control" placeholder="Deadline">
          </div>

          <div class="d-grid col-12 mx-auto">
            <input class="btn btn-info" value="Add" type="submit">
          </div>
        
        </form>
      </div>
    </div>
  </div>
</div>
<?php $this->view('includes/footer'); ?>