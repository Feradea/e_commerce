<?php
  if(!$_SESSION['isAdmin'])
    exit("Authentication required!");
?>

<div class="card">
  <div class="card-header">
    <h5 class="card-title">Add category</h5>
  </div>
  <form id="addCategoryForm">
    <div class="card-body">
      <div class="form-group row">
        <div class="col-lg-2">
          <label class="col-form-label">Category name</label>
        </div>
        <div class="col-lg-10">
          <input type="text" name="name" placeholder="Category name" class="form-control" required>
        </div>
      </div>
    </div>
    <div class="card-footer text-right">
      <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save mr-2" aria-hidden="true"></i>Save</button>
    </div>
  </form>
</div>