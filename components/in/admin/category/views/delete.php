<?php
  if(!$_SESSION['isAdmin'])
    exit("Authentication required!");
?>

<div class="card">
  <div class="card-header">
    <h5 class="mb-0 card-title">Delete category</h5>
  </div>
  <form id="deleteCategoryForm">
    <div class="card-body">
      <div class="form-group row">
        <div class="col-lg-2">
          <label class="col-form-label">Select category</label>
        </div>
        <div class="col-lg-10">
          <select name="categoryToDelete" class="custom-select">
            <?php
              $categories = mysqli_query($connection, "SELECT * FROM categories");

              if ($categories->num_rows > 0) {
                while($category = $categories->fetch_assoc()) {
                  echo "<option value=\"{$category['CategoryID']}\">{$category['CategoryName']}</option>";
                }
              } else {
                echo "<option disabled>No results found</option>";
              }
            ?>
          </select>
        </div>
      </div>
    </div>
    <div class="card-footer text-right">
      <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt mr-2"></i>Delete</button>
    </div>
  </form>
</div>