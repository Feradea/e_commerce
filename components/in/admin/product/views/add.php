<?php
  if(!$_SESSION['isAdmin'])
    exit("Authentication required!");
?>


<div class="card">
  <div class="card-header">
    <h5 class="card-title mb-0">Add product</h5>
  </div>
  <form id="addProductForm">
    <div class="card-body">
      <div class="form-group row">
        <div class="col-lg-2">
          <label class="col-form-label">Brand</label>
        </div>
        <div class="col-lg-10">
          <select name="brandId" class="custom-select">
            <?php 
              $brands = mysqli_query($connection, "SELECT * FROM brands");

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
            <?php 
              $categories = mysqli_query($connection, "SELECT * FROM categories");

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
          <input type="text" name="name" placeholder="Product name" class="form-control" required>
        </div>
      </div>
      
      <div class="form-group row">
        <div class="col-lg-2">
          <label class="col-form-label">Weight</label>
        </div>
        <div class="col-lg-10">
          <input type="text" name="weight" placeholder="Product weight" class="form-control">
        </div>
      </div>
      
      <div class="form-group row">
        <div class="col-lg-2">
          <label class="col-form-label">Weight unit</label>
        </div>
        <div class="col-lg-10">
          <input type="text" name="unit" placeholder="Product weight" class="form-control">
        </div>
      </div>

      <div class="form-group row">
        <div class="col-lg-2">
          <label class="col-form-label">Short description</label>
        </div>
        <div class="col-lg-10">
          <textarea class="form-control" name="shortDescription" rows="2"></textarea>
        </div>
      </div>

      <div class="form-group row">
        <div class="col-lg-2">
          <label class="col-form-label">Long description</label>
        </div>
        <div class="col-lg-10">
          <textarea class="form-control" name="longDescription" rows="4"></textarea>
        </div>
      </div>

      <div class="form-group row">
        <div class="col-lg-2">
          <label class="col-form-label">Product properties</label>
        </div>
        <div class="col-lg-10">
          <textarea class="form-control" name="properties" rows="3"></textarea>
        </div>
      </div>

      <div class="form-group row">
        <div class="col-lg-2">
          <label class="col-form-label">Price</label>
        </div>
        <div class="col-lg-10">
          <div class="input-group">
          <input type="number" name="price" placeholder="Price" class="form-control">
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
          <input type="number" name="promoPrice" placeholder="Promo price" class="form-control">
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
          <input type="number" name="quantity" placeholder="Quantity" class="form-control">
        </div>
      </div>

      <div class="form-group row">
        <div class="col-lg-2">
          <label class="col-form-label">SKU</label>
        </div>
        <div class="col-lg-10">
          <input type="number" name="sku" placeholder="SKU" class="form-control">
        </div>
      </div>

      <div class="form-group row">
        <div class="col-lg-2">
          <label class="col-form-label">Stock</label>
        </div>
        <div class="col-lg-10">
          <select name="status" class="custom-select">
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