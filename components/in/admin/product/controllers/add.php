<?php
  session_start();

  require '../../../../config.php';
  require '../../../../db_config.php';

  if(!$_SESSION['isAdmin'])
    exit("Authentication required!");
  
  $res = array();

  $name = isset($_POST['name']) ? strip_tags(trim(mysqli_real_escape_string($connection,trim($_POST['name'])))) : "";
  $weight = isset($_POST['weight']) ? strip_tags(trim(mysqli_real_escape_string($connection,trim($_POST['weight'])))) : "";
  $unit = isset($_POST['unit']) ? strip_tags(trim(mysqli_real_escape_string($connection,trim($_POST['unit'])))) : "";
  $shortDescription = isset($_POST['shortDescription']) ? strip_tags(trim(mysqli_real_escape_string($connection,trim($_POST['shortDescription'])))) : "";
  $longDescription = isset($_POST['longDescription']) ? strip_tags(trim(mysqli_real_escape_string($connection,trim($_POST['longDescription'])))) : "";
  $properties = isset($_POST['properties']) ? strip_tags(trim(mysqli_real_escape_string($connection,trim($_POST['properties'])))) : "";
  $price = isset($_POST['price']) ? strip_tags(trim(mysqli_real_escape_string($connection,trim($_POST['price'])))) : "";
  $promoPrice = isset($_POST['promoPrice']) ? strip_tags(trim(mysqli_real_escape_string($connection,trim($_POST['promoPrice'])))) : "";
  $stock = isset($_POST['stock']) ? strip_tags(trim(mysqli_real_escape_string($connection,trim($_POST['stock'])))) : "";
  $sku = isset($_POST['sku']) ? strip_tags(trim(mysqli_real_escape_string($connection,trim($_POST['sku'])))) : "";
  $quantity = isset($_POST['quantity']) ? strip_tags(trim(mysqli_real_escape_string($connection,trim($_POST['quantity'])))) : "";
  $status = isset($_POST['status']) ? strip_tags(trim(mysqli_real_escape_string($connection,trim($_POST['status'])))) : "";

  $brandId = isset($_POST['brandId']) ? strip_tags(trim(mysqli_real_escape_string($connection,trim($_POST['brandId'])))) : "";
  $categoryId = isset($_POST['categoryId']) ? strip_tags(trim(mysqli_real_escape_string($connection,trim($_POST['categoryId'])))) : "";
  
  $insert = mysqli_query($connection, "INSERT INTO products(ProductCategoryID_FK,ProductBrandID_FK,ProductName,ProductWeight,ProductWeightUnit,ProductShortDesc,ProductLongDesc,ProductProperties,ProductPrice,ProductPromotionalPrice,ProductQuantity,ProductStock,ProductSKU,ProductStatus,ProductCreated) VALUES(
    '{$categoryId}', '{$brandId}', '{$name}', '{$weight}', '{$unit}', '{$shortDescription}', '{$longDescription}', '{$properties}', '{$price}', '{$promoPrice}', '{$quantity}', '{$stock}', '{$sku}', '{$status}', NOW()") or die($connection);

  if ($insert) {
    $res['success'] = true;
  } else {
    $res['success'] = false;
  }

  echo json_encode($res);
?>