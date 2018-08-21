<nav class="navbar navbar-expand-lg navbar-ligh bg-light fixed-top scrolling-navbar">
    <div class="container">
        <a class="navbar-brand" href="#">BB</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarTogglerDemo01"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarToggler">

            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Products</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Brand</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <?php

                        $sql_brands = "SELECT BrandName FROM brands";
                        $result_brands = mysqli_query($connection,$sql_brands) or die(mysqli_error($connection));

                        if(mysqli_num_rows($result_brands)>0)
                        {
                            while ($row_brands=mysqli_fetch_array($result_brands,MYSQLI_BOTH))
                            {
                                echo "<a class=\"dropdown-item\" href=\"#\">".$row_brands[0]."</a>";
                            }
                            mysqli_free_result($result_brands);
                        }
                        ?>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Category</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <?php

                        $sql_category = "SELECT CategoryName FROM categories";
                        $result_category = mysqli_query($connection,$sql_category) or die(mysqli_error($connection));

                        if(mysqli_num_rows($result_category)>0)
                        {
                            while ($row_category=mysqli_fetch_array($result_category,MYSQLI_BOTH))
                            {
                                echo "<a class=\"dropdown-item\" href=\"#\">".$row_category[0]."</a>";
                            }
                            mysqli_free_result($result_category);
                        }
                        ?>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
            </ul>
            <ul class="nav justify-content-end">
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
            include("components/modals/shopping_cart.html");// modal for shopping cart
        ?>
    </div>
</div>