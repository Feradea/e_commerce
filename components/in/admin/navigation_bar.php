<ul class="list-unstyled">
  <a class="text-dark p-0 w-100" data-toggle="collapse" href="#userSettings" role="button" aria-expanded="false" aria-controls="userSettings"><li>
  <i class="fa fa-cog mr-2 fa-fw" aria-hidden="true"></i>User settings
  </li></a>
  <ul class="collapse list-unstyled inner-admin <?php if (isset($_GET['user_settings'])) echo "show"; ?>" id="userSettings">
    <a href="index.php?user_settings=add" class="text-dark"><li><i class="fas fa-plus fa-fw mr-2" aria-hidden="true"></i>Add user</li></a>
    <a href="index.php?user_settings=edit" class="text-dark"><li><i class="fas fa-edit fa-fw mr-2" aria-hidden="true"></i>Edit users</li></a>
    <a href="index.php?user_settings=delete" class="text-dark"><li><i class="fas fa-trash fa-fw mr-2" aria-hidden="true"></i>Delete user</li></a>
  </ul>
  
  <a class="text-dark p-0 w-100" data-toggle="collapse" href="#productSettings" role="button" aria-expanded="false" aria-controls="productSettings"><li>
  <i class="fa fa-cog mr-2 fa-fw" aria-hidden="true"></i>Product settings
  </li></a>
  <ul class="collapse list-unstyled inner-admin  <?php if (isset($_GET['product_settings'])) echo "show"; ?>" id="productSettings">
    <a href="index.php?product_settings=add" class="text-dark"><li><i class="fas fa-plus fa-fw mr-2" aria-hidden="true"></i>Add product</li></a>
    <a href="index.php?product_settings=edit" class="text-dark"><li><i class="fas fa-edit fa-fw mr-2" aria-hidden="true"></i>Edit products</li></a>
    <a href="index.php?product_settings=delete" class="text-dark"><li><i class="fas fa-trash fa-fw mr-2" aria-hidden="true"></i>Delete product</li></a>
  </ul>

  <a class="text-dark p-0 w-100" data-toggle="collapse" href="#categorySettings" role="button" aria-expanded="false" aria-controls="categorySettings"><li>
  <i class="fa fa-cog mr-2 fa-fw" aria-hidden="true"></i>Category settings
  </li></a>
  <ul class="collapse list-unstyled inner-admin  <?php if (isset($_GET['category_settings'])) echo "show"; ?>" id="categorySettings">
    <a href="index.php?category_settings=add" class="text-dark"><li><i class="fas fa-plus fa-fw mr-2" aria-hidden="true"></i>Add category</li></a>
    <a href="index.php?category_settings=edit" class="text-dark"><li><i class="fas fa-edit fa-fw mr-2" aria-hidden="true"></i>Edit categories</li></a>
    <a href="index.php?category_settings=delete" class="text-dark"><li><i class="fas fa-trash fa-fw mr-2" aria-hidden="true"></i>Delete category</li></a>
  </ul>

  <a class="text-dark p-0 w-100" data-toggle="collapse" href="#brandSettings" role="button" aria-expanded="false" aria-controls="brandSettings"><li>
  <i class="fa fa-cog mr-2 fa-fw" aria-hidden="true"></i>Brand settings
  </li></a>
  <ul class="collapse list-unstyled inner-admin  <?php if (isset($_GET['brand_settings'])) echo "show"; ?>" id="brandSettings">
    <a href="index.php?brand_settings=add" class="text-dark"><li><i class="fas fa-plus fa-fw mr-2" aria-hidden="true"></i>Add brand</li></a>
    <a href="index.php?brand_settings=edit" class="text-dark"><li><i class="fas fa-edit fa-fw mr-2" aria-hidden="true"></i>Edit brands</li></a>
    <a href="index.php?brand_settings=delete" class="text-dark"><li><i class="fas fa-trash fa-fw mr-2" aria-hidden="true"></i>Delete brand</li></a>
  </ul>
</ul>
<a class="btn btn-link btn-block text-dark" href='components/in/admin/logout.php'><i class="fas fa-sign-out-alt fa-fw mr-2" aria-hidden="true"></i>Logout</a>