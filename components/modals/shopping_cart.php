<div class="modal-content" id="shoppingCartContent">
        <div class="modal-header">
            <h5 class="modal-title" id="shoppingCartModalLabel">Shopping Cart</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">

            <div id="shopping-cart">
                <div class="txt-heading">Shopping Cart <a id="btnEmpty" href="index.php?action=empty">Empty Cart</a></div>
                    <?php
                    if(isset($_SESSION["cart_item"])){
                        $item_total = 0;
                    ?>	
                    <table cellpadding="10" cellspacing="1">
                        <tbody>
                            <tr>
                                <th style="text-align:left;"><strong>Name</strong></th>
                                <th style="text-align:left;"><strong>Brand</strong></th>
                                <th style="text-align:right;"><strong>Quantity</strong></th>
                                <th style="text-align:right;"><strong>Price</strong></th>
                                <th style="text-align:center;"><strong>Action</strong></th>
                            </tr>	
                        <?php		
                            foreach ($_SESSION["cart_item"] as $item){
                                ?>
                            <tr>
                                <td style="text-align:left;border-bottom:#F0F0F0 1px solid;"><strong><?php echo $item["cart_product_name"]; ?></strong></td>
                                <td style="text-align:left;border-bottom:#F0F0F0 1px solid;"><?php echo $item["cart_product_brand"]; ?></td>
                                <td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><?php echo $item["quantity"]; ?></td>
                                <td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><?php echo "$".$item["cart_product_price"]; ?></td>
                                <td style="text-align:center;border-bottom:#F0F0F0 1px solid;"><a href="index.php?action=remove&code=<?php echo $item["cart_product_id"]; ?>" class="btnRemoveAction">Remove Item</a></td>
                            </tr>
                            <?php
                                $item_total += ($item["price"]*$item["quantity"]);
                                }
                            ?>
                            <tr>
                                <td colspan="5" align=right><strong>Total:</strong> <?php echo "$".$item_total; ?></td>
                            </tr>
                        </tbody>
                    </table>		
                    <?php
                    }
                    ?>
                </div>
            </div>
    </div>