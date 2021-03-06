<?php
session_start();
require "components/functions.php";
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>BodyBuilding</title>

        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Superior14 Webshop">
        <meta name="keywords" content="Bodybuilding, Body Building, Nutrution, Srbija, Subotica, Protein, Kreatin, Aminokiseline">
        <meta name="author" content="Orosz Andrea, Futó Árpád">
        <!-- links-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
        
        <link rel="stylesheet" type="text/css" href="./slick/slick.css">
        <link rel="stylesheet" type="text/css" href="./slick/slick-theme.css">
        <link rel="stylesheet" href="css/style_main.css">


    </head>

    <body>

        <?php

/*User Type: User*/
if (isset($_SESSION["id_user"]) && userExists($_SESSION["id_user"]) && !adminExists($_SESSION["id_user"])) {
    if (!isset($_SESSION["gen_time"]) || $_SESSION["gen_time"] < (time() - 30)) {
        session_regenerate_id(true);
        $_SESSION["gen_time"] = time();
    }

    include "components/in/user/navigation_bar.php";

    echo "<div class='container-fluid'>";
   
    $op = isset($_GET['op']) ? $_GET['op'] : null;

    switch ($op)
    {
        case "products":
            include "components/products.php";
            break;

        case "about_us":
            include("components/about_us.php");
            break;

        default:
            include "components/carousel.php";
            include "components/on-sale-products.php";
            include "components/new-products.php";
    }

}
/*User Type: Admin*/
elseif (isset($_SESSION["id_user"]) && !userExists($_SESSION["id_user"]) && adminExists($_SESSION["id_user"])) {
    if (!isset($_SESSION["gen_time"]) || $_SESSION["gen_time"] < (time() - 30)) {
        session_regenerate_id(true);
        $_SESSION["gen_time"] = time();
    }

    // print_r($_SESSION);
    // require "components/in/admin/navigation_bar.php";
    ?>
    
    <div class="container-fluid d-flex p-0">
        <div class="sidebar">
            <h6 class="text-center p-2 mt-2 mb-2 text-muted"><?php echo $_SESSION['user_name']; ?></h6>
            <?php require "components/in/admin/navigation_bar.php"; ?>
        </div>
        <div class="admin-content">
            <?php 
                $user = isset($_GET['user_settings']) ? $_GET['user_settings'] : null;
                $product = isset($_GET['product_settings']) ? $_GET['product_settings'] : null;
                $brand = isset($_GET['brand_settings']) ? $_GET['brand_settings'] : null;
                $category = isset($_GET['category_settings']) ? $_GET['category_settings'] : null;

                switch ($user) {
                    case 'add':
                        require "components/in/admin/user/views/add.php";
                        break;
                    case 'edit':
                        require "components/in/admin/user/views/edit.php";
                        break;
                    case 'delete':
                        require "components/in/admin/user/views/delete.php";
                        break;
                    default:
                        break;
                }

                switch ($product) {
                    case 'add':
                        require "components/in/admin/product/views/add.php";
                        break;
                    case 'edit':
                        require "components/in/admin/product/views/edit.php";
                        break;
                    case 'delete':
                        require "components/in/admin/product/views/delete.php";
                        break;
                    default:
                        break;
                }

                switch ($brand) {
                    case 'add':
                        require "components/in/admin/brand/views/add.php";
                        break;
                    case 'edit':
                        require "components/in/admin/brand/views/edit.php";
                        break;
                    case 'delete':
                        require "components/in/admin/brand/views/delete.php";
                        break;
                    default:
                        break;
                }

                switch ($category) {
                    case 'add':
                        require "components/in/admin/category/views/add.php";
                        break;
                    case 'edit':
                        require "components/in/admin/category/views/edit.php";
                        break;
                    case 'delete':
                        require "components/in/admin/category/views/delete.php";
                        break;
                    default:
                        break;
                }
            ?>
        </div> 
    </div>
    <?php
    

}
/*User Type: Guest*/
else {
    require "components/out/navigation_bar.php";

    echo "<div class='container-fluid'>";
   
    $op = isset($_GET['op']) ? $_GET['op'] : null;

        switch ($op)
        {
            case "products":
            require("components/products.php");
                break;

            case "about_us":
                include("components/about_us.php");
            break;

            default:
                require("components/carousel.php");
                require("components/on-sale-products.php");
                require("components/new-products.php");
        }
    }
    echo "</div>";
    require ("components/footer.php");
    mysqli_close($connection);

?>

    </body>

    </html>

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>

<script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
    <script src="js/jquery.validate.min.js"></script>

    <script src="js/bootstrap-notify.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/modal.js"></script>


    <script defer src="https://use.fontawesome.com/releases/v5.0.1/js/all.js"></script>

    <script src="slick/slick.js" type="text/javascript" charset="utf-8"></script>

    <script type="text/javascript">
        $(document).on('ready', function() {

            $('.center').slick({
            dots: true,
            centerMode: true,
            centerPadding: '60px',
            autoplay: true,
            autoplaySpeed: 2000,
            slidesToShow: 5,
            arrows: true,
            responsive: [
                {
                breakpoint: 1441,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 4
                }
                },
                {
                breakpoint: 1025,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 3
                }
                },
                {
                breakpoint: 769,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 2
                }
                },
                {
                breakpoint: 426,
                settings: {
                    dots: true,
                    infinite: true,
                    speed: 500,
                    fade: true,
                    slidesToShow: 1
                }
                },
                
            ]
            });
        });
    </script>