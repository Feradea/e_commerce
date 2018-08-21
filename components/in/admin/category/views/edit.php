<?php
  if(!$_SESSION['isAdmin'])
    exit("Authentication required!");
?>


<?php 
  if (!isset($_GET['categoryId'])) {
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
            $categories = mysqli_query($connection, "SELECT * FROM categories");
            if ($categories->num_rows > 0) {
              while($category = $categories->fetch_assoc()) {
                echo "<tr>";
                  echo "<td><a href='index.php?category_settings=edit&categoryId={$category['CategoryID']}' class='btn btn-sm btn-primary'><i class='fas fa-edit mr-2'></i>Edit</a></td>";
                  echo "<td>{$category['CategoryName']}</td>";
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
    $categoryId = $_GET['categoryId'];
    $selectedCategory = mysqli_query($connection, "SELECT * FROM categories WHERE CategoryID = '$categoryId'");

    if ($selectedCategory->num_rows > 0) {
      $category = $selectedCategory->fetch_assoc();
?>

<div class="card">
  <div class="card-header">
    <h5 class="card-title mb-0"><?php echo "{$category['CategoryName']}"; ?></h5>
  </div>
  <form id="editCategoryForm">
    <input type="hidden" name="categoryId" value="<?php echo $categoryId ?>">
    <div class="card-body">
      <div class="form-group row">
        <div class="col-lg-2">
          <label class="col-form-label">Category name</label>
        </div>
        <div class="col-lg-10">
          <input type="text" name="name" placeholder="Category name" class="form-control" value="<?php echo "{$category['CategoryName']}"; ?>" required>
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