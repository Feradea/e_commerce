<?php
    
    global $connection;
?>
<div class="modal-content" id="shoppingCartContent">
    <div class="modal-header">
        <h5 class="modal-title" id="shoppingCartModalLabel">Shopping Cart</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <div class="modal-body">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="cart-tab" data-toggle="tab" href="#cart" role="tab" aria-controls="cart" aria-selected="true">Korpa</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="user-info-tab" data-toggle="tab" href="#user-info" role="tab" aria-controls="user-info" aria-selected="false">Podaci</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="delivery-info-tab" data-toggle="tab" href="#delivery-info" role="tab" aria-controls="delivery-info" aria-selected="false">Isporuka</a>
            </li>
            </ul>
        <div class="tab-content" id="myTabContent">

      <?php
       $reference_number = $_SESSION["order_id"];

            if(isset($_SESSION["cart_item"])){

                $sql = "SELECT * FROM cartorder co
                JOIN cartorderitem coi ON coi.CartOrderID_FK = co.OrderID
                JOIN products p ON p.ProductID = coi.ProductID_FK
                JOIN brands b ON b.BrandID = p.ProductBrandID_FK
                WHERE coi.CartOrderID_FK = '$reference_number'";

                $result = mysqli_query($connection, $sql);

                echo "<div class='tab-pane fade show active' id='cart' role='tabpanel' aria-labelledby='cart-tab'>";

                echo "<table class='table'>";
                echo "<thead>";
                    echo "<tr>";
                        echo "<th scope='col'>#</th>";
                        echo "<th scope='col'>Name</th>";
                        echo "<th scope='col'>Price</th>";
                        echo "<th scope='col'>Quantity</th>";
                        echo "<th scope='col'>Sum</th>";
                    echo "</tr>";
                echo "</thead>";
                echo "<tbody>";

                $counter = 1;

                while ($row = mysqli_fetch_array($result)) {

                    $cart_product_name = $row["ProductName"];
                    $cart_product_brand = $row["BrandName"];

                    $cart_product_p_price = $row["ProductPromotionalPrice"];

                    if($cart_product_p_price != null){
                        $cart_product_price = $row["ProductPromotionalPrice"];
                    }
                    else{
                        $cart_product_price = $row["ProductPrice"];
                    }
                    $cart_order_item_quantity = $row["Quantity"];
                    $cart_order_id = $row["OrderID"];
                    $cart_order_total_price = $row["OrderTotalPrice"];
                    $cart_order_status = $row["Status"];

                    $cart_product_sum = $cart_order_item_quantity*$cart_product_price;

                    echo "<tr>";
                        echo "<th scope='row'>$counter</th>";
                        echo "<td>$cart_product_name</td>";
                        echo "<td>$cart_product_price,00 RSD</td>";
                        echo "<td>$cart_order_item_quantity</td>";
                        echo "<td>$cart_product_sum,00 RSD</td>";
                    echo "</tr>";

                    $counter++;

                }

                echo "</tbody>";
                echo "</table>";

                echo "Order ID: ".$cart_order_id."<br>";
                echo "<b>Total Price: ".$cart_order_total_price." RSD <br></b>";
                echo "Order Status: ".$cart_order_status."<br>";
                echo "</div>";

            }
        ?>

           <div class="tab-pane fade" id="user-info" role="tabpanel" aria-labelledby="user-info-tab">Some text</div>
            <div class="tab-pane fade" id="delivery-info" role="tabpanel" aria-labelledby="delivery-info-tab">Some text</div>
        </div>
          
    </div>
</div>
