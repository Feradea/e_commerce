<?php
  if(!$_SESSION['isAdmin'])
    exit("Authentication required!");
?>
<div class="card">
  <div class="card-header">
    <h5 class="mb-0 card-title">Delete product</h5>
  </div>
  <form id="deleteProductForm">
    <div class="card-body">
      <div class="form-group row">
        <div class="col-lg-2">
          <label class="col-form-label">Select product</label>
        </div>
        <div class="col-lg-10">
          <select name="productToDelete" class="custom-select">
            <?php
              $products = mysqli_query($connection, "SELECT * FROM products");

              if ($products->num_rows > 0) {
                while($product = $products->fetch_assoc()) {
                  echo "<option value=\"{$product['ProductID']}\">{$product['ProductName']}</option>";
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