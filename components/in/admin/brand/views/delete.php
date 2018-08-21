<?php
  if(!$_SESSION['isAdmin'])
    exit("Authentication required!");
?>

<div class="card">
  <div class="card-header">
    <h5 class="mb-0 card-title">Delete brand</h5>
  </div>
  <form id="deleteBrandForm">
    <div class="card-body">
      <div class="form-group row">
        <div class="col-lg-2">
          <label class="col-form-label">Select brand</label>
        </div>
        <div class="col-lg-10">
          <select name="brandToDelete" class="custom-select">
            <?php
              $brands = mysqli_query($connection, "SELECT * FROM brands");

              if ($brands->num_rows > 0) {
                while($brand = $brands->fetch_assoc()) {
                  echo "<option value=\"{$brand['BrandID']}\">{$brand['BrandName']}</option>";
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