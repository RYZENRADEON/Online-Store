<?php
include '../../config/connection.php';
?>

<!-- filter form -->
<?php include 'filterForm.php'; ?>
<!-- filter form -->

<div class="col-10 offset-1 col-md-8 offset-md-0">
    <div class="row">

        <?php
        $search = $_GET['search'];
        // $page = 1;
        $page = (isset($_GET['page']) && $_GET['page'] > 0) ? $_GET['page'] : 1;

        $rs = Database::search("SELECT * FROM `stock_details` WHERE `product_name` LIKE '%$search%' AND `stock_status` = 'active' AND `status` = 'active'");
        $num = $rs->num_rows;

        $resultsPrePage = 4;
        $noOfPages = ceil($num / $resultsPrePage);
        $pageResults = ($page - 1) * $resultsPrePage;

        $rs2 = Database::search("SELECT * FROM `stock_details` WHERE `product_name` LIKE '%$search%'  AND `stock_status` = 'active' AND `status` = 'active' LIMIT $resultsPrePage OFFSET $pageResults");

        if ($rs2->num_rows) {
            while ($row = $rs2->fetch_assoc()) {

        ?>
                <div class="col-12 col-md-4 col-lg-3 my-3 mt-3">
                    <div class="card rounded-3">
                        <a href="singleProductView.php?productId=<?php echo($row['stock_id']); ?>" class="link-light text-decoration-none">
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
                                                                    ?> onclick="search(<?php echo ($page - 1); ?>);" <?php
                                                                                                                    }
                                                                                                                        ?>>
                        <span aria-hidden="true">&laquo;</span>
                    </span>
                </li>

                <?php
                for ($i = 1; $i <= $noOfPages; $i++) {
                    if ($i == $page) {
                ?>
                        <li class="page-item active"><span class="page-link" onclick="search(<?php echo ($i); ?>)"><?php echo ($i); ?></span></li>
                    <?php
                    } else {
                    ?>
                        <li class="page-item"><span class="page-link" onclick="search(<?php echo ($i); ?>)"><?php echo ($i); ?></span></li>
                <?php
                    }
                }
                ?>

                <li class="page-item">
                    <span class="page-link" aria-label="Next" <?php
                                                                if ($page < $noOfPages) {
                                                                ?> onclick="search(<?php echo ($page + 1); ?>);" <?php
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