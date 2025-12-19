<?php
include  "../../config/connection.php";

$name = $_POST["regProducteName"];
$description = $_POST["regProducteDes"];
$category = $_POST["regProductCat"];
$color = $_POST["regProductCol"];
$brand = $_POST["regProductBrand"];
$size = $_POST["regProductSize"];

if (empty($name)) {
    echo "Product name cannot be empty";
    exit;
} elseif (empty($description)) {
    echo "Product description cannot be empty";
    exit;
} elseif (empty($category)) {
    echo "Product category cannot be empty";
    exit;
} elseif (empty($color)) {
    echo "Product color cannot be empty";
    exit;
} elseif (empty($brand)) {
    echo "Product brand cannot be empty";
    exit;
} elseif (empty($size)) {
    echo "Product color cannot be empty";
    exit;
} elseif (Database::search("SELECT * FROM `brand` WHERE `brand_id` = '" . $brand . "'")->num_rows != 1) {
    echo "Selected brand not exists";
    exit;
} elseif (Database::search("SELECT * FROM `color` WHERE `color_id` = '" . $color . "'")->num_rows != 1) {
    echo "Selected color not exists";
    exit;
} elseif (Database::search("SELECT * FROM `category` WHERE `cat_id` = '" . $category . "'")->num_rows != 1) {
    echo "Selected category not exists";
    exit;
} elseif (Database::search("SELECT * FROM `size` WHERE `size_id` = '" . $size . "'")->num_rows != 1) {
    echo "Selected brand not exists";
    exit;
} else {
    $rs = Database::search("SELECT * FROM `product` WHERE `product_name` = '" . $size . "'");
    $num = $rs->num_rows;
    if ($num > 0) {
        echo "Product already exists";
    } else {
        $imgPath = "../../assets/images/product/" . uniqid() . $_FILES["regProductImg"]["name"];
        move_uploaded_file($_FILES["regProductImg"]["tmp_name"], $imgPath);

        Database::iud("INSERT INTO `product` (`product_name`,`description`,`img`,`color_id`,`cat_id`,`size_id`,`brand_id`) VALUES ('$name', '$description', '$imgPath', '$color', '$category', '$size', '$brand')");
        echo "success";
    }
}
