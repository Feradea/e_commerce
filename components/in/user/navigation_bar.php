<nav class="navbar navbar_top">
    <div class="nav_left">
        
    </div>
    <div class="nav_center">
        <a class="navbar-brand" href="index.php">
            <img src="img/S14Logo_small.png" alt="logo" />
        </a>
    </div>
    <div class="nav_right">
        <ul class="nav">
            <li class="nav-item">
                <button type="button" class="btn btn-authentication" data-toggle="modal" data-target="#user-modal">
                    <i class="fas fa-user"></i>
                </button>
            </li>
            <li class="nav-item">
                <button type="button" class="btn btn-shopping_cart" data-toggle="modal" data-target="#shopping_cart-modal">
                    <i class="fas fa-shopping-cart"></i>
                </button>

            </li>
        </ul>
    </div>
</nav>
<nav class="navbar navbar-light bg-light navbar-expand-lg sticky-top navbar_bottom">
    
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Home
                    <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?op=products">Products</a>
            </li>
            <li class="nav-item dropdown">
                
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Brands
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <?php


                    $sql_brands = "SELECT DISTINCT BrandName FROM products p
                    JOIN brands b ON b.BrandId = p.ProductBrandID_FK";
                    $result_brands = mysqli_query($connection,$sql_brands) or die(mysqli_error($connection));

                    if(mysqli_num_rows($result_brands)>0)
                    {
                        while ($row_brands=mysqli_fetch_array($result_brands,MYSQLI_BOTH))
                        {
                            echo "<a class=\"dropdown-item\" href=\"index.php?op=products&brand=$row_brands[0]\">".$row_brands[0]."</a>";
                        }
                        mysqli_free_result($result_brands);
                    }
                    ?>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Category
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <?php
                    $sql_category = "SELECT DISTINCT CategoryName FROM products p
                    JOIN categories c ON c.CategoryID = p.ProductCategoryID_FK";
                    $result_category = mysqli_query($connection,$sql_category) or die(mysqli_error($connection));

                    if(mysqli_num_rows($result_category)>0)
                    {
                        while ($row_category=mysqli_fetch_array($result_category,MYSQLI_BOTH))
                        {
                            echo "<a class=\"dropdown-item\" href=\"index.php?op=products&category=$row_category[0]\">".$row_category[0]."</a>";
                        }
                        mysqli_free_result($result_category);
                    }
                    ?>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?op=about_us">About us</a>
            </li>
        </ul>
    </div>
</nav>

<!-- Modal for Logout -->
<div class="modal fade" id="user-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <?php
            include("components/modals/user_settings.php");// modal for logout
        ?>
    </div>
</div>

<!-- Modal for Shopping cart -->
<div class="modal fade" id="shopping_cart-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <?php
            include("components/modals/shopping_cart.php");// modal for shopping cart
        ?>
    </div>
</div>
