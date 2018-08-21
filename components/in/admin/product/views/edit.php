<?php
  if(!$_SESSION['isAdmin'])
    exit("Authentication required!");
?>


<?php 
  if (!isset($_GET['productId'])) {
?>
<div class="card">
  <div class="card-header">
    <h5 class="card-title mb-0">Edit product</h5>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table">
        <thead class="thead-light">
          <tr>
            <th scope="col"><i class="fas fa-cog text-center"></i></th>
            <th scope="col">Name</th>
            <th scope="col">Brand</th>
            <th scope="col">Category</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            $products = mysqli_query($connection, "SELECT * FROM products p LEFT JOIN brands b ON p.ProductBrandID_FK = b.BrandID LEFT JOIN categories c ON p.ProductCategoryID_FK = c.CategoryID");
            if ($products->num_rows > 0) {
              while($product = $products->fetch_assoc()) {
                echo "<tr>";
                  echo "<td><a href='index.php?product_settings=edit&productId={$product['ProductID']}' class='btn btn-sm btn-primary'><i class='fas fa-edit mr-2'></i>Edit</a></td>";
                  echo "<td>{$product['ProductName']}</td>";
                  echo "<td>{$product['BrandName']}</td>";
                  echo "<td>{$product['CategoryName']}</td>";
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
    $productId = $_GET['productId'];
    $selectedProduct = mysqli_query($connection, "SELECT * FROM products p LEFT JOIN brands b ON p.ProductBrandID_FK = b.BrandID LEFT JOIN categories c ON p.ProductCategoryID_FK = c.CategoryID WHERE ProductID = '$productId'");

    if ($selectedProduct->num_rows > 0) {
      $product = $selectedProduct->fetch_assoc();
?>

<div class="card">
  <div class="card-header">
    <h5 class="card-title mb-0"><?php echo "{$product['ProductName']}"; ?></h5>
  </div>
  <form id="editProductForm">
    <input type="hidden" name="productId" value="<?php echo $productId ?>">
    <div class="card-body">
      <div class="form-group row">
        <div class="col-lg-2">
          <label class="col-form-label">Brand</label>
        </div>
        <div class="col-lg-10">
          <select name="brandId" class="custom-select">
            <option value="<?php echo "{$product['ProductBrandID_FK']}" ?>" selected><?php echo "{$product['BrandName']}" ?></option>
            <?php 
              $currentBrandId = $product['ProductBrandID_FK'];
              $brands = mysqli_query($connection, "SELECT * FROM brands WHERE BrandID != '$currentBrandId'");

              if($brands->num_rows > 0) {
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
      <div class="form-group row">
        <div class="col-lg-2">
          <label class="col-form-label">Category</label>
        </div>
        <div class="col-lg-10">
          <select name="categoryId" class="custom-select">
            <option value="<?php echo "{$product['ProductCategoryID_FK']}" ?>" selected><?php echo "{$product['CategoryName']}" ?></option>
            <?php 
              $currentCategoryId = $product['ProductCategoryID_FK'];
              $categories = mysqli_query($connection, "SELECT * FROM categories WHERE CategoryID != '$currentCategoryId'");

              if($categories->num_rows > 0) {
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
      <div class="form-group row">
        <div class="col-lg-2">
          <label class="col-form-label">Name</label>
        </div>
        <div class="col-lg-10">
          <input type="text" name="name" placeholder="Product name" class="form-control" value="<?php echo "{$product['ProductName']}"; ?>" required>
        </div>
      </div>
      
      <div class="form-group row">
        <div class="col-lg-2">
          <label class="col-form-label">Weight</label>
        </div>
        <div class="col-lg-10">
          <input type="text" name="weight" placeholder="Product weight" value="<?php echo "{$product['ProductWeight']}" ?>" class="form-control">
        </div>
      </div>
      
      <div class="form-group row">
        <div class="col-lg-2">
          <label class="col-form-label">Weight unit</label>
        </div>
        <div class="col-lg-10">
          <input type="text" name="unit" placeholder="Product weight" value="<?php echo "{$product['ProductWeightUnit']}" ?>" class="form-control">
        </div>
      </div>

      <div class="form-group row">
        <div class="col-lg-2">
          <label class="col-form-label">Short description</label>
        </div>
        <div class="col-lg-10">
          <textarea class="form-control" name="shortDescription" rows="2"><?php echo "{$product['ProductShortDesc']}" ?></textarea>
        </div>
      </div>

      <div class="form-group row">
        <div class="col-lg-2">
          <label class="col-form-label">Long description</label>
        </div>
        <div class="col-lg-10">
          <textarea class="form-control" name="longDescription" rows="4"><?php echo "{$product['ProductLongDesc']}" ?></textarea>
        </div>
      </div>

      <div class="form-group row">
        <div class="col-lg-2">
          <label class="col-form-label">Product properties</label>
        </div>
        <div class="col-lg-10">
          <textarea class="form-control" name="properties" rows="3"><?php echo "{$product['ProductProperties']}" ?></textarea>
        </div>
      </div>

      <div class="form-group row">
        <div class="col-lg-2">
          <label class="col-form-label">Price</label>
        </div>
        <div class="col-lg-10">
          <div class="input-group">
          <input type="number" name="price" placeholder="Price" value="<?php echo "{$product['ProductPrice']}" ?>" class="form-control">
          <div class="input-group-append">
            <span class="input-group-text">RSD</span>
          </div>
          </div>
        </div>
      </div>

      <div class="form-group row">
        <div class="col-lg-2">
          <label class="col-form-label">Promo price</label>
        </div>
        <div class="col-lg-10">
          <div class="input-group">
          <input type="number" name="promoPrice" placeholder="Promo price" value="<?php echo "{$product['ProductPromotionalPrice']}" ?>" class="form-control">
          <div class="input-group-append">
            <span class="input-group-text">RSD</span>
          </div>
          </div>
        </div>
      </div>

      <div class="form-group row">
        <div class="col-lg-2">
          <label class="col-form-label">Stock</label>
        </div>
        <div class="col-lg-10">
          <select name="stock" class="custom-select">
            <option value="<?php echo "{$product['ProductStock']}" ?>"><?php echo "{$product['ProductStock']}" ?></option>
            <option value="null" disabled><hr></option>
            <option value="On Stock">On Stock</option>
            <option value="Out of Stock">Out of Stock</option>
          </select>
        </div>
      </div>
      
      <div class="form-group row">
        <div class="col-lg-2">
          <label class="col-form-label">Quantity</label>
        </div>
        <div class="col-lg-10">
          <input type="number" name="quantity" placeholder="Quantity" value="<?php echo "{$product['ProductQuantity']}" ?>" class="form-control">
        </div>
      </div>

      <div class="form-group row">
        <div class="col-lg-2">
          <label class="col-form-label">SKU</label>
        </div>
        <div class="col-lg-10">
          <input type="number" name="sku" placeholder="SKU" value="<?php echo "{$product['ProductSKU']}" ?>" class="form-control">
        </div>
      </div>

      <div class="form-group row">
        <div class="col-lg-2">
          <label class="col-form-label">Stock</label>
        </div>
        <div class="col-lg-10">
          <select name="status" class="custom-select">
            <option value="<?php echo "{$product['ProductStatus']}" ?>"><?php echo "{$product['ProductStatus']}" ?></option>
            <option value="null" disabled><hr></option>
            <option value="Available">Available</option>
            <option value="Not Available">Not Available</option>
          </select>
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