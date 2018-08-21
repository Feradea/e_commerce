<div class="container">
    <div class="product_list">
        <?php

    if(isset($_GET["brand"]))
    {
        $brand = $_GET["brand"];

        $sql = "SELECT * FROM products p
        JOIN brands b ON b.BrandID = p.ProductBrandID_FK
        JOIN categories c ON c.CategoryID = p.ProductCategoryID_FK
        WHERE b.BrandName = '$brand'";
    }

    if(isset($_GET["category"]))
    {
        $category = $_GET["category"];

        $sql = "SELECT * FROM products p
        JOIN brands b ON b.BrandID = p.ProductBrandID_FK
        JOIN categories c ON c.CategoryID = p.ProductCategoryID_FK
        WHERE c.CategoryName = '$category'";
    }


$result = mysqli_query($connection, $sql);

if (mysqli_num_rows($result) > 0) {

    while($row = mysqli_fetch_assoc($result)) {


        // SQL get Product Image
        $sql_image = "SELECT * FROM images WHERE ProductsProductID_FK ='".$row["ProductID"]."' AND ImageDescription = 'ProductImage'";
        $result_image = mysqli_query($connection, $sql_image);

        $product_img = "img/products/noimagefound.jpg";

        if(mysqli_num_rows($result_image) > 0)
        {
            while ($row_image = mysqli_fetch_array($result_image, MYSQLI_BOTH))
            {
                $product_img = $row_image["ImagePath"];
                break;
            }
        }

          // SQL get Product Category
          $sql_category = "SELECT * FROM categories WHERE CategoryID ='".$row["ProductCategoryID_FK"]."'";
          $result_category = mysqli_query($connection, $sql_category);
  
          if(mysqli_num_rows($result_category) > 0)
          {
              while ($row_category = mysqli_fetch_array($result_category, MYSQLI_BOTH))
              {
                  $product_category = $row_category["CategoryName"];
                  break;
              }
          }

             // SQL get Product Brand
             $sql_brand = "SELECT * FROM brands WHERE BrandID ='".$row["ProductBrandID_FK"]."'";
             $result_brand = mysqli_query($connection, $sql_brand);
     
             if(mysqli_num_rows($result_brand) > 0)
             {
                 while ($row_brand = mysqli_fetch_array($result_brand, MYSQLI_BOTH))
                 {
                     $product_brand = $row_brand["BrandName"];
                     break;
                 }
             }

        $product_id = $row["ProductID"];
        // $product_category = $row["ProductCategoryID_FK"];
        // $product_brand = $row["ProductBrandID_FK"];
        $product_name = $row["ProductName"];
        $product_weight = $row["ProductWeight"];
        $product_weight_unit = $row["ProductWeightUnit"];
        $product_sd = $row["ProductShortDesc"];
        $product_ld = $row["ProductLongDesc"];
        $product_prop = $row["ProductProperties"];
        $product_price = $row["ProductPrice"];
        $product_p_price = $row["ProductPromotionalPrice"];
        $product_q = $row["ProductQuantity"];
        $product_s = $row["ProductStock"];
        $product_sku = $row["ProductSKU"];
        $product_status = $row["ProductStatus"];
        $product_created = $row["ProductCreated"];
        $product_updated = $row["ProductUpdated"];
        // $product_img = $row_image["ImagePath"];

        $dateTimestamp1 = strtotime( "+1 month", strtotime($product_created ) ); //2018-08-16 -> 2018-09-16
        $dateTimestamp2 = strtotime(date("Y-m-d h:i:s")); //2018-08-17

    
            echo "<div class='product_card card'>";
                echo "<div class='product_icon'>";
                    echo "<div class='onsale_icon''>";
                        if ($dateTimestamp1 > $dateTimestamp2)
                            echo "<p>Novo</p>";
                    echo "</div>";
                    echo "<div class='new_icon'>";
                        if($product_p_price != NULL){
                            echo "<p>Akcija</p>";
                        }
                    echo "</div>";
                echo "</div>";
                echo "<img class='card-img-top product_image' src='$product_img' alt='Product image'>";
                echo "<div class='card-body'>";
                    echo "<h4 class='card-title'>";
                        echo "<p class='product_brand'>";
                            echo $product_brand;
                        echo "</p>";
                        echo "<p class='product_name'>";
                            echo $product_name;
                        echo "</p>";
                    echo "</h4>";
                    if($product_p_price != null){
                        echo "<p class='card-text product_price'>";
                            echo $product_price ." RSD ";
                        echo "</p>";
                        echo "<p class='card-text product_promotional_price'>";
                            echo $product_p_price ." RSD ";
                        echo "</p>";
                    }
                    else{
                        echo "<p class='card-text product_promotional_price'>";
                            echo $product_price ." RSD ";
                        echo "</p>";
                    }
     
                    echo "<a href='#' class='btn btn-primary product_addtocart_button'>Add to cart</a>";
                echo "</div>";

            echo "</div>";

            $product_img = "img/products/noimagefound.jpg";
    }
} else {
    echo "0 results";
}

?>
    </div>
</div>

<!-- echo $row["ProductID"]." ".
        $row["ProductCategoryID_FK"]." ".
        $row["ProductBrandID_FK"]." ".
        $row["ProductName"]." ".
        $row["ProductWeight"]." ".
        $row["ProductWeightUnit"]." ".
        $row["ProductShortDesc"]." ".
        $row["ProductLongDesc"]." ".
        $row["ProductProperties"]." ".
        $row["ProductPrice"]." ".
        $row["ProductPromotionalPrice"]." ".
        $row["ProductQuantity"]." ".
        $row["ProductStock"]." ".
        $row["ProductSKU"]." ".
        $row["ProductStatus"]." ".
        $row["ProductUpdated"]." ".
        $row_image["ImagePath"]; -->