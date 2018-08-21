<?php
  if(!$_SESSION['isAdmin'])
    exit("Authentication required!");
?>


<?php 
  if (!isset($_GET['brandId'])) {
?>
<div class="card">
  <div class="card-header">
    <h5 class="card-title mb-0">Edit brand</h5>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table">
        <thead class="thead-light">
          <tr>
            <th scope="col"><i class="fas fa-cog text-center"></i></th>
            <th scope="col">Name</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            $brands = mysqli_query($connection, "SELECT * FROM brands");
            if ($brands->num_rows > 0) {
              while($brand = $brands->fetch_assoc()) {
                echo "<tr>";
                  echo "<td><a href='index.php?brand_settings=edit&brandId={$brand['BrandID']}' class='btn btn-sm btn-primary'><i class='fas fa-edit mr-2'></i>Edit</a></td>";
                  echo "<td>{$brand['BrandName']}</td>";
                echo "</tr>";
              }
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php 
  } else {
    $brandId = $_GET['brandId'];
    $selectedBrand = mysqli_query($connection, "SELECT * FROM brands WHERE BrandID = '$brandId'");

    if ($selectedBrand->num_rows > 0) {
      $brand = $selectedBrand->fetch_assoc();
?>

<div class="card">
  <div class="card-header">
    <h5 class="card-title mb-0"><?php echo "{$brand['BrandName']}"; ?></h5>
  </div>
  <form id="editBrandForm">
    <input type="hidden" name="brandId" value="<?php echo $brandId ?>">
    <div class="card-body">
      <div class="form-group row">
        <div class="col-lg-2">
          <label class="col-form-label">Brand name</label>
        </div>
        <div class="col-lg-10">
          <input type="text" name="name" placeholder="Brand name" class="form-control" value="<?php echo "{$brand['BrandName']}"; ?>" required>
        </div>
      </div>
    </div>
    <div class="card-footer text-right">
      <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save mr-2" aria-hidden="true"></i>Save</button>
    </div>
  </form>
</div>


<?php 
    } else {
        echo "<h4 class='text-center text-danger'>No results found..</h4>"; 
    }

}
?>