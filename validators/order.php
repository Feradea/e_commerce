<?php

session_start();

require "../components/functions.php";
global $connection;

if(isset($_SESSION["id_user"]))
{

    $cart_product_id= isset($_POST["cart_product_id"]) ? strip_tags(trim($_POST["cart_product_id"])) : null;
    $cart_product_quantity= isset($_POST["cart_product_quantity"]) ? strip_tags(trim($_POST["cart_product_quantity"])) : null;
    $cart_product_action= isset($_POST["cart_product_action"]) ? strip_tags(trim($_POST["cart_product_action"])) : null;
    $cart_product_price= isset($_POST["cart_product_price"]) ? strip_tags(trim($_POST["cart_product_price"])) : null;
    $user_id = $_SESSION["id_user"];
    $cart_product_name = "";
    $cart_product_brand = "";

    if(!isset($_SESSION["order_id"])){
        $_SESSION["order_id"] = date("Y").$user_id.rand(0,99); 
    }

    $reference_number = $_SESSION["order_id"];

    $total_price_temp = ($cart_product_price * $cart_product_quantity);

    $order_comment = NULL;
    $date = date("Y-m-d H:i:s");

    if(!empty($cart_product_action)){

        switch($cart_product_action)
        {
            case "add":
            if(!empty($cart_product_quantity)) {
                if(is_numeric($cart_product_quantity) && $cart_product_quantity > 0 ){

                    $sql = "SELECT * FROM products p
                    JOIN brands b ON b.BrandID = p.ProductBrandID_FK
                    JOIN categories c ON c.CategoryID = p.ProductCategoryID_FK
                    WHERE p.ProductID = '$cart_product_id'";
                    $result = mysqli_query($connection, $sql);
                
                    while ($row = mysqli_fetch_array($result)) {
                        $cart_product_name = $row["ProductName"];
                        $cart_product_brand = $row["BrandName"];
                    }

                    $sql_existing_order = "SELECT * FROM cartorder
                    WHERE OrderID = '$reference_number'";
                    $result_existing_order = mysqli_query($connection, $sql_existing_order);

                    if(mysqli_fetch_array($result_existing_order) > 0){
                        //order exists

                        // echo "order exists <br>";

                        $sql_existing_order_item = "SELECT * FROM cartorder co
                        JOIN cartorderitem coi ON coi.CartOrderID_FK = co.OrderID
                        WHERE coi.ProductID_FK = '$cart_product_id' && coi.CartOrderID_FK = '$reference_number'";

                        $result_existing_order_item = mysqli_query($connection, $sql_existing_order_item);

                        // var_dump($sql_existing_order_item);
                        // var_dump($result_existing_order_item);

                    
                        if (mysqli_num_rows($result_existing_order_item) > 0) {

                            // echo "item exists <br>";

                            $sql_cart_order = "UPDATE cartorder
                            SET OrderTotalPrice = OrderTotalPrice + '$total_price_temp'
                            WHERE OrderID = '$reference_number'";
                            $result_cart_order = mysqli_query($connection, $sql_cart_order);

                            $sql_cart_item = "UPDATE cartorderitem
                            SET Quantity = Quantity + '$cart_product_quantity'
                            WHERE CartOrderID_FK = '$reference_number' && ProductID_FK = '$cart_product_id'";
                            $result_cart_item = mysqli_query($connection, $sql_cart_item);

                            
                            // var_dump($result_cart_order);
                            // var_dump($result_cart_item);
                            
                        }

                        else{
                            // echo "item does not exist<br>";

                            $sql_cart_order = "UPDATE cartorder
                            SET OrderTotalPrice = OrderTotalPrice + '$total_price_temp'
                            WHERE OrderID = '$reference_number'";
                            $result_cart_order = mysqli_query($connection, $sql_cart_order);

                            $sql_cart_item = "INSERT INTO cartorderitem (CartOrderItemID, CartOrderID_FK, ProductID_FK, Quantity)
                            VALUES (NULL, '$reference_number', '$cart_product_id', '$cart_product_quantity')";
                            $result_cart_item = mysqli_query($connection, $sql_cart_item);

                            // var_dump($sql_cart_item);
                            // var_dump($result_cart_item);

                        }
                        
                    }
                    else{
                        //order does not exist

                        echo "order does not exist";

                        $sql_cart_order = "INSERT INTO cartorder (OrderID, UserID_FK, OrderDate, OrderText, OrderTotalPrice, Status)
                        VALUES ('$reference_number', '$user_id', '$date', '$order_comment', '$total_price_temp', 'Pending')";
                        $result_cart_order = mysqli_query($connection, $sql_cart_order);

                        // var_dump($sql_cart_order);
                        // var_dump($result_cart_order);

                        if ($result_cart_order) {

                            $sql_cart_item = "INSERT INTO cartorderitem (CartOrderItemID, CartOrderID_FK, ProductID_FK, Quantity)
                            VALUES (NULL, '$reference_number', '$cart_product_id', '$cart_product_quantity')";
                            $result_cart_item = mysqli_query($connection, $sql_cart_item);

                            // var_dump($sql_cart_item);
                            // var_dump($result_cart_item);

                        }
                    
                    }

                }

            }
            redirection("../index.php?op=products");
            break;

            case "remove":
               
            break;

            case "empty":
                
            break;

            default:
                include "components/new-products.php";
        
        }

    echo "<br>" . $reference_number;

    }
}
else 
{
    redirection("../index.php");
    exit();
}

?>