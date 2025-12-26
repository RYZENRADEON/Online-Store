<?php
include  "../../config/connection.php";

$id = $_POST["editProducteId"];
$name = $_POST["editProducteName"];
$description = $_POST["editProducteDes"];
$category = $_POST["editProductCat"];
$color = $_POST["editProductCol"];
$brand = $_POST["editProductBrand"];
$size = $_POST["editProductSize"];

if (empty($id)) {
    echo ("Product Id cannot be empty");
    exit;
} elseif (empty($name)) {
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
    echo "Product size cannot be empty";
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
    $rs = Database::search("SELECT * FROM `product` WHERE `product_id` != '$id' AND (`product_name` = '$name' AND `color_id` = '$color' AND `cat_id` = '$category' AND `size_id` = '$size' AND `brand_id` = '$brand')");
    $num = $rs->num_rows;
    if ($num > 0) {
        echo "Product already exists";
    } else {
        $rs2 = Database::search("SELECT * FROM `product` WHERE `product_id` = '$id'");
        if ($rs2->num_rows) {
            $row2 = $rs2->fetch_assoc();
            $imgPath = $row2["img"]; 

            if (!empty($_FILES["editProductImg"]["name"])) {
                $newPath = "../../assets/images/product/" . uniqid() . $_FILES["editProductImg"]["name"];
                if (move_uploaded_file($_FILES["editProductImg"]["tmp_name"], $newPath)) {

                    if (!empty($row2["img"])) {
                        unlink($row2["img"]);
                    }
                    $imgPath = $newPath;
                }
            }

            Database::iud("UPDATE `product` SET `product_name` = '$name', `description` = '$description', `img` = '$imgPath', `color_id` = '$color', `cat_id` = '$category', `size_id` = '$size', `brand_id` = '$brand' WHERE `product_id` = '$id'");

            echo "success";
        } else {
            echo "Selected product does not exist";
            exit;
        }
    }
}
