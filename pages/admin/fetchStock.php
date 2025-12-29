<table class="table table-striped">

    <thead>

        <tr>
            <th>#</th>
            <th>Product Name</th>
            <th>Unit Price</th>
            <th>Quentity</th>
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

        $rs = Database::search("SELECT * FROM `stock_details`");
        $num = $rs->num_rows;

        $resultsPerPages = 5;
        $noOfPages = ceil($num / $resultsPerPages);
        $pageResults = ($page - 1) * $resultsPerPages;

        $rs2 = Database::search("SELECT * FROM `stock_details` ORDER BY `stock_id` ASC LIMIT $resultsPerPages OFFSET $pageResults");
        $num2 = $rs2->num_rows;


        while ($row = $rs2->fetch_assoc()) {
        ?>
            <tr>
                <td><?php echo $row["stock_id"]; ?></td>
                <td><?php echo $row["product_name"]; ?></td>
                <td><?php echo "LKR ".$row["price"]; ?></td>
                <td><?php echo $row["qty"]; ?></td>
                <td><?php echo $row["img"]; ?></td>
                <td><?php echo $row["color_name"]; ?></td>
                <td><?php echo $row["cat_name"]; ?></td>
                <td><?php echo $row["size_name"]; ?></td>
                <td><?php echo $row["brand_name"]; ?></td>
                <td>
                    <?php
                    echo ($row["status_id"] == 1)
                        ? '<button class="btn btn-sm btn-primary w-100" onclick="changeStockStatus(' . $row["stock_id"] . ', 2,' . $page . ');">active</button>'
                        : '<button class="btn btn-sm btn-danger w-100" onclick="changeStockStatus(' . $row["stock_id"] . ', 1, ' . $page . ');">inactive</button>';
                    ?>
                </td>
                <!-- <td><button class="btn btn-light btn-sm">edit</button></td> -->
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
                                                        ?> onclick="loadStock(<?php echo ($page - 1); ?>);" <?php
                                                                                                        }
                                                                                                            ?>>
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>

        <?php
        for ($i = 1; $i <= $noOfPages; $i++) {
            if ($i == $page) {
        ?>
                <li class="page-item active"><a class="page-link" onclick="loadStock(<?php echo ($i); ?>)"><?php echo ($i); ?></a></li>
            <?php
            } else {
            ?>
                <li class="page-item"><a class="page-link" onclick="loadStock(<?php echo ($i); ?>)"><?php echo ($i); ?></a></li>
        <?php
            }
        }
        ?>

        <li class="page-item">
            <a class="page-link" aria-label="Next" <?php
                                                    if ($page < $noOfPages) {
                                                    ?> onclick="loadStock(<?php echo ($page + 1); ?>);" <?php
                                                                                                    }
                                                                                                        ?>>
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>

    </ul>
</nav>
<!-- pagination -->