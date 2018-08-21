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
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
        
        <link rel="stylesheet" type="text/css" href="./slick/slick.css">
        <link rel="stylesheet" type="text/css" href="./slick/slick-theme.css">

        <link rel="stylesheet" href="css/style.css">


    </head>

    <body>

        <?php

/*User Type: User*/
if (isset($_SESSION["id_user"]) && userExists($_SESSION["id_user"]) && !adminExists($_SESSION["id_user"])) {
    if (!isset($_SESSION["gen_time"]) || $_SESSION["gen_time"] < (time() - 30)) {
        session_regenerate_id(true);
        $_SESSION["gen_time"] = time();
    }

    require "components/in/user/navigation_bar.php";

    $op = "";

    if (isset($_GET["op"])) {
        $op = mysqli_real_escape_string($connection, $_GET["op"]);
    }

    // switch ($op) {
    //     case "products":
    //         include "components/products.php";
    //         break;

    //     default:
    //         include "components/carousel.html";
    //         include "components/onsaleproducts.php";
    //         include "components/newproducts.php";
    // }

}
/*User Type: Admin*/
elseif (isset($_SESSION["id_user"]) && !userExists($_SESSION["id_user"]) && adminExists($_SESSION["id_user"])) {
    if (!isset($_SESSION["gen_time"]) || $_SESSION["gen_time"] < (time() - 30)) {
        session_regenerate_id(true);
        $_SESSION["gen_time"] = time();
    }

    require "components/in/admin/navigation_bar.php";
    ?>
    
    <div class="container">

    <?php
    

    $op = "";

    // if (isset($_GET["op"])) 
    //     $op = mysqli_real_escape_string($connection, $_GET["op"]);

    //     echo "OP = " . $op;

    // switch ($op)
    // {
    //     case "products":
    //         include("components/products.php");
    //         break;

    //     default:
    //         include("components/slickcarousel.html");
    //         include("components/onsaleproducts.php");
    //         include("components/newproducts.php");
    // }

    ?>
    
    </div>
    <?php
    

}
/*User Type: Guest*/
else {
    require "components/out/navigation_bar.php";

    echo "<div class='container-fluid'>";
        $op = "";

        if (isset($_GET["op"])) 
            $op = mysqli_real_escape_string($connection, $_GET["op"]);

        switch ($op)
        {
            case "products":
                include("components/products.php");
                break;

            default:
                include("components/carousel.php");
                include("components/on-sale-products.php");
                include("components/new-products.php");
                // include("try.php");
        }
    }
    echo "</div>";
    include "components/footer.php";
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

    <script src="js/main.js"></script>
    <script src="js/modal.js"></script>

    <script defer src="https://use.fontawesome.com/releases/v5.0.1/js/all.js"></script>

    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>

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