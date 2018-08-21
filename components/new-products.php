<div class="container">
    <h1>Novo</h1>
    <!--Carousel Wrapper-->
    <div id="new-products" class="carousel slide carousel-multi-item" data-ride="carousel">

        <!--Controls-->
        <div class="controls-top">
            <a class="btn-floating" href="#new-products" data-slide="prev"><i class="fa fa-chevron-left"></i></a>
            <a class="btn-floating" href="#new-products" data-slide="next"><i class="fa fa-chevron-right"></i></a>
        </div>
        <!--/.Controls-->


        <!--Slides-->
        <div class="carousel-inner" role="listbox">

        <?php
        $sql = "SELECT * FROM products p
        JOIN brands b ON b.BrandID = p.ProductBrandID_FK
        JOIN categories c ON c.CategoryID = p.ProductCategoryID_FK
        WHERE p.ProductCreated + INTERVAL 1 MONTH > CURRENT_DATE";

        $result = mysqli_query($connection, $sql);

        if (mysqli_num_rows($result) > 0) {

            $counter = 0;
            while ($row = mysqli_fetch_assoc($result)) {

        // SQL get Product Image
                $sql_image = "SELECT * FROM images WHERE ProductsProductID_FK ='" . $row["ProductID"] . "' AND ImageDescription = 'ProductImage'";
                $result_image = mysqli_query($connection, $sql_image);

                $product_img = "img/products/noimagefound.jpg";

                if (mysqli_num_rows($result_image) > 0) {
                    while ($row_image = mysqli_fetch_array($result_image, MYSQLI_BOTH)) {
                        $product_img = $row_image["ImagePath"];
                        break;
                    }
                }

        // SQL get Product Category
                $sql_category = "SELECT * FROM categories WHERE CategoryID ='" . $row["ProductCategoryID_FK"] . "'";
                $result_category = mysqli_query($connection, $sql_category);

                if (mysqli_num_rows($result_category) > 0) {
                    while ($row_category = mysqli_fetch_array($result_category, MYSQLI_BOTH)) {
                        $product_category = $row_category["CategoryName"];
                        break;
                    }
                }

        // SQL get Product Brand
                $sql_brand = "SELECT * FROM brands WHERE BrandID ='" . $row["ProductBrandID_FK"] . "'";
                $result_brand = mysqli_query($connection, $sql_brand);

                if (mysqli_num_rows($result_brand) > 0) {
                    while ($row_brand = mysqli_fetch_array($result_brand, MYSQLI_BOTH)) {
                        $product_brand = $row_brand["BrandName"];
                        break;
                    }
                }

                $product_id = $row["ProductID"];
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

                $dateTimestamp1 = strtotime("+1 month", strtotime($product_created)); //2018-08-16 -> 2018-09-16
                $dateTimestamp2 = strtotime(date("Y-m-d h:i:s")); //2018-08-17
                
                if($counter == 0){
                    echo "<div class='carousel-item active'>";
                        echo "<div class='row'>";
                }
                elseif($counter%3 == 0){             
                        echo "</div>";
                    echo "</div>";
                    echo "<div class='carousel-item'>";
                        echo "<div class='row'>";
                }

                echo "<div class='col-md-4 clearfix d-none d-md-block'>";
                    echo "<div class='onSaleProduct_card card mb-2'>";
                        echo "<div class='product_icon'>";
                            echo "<div class='onsale_icon''>";
                                if ($dateTimestamp1 > $dateTimestamp2) {
                                    echo "<p>Novo</p>";
                                }
                            echo "</div>";
                            echo "<div class='new_icon'>";
                            
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
                            if ($product_p_price != null) {
                            echo "<p class='card-text product_price'>";
                                echo $product_price . " RSD ";
                            echo "</p>";
                            echo "<p class='card-text product_promotional_price'>";
                                echo $product_p_price . " RSD ";
                            echo "</p>";
                            } else {
                            echo "<p class='card-text product_promotional_price'>";
                                echo $product_price . " RSD ";
                            echo "</p>";
                            }
                            echo "<a href='#' class='btn btn-primary product_addtocart_button'>Add to cart</a>";
                        echo "</div>";
                    echo "</div>";
                echo "</div>";
        
                if ($counter == $num_rows - 1){
                    echo "</div>";
                echo "</div>";
                }

                $counter ++;
                $product_img = "img/products/noimagefound.jpg";
            }

        } else {echo "0 results";}
        ?>
       </div>
    </div>
</div>
   