<table class="table table-striped">

    <thead>

        <tr>
            <th>#</th>
            <th>Product Name</th>
            <th>Image</th>
            <th>Color</th>
            <th>Category</th>
            <th>Size</th>
            <th>Brand</th>
            <th class="text-center">Action</th>
        </tr>

    </thead>

    <tbody>
        <?php

        include '../../config/connection.php';

        $page = 1;
        if (isset($_GET["page"]) && $_GET["page"] > 1) {
            $page = $_GET["page"];
        }

        $rs = Database::search("SELECT * FROM `product`");
        $num = $rs->num_rows;

        $resultsPerPages = 5;
        $noOfPages = ceil($num / $resultsPerPages);
        $pageResults = ($page - 1) * $resultsPerPages;

        $rs2 = Database::search("SELECT * FROM `product` 
        INNER JOIN `brand` ON `product`.`brand_id` = `brand`.`brand_id`
        INNER JOIN `color` ON `product`.`color_id` = `color`.`color_id`
        INNER JOIN `category` ON `product`.`cat_id` = `category`.`cat_id`
        INNER JOIN `size` ON `product`.`size_id` = `size`.`size_id` LIMIT $resultsPerPages OFFSET $pageResults");
        $num2 = $rs2->num_rows;


        while ($row = $rs2->fetch_assoc()) {
        ?>
            <tr>
                <th><?php echo $row["product_id"]; ?></th>
                <th><?php echo $row["product_name"]; ?></th>
                <th><?php echo $row["img"]; ?></th>
                <th><?php echo $row["color_name"]; ?></th>
                <th><?php echo $row["cat_name"]; ?></th>
                <th><?php echo $row["size_name"]; ?></th>
                <th><?php echo $row["brand_name"]; ?></th>
                <th>
                    <?php
                    echo ($row["status_id"] == 1)
                        ? '<button class="btn btn-sm btn-primary w-100" onclick="changeProductStatus(' . $row["product_id"] . ', 2,' . $page . ');">active</button>'
                        : '<button class="btn btn-sm btn-danger w-100" onclick="changeProductStatus(' . $row["product_id"] . ', 1, ' . $page . ');">inactive</button>';
                    ?>
                </th>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>

<!-- pagination -->
<nav class="mt-4">
    <ul class="pagination justify-content-end">

        <li class="page-item">
            <a class="page-link" aria-label="Previous" <?php
                                                        if ($page > 1) {
                                                        ?> onclick="loadProdcut(<?php echo ($page - 1); ?>);" <?php
                                                                                                        }
                                                                                                            ?>>
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>

        <?php
        for ($i = 1; $i <= $noOfPages; $i++) {
            if ($i == $page) {
        ?>
                <li class="page-item active"><a class="page-link" onclick="loadProdcut(<?php echo ($i); ?>)"><?php echo ($i); ?></a></li>
            <?php
            } else {
            ?>
                <li class="page-item"><a class="page-link" onclick="loadProdcut(<?php echo ($i); ?>)"><?php echo ($i); ?></a></li>
        <?php
            }
        }
        ?>

        <li class="page-item">
            <a class="page-link" aria-label="Next" <?php
                                                    if ($page < $noOfPages) {
                                                    ?> onclick="loadProdcut(<?php echo ($page + 1); ?>);" <?php
                                                                                                    }
                                                                                                        ?>>
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>

    </ul>
</nav>
<!-- pagination -->