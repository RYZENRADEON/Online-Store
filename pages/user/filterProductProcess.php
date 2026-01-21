<?php
include '../../config/connection.php';

$page = (isset($_GET['page']) && $_GET['page'] > 0) ? $_GET['page'] : 1;

$search = $_POST['search'];
$category = $_POST['category'];
$brand = $_POST['brand'];
$color = $_POST['color'];
$size = $_POST['size'];
$priceFrom = $_POST['from'];
$priceTo = $_POST['to'];
?>
<!-- filter form -->
<div class="col-10 offset-1 col-md-4 offset-md-0 col-lg-2 bg-dark-subtle py-4 rounded-4 mt-3">
    <h2 class="text-center">filters</h2>
    <hr>
    <div class="mb-2">
        <label for="" class="form-label">Category</label>
        <select name="" id="category" class="form-select">
            <option value="0">All categories</option>
            <?php
            $rs = Database::search("SELECT * FROM `category`");
            while ($row = $rs->fetch_assoc()) {
            ?>
                <option value="<?php echo ($row['cat_id']) ?>" <?php echo ($row['cat_id'] == $category ? 'selected' : ''); ?>><?php echo ($row['cat_name']) ?></option>
            <?php
            }
            ?>
        </select>
    </div>
    <div class="mb-2">
        <label for="" class="form-label">Brand</label>
        <select name="" id="brand" class="form-select">
            <option value="0">All brands</option>
            <?php
            $rs = Database::search("SELECT * FROM `brand`");
            while ($row = $rs->fetch_assoc()) {
            ?>
                <option value="<?php echo ($row['brand_id']) ?>" <?php echo ($row['brand_id'] == $brand ? 'selected' : ''); ?>><?php echo ($row['brand_name']) ?></option>
            <?php
            }
            ?>
        </select>
    </div>
    <div class="mb-2">
        <label for="" class="form-label">Color</label>
        <select name="" id="color" class="form-select">
            <option value="0">All colors</option>
            <?php
            $rs = Database::search("SELECT * FROM `color`");
            while ($row = $rs->fetch_assoc()) {
            ?>
                <option value="<?php echo ($row['color_id']) ?>" <?php echo ($row['color_id'] == $color ? 'selected' : ''); ?>><?php echo ($row['color_name']) ?></option>
            <?php
            }
            ?>
        </select>
    </div>
    <div class="mb-2">
        <label for="" class="form-label">Size</label>
        <select name="" id="size" class="form-select">
            <option value="0">All sizes</option>
            <?php
            $rs = Database::search("SELECT * FROM `size`");
            while ($row = $rs->fetch_assoc()) {
            ?>
                <option value="<?php echo ($row['size_id']) ?>" <?php echo ($row['size_id'] == $size ? 'selected' : ''); ?>><?php echo ($row['size_name']) ?></option>
            <?php
            }
            ?>
        </select>
    </div>
    <div class="mb-2">
        <label for="" class="form-label">Price From</label>
        <input type="number" name="" id="priceFrom" class="form-control" value="<?php echo ($priceFrom); ?>">
    </div>
    <div class="mb-2">
        <label for="" class="form-label">Price To</label>
        <input type="number" name="" id="priceTo" class="form-control" value="<?php echo ($priceTo); ?>">
    </div>

    <div class="col-12 d-grid">
        <!-- DOM tree did't work proper and in that case I have to use inline JavaFunction -->
        <button class="btn btn-outline-info filter" onclick="filter(1);">FILTER</button>
    </div>
</div>
<!-- filter form -->

<div class="col-10 offset-1 col-md-8 offset-md-0">
    <div class="row">
        <?php

        $query = "SELECT * FROM `stock_details` ";
        $condition = [];

        //filter by text
        if (!empty($search)) {
            $condition[] = "`product_name` LIKE '%$search%'";
        }
        //filter by category
        if ($category != 0) {
            $condition[] = "`cat_id` = '$category'";
        }

        //filter by brand
        if ($brand != 0) {
            $condition[] = "`brand_id` = '$brand'";
        }

        //filter by color
        if ($color != 0) {
            $condition[] = "`color_id` = '$color'";
        }

        //filter by size
        if ($size != 0) {
            $condition[] = "`size_id` = '$size'";
        }

        //filter by price From
        if (!empty($priceFrom) && empty($priceTo)) {
            $condition[] = "`price` >= '$priceFrom'";
        }

        //filter by price To
        if (!empty($priceTo) && empty($priceFrom)) {
            $condition[] = "`price` <= '$priceTo'";
        }

        //filter by price in between
        if (!empty($priceFrom) && !empty($priceTo)) {
            $condition[] = "`price` BETWEEN '$priceFrom' AND '$priceTo'";
        }

        if (!empty($condition)) {
            $query .= " WHERE " . implode(" AND ", $condition);
        }

        $rs = Database::search($query);
        $num = $rs->num_rows;

        $resultPerPage = 4;
        $noOfPages = ceil($num / $resultPerPage);
        $pageResults = ($page - 1) * $resultPerPage;

        $query .= " LIMIT $resultPerPage OFFSET $pageResults";

        $rs2 = Database::search($query);
        if ($rs2->num_rows) {
            while ($row = $rs2->fetch_assoc()) {

        ?>
                <div class="col-12 col-md-4 col-lg-3 my-3 mt-3">
                    <div class="card rounded-3">
                        <a href="" class="link-light text-decoration-none">
                            <img src="<?php echo ($row["img"]); ?>" class="card-img-top rounded-top-3" alt="..." height="215px">
                            <div class="card-body">
                                <h5 class="card-title fs-4"><?php echo ($row["product_name"]); ?></h5>
                                <p class="card-text"><?php echo ($row["description"]); ?></p>
                                <p class="card-text fs-3 fw-bold text-secondary-emphasis text-end"> LKR <?php echo ($row["price"]); ?></p>
                            </div>
                        </a>
                    </div>
                </div>
            <?php
            }
        } else {
            ?>
            <div class="col-12 text-center mt-5">
                <h2 class="text-danger fw-bold">No Product Found</h2>
                <span class="text-muted">No Matching Products were found for the search text you enterd.</span>
            </div>
        <?php
        }
        ?>
    </div>
</div>

<!-- pagination -->
<?php if ($num > 0) {
?>
    <div class="mt-3 offset-3 col-9 d-flex justify-content-center">
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">

                <li class="page-item">
                    <span class="page-link" aria-label="Previous" <?php
                                                                    if ($page > 1) {
                                                                    ?> onclick="filter(<?php echo ($page - 1); ?>);" <?php
                                                                                                                    }
                                                                                                                        ?>>
                        <span aria-hidden="true">&laquo;</span>
                    </span>
                </li>

                <?php
                for ($i = 1; $i <= $noOfPages; $i++) {
                    if ($i == $page) {
                ?>
                        <li class="page-item active"><span class="page-link" onclick="filter(<?php echo ($i); ?>)"><?php echo ($i); ?></span></li>
                    <?php
                    } else {
                    ?>
                        <li class="page-item"><span class="page-link" onclick="filter(<?php echo ($i); ?>)"><?php echo ($i); ?></span></li>
                <?php
                    }
                }
                ?>

                <li class="page-item">
                    <span class="page-link" aria-label="Next" <?php
                                                                if ($page < $noOfPages) {
                                                                ?> onclick="filter(<?php echo ($page + 1); ?>);" <?php
                                                                                                                }
                                                                                                                    ?>>
                        <span aria-hidden="true">&raquo;</span>
                    </span>
                </li>

            </ul>
        </nav>
    </div>
<?php
} ?>