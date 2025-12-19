<?php
include  "../../config/connection.php";

session_start();
if (isset($_SESSION["admin"])) {
?>
    <!DOCTYPE html>
    <html lang="en" data-bs-theme="dark">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Product Managment | Online Store</title>

        <link rel="icon" href="../../assets/images/logo/logo01.png">
        <link rel="stylesheet" href="../../assets/css/bootstrap.css">
        <link rel="stylesheet" href="../../assets/css/style.css">
    </head>

    <body id="adminUserPage" data-page="1">
        <!-- Include the admin header -->
        <?php include 'adminHeader.php'; ?>
        <!-- Include the admin header -->

        <div class="container admin-body">
            <div class="row d-flex justify-content-center">
                <div class="col-10 mt-3">
                    <h2 class="text-center">Product Managment</h2>
                    <div class="row">

                        <div class="col-12 d-flex justify-content-center mb-2">
                            <button class="btn btn-sm btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#registerProductModal">Register Product</button>
                        </div>

                        <div class="col-6 offset-3 d-flex justify-content-center mb-3">
                            <button class="btn btn-sm btn-primary me-2" data-bs-toggle="modal" data-bs-target="#registerBrandModal">Register New Brand</button>
                            <button class="btn btn-sm btn-secondary me-2" data-bs-toggle="modal" data-bs-target="#registerColorModal">Register New Color</button>
                            <button class="btn btn-sm btn-secondary me-2" data-bs-toggle="modal" data-bs-target="#registerCategoryModal">Register New Category</button>
                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#registerSizeModal">Register New Size</button>
                        </div>

                        <div class="mt-4 table-responsive" id="content">
                            <!-- fetch product -->

                            <!-- fetch product -->
                        </div>

                    </div>
                </div>
            </div>

            <!-- Include the admin footer -->
            <?php include 'adminFooter.php'; ?>
            <!-- Include the admin footer -->

            <!-- Register Brand Modal -->
            <div class="modal fade" id="registerBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5">Register Brand</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-2">
                                <label for="regBrand" class="form-label">Brand Name</label>
                                <input type="text" class="form-control" id="regBrandName">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="regBrandBtn">Add Brand</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Register Brand Modal -->

            <!-- Register Color Modal -->
            <div class="modal fade" id="registerColorModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5">Register Color</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-2">
                                <label for="" class="form-label">Color Name</label>
                                <input type="text" class="form-control" id="regColorName">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="regColorBtn">Add Color</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Register Color Modal -->

            <!-- Register Category Modal -->
            <div class="modal fade" id="registerCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5">Register Category</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-2">
                                <label for="" class="form-label">Category Name</label>
                                <input type="text" class="form-control" id="regCategoryName">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="regCategoryBtn">Add Category</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Register Category Modal -->

            <!-- Register Size Modal -->
            <div class="modal fade" id="registerSizeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5">Register Size</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-2">
                                <label for="" class="form-label">Size Name</label>
                                <input type="text" class="form-control" id="regSizeName">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="regSizeBtn">Add Size</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Register Size Modal -->

            <!-- Register Product Modal -->
            <div class="modal fade" id="registerProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5">Register Product</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="mb-2">
                                <label for="" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="regProducteName">
                            </div>

                            <div class="mb-2">
                                <label for="" class="form-label">Product Description</label>
                                <textarea type="text" class="form-control" id="regProducteDes" rows="5"></textarea>
                            </div>

                            <div class="mb-2">
                                <label for="regProductCat" class="form-label">Category</label>
                                <select id="regProductCat" class="form-select">
                                    <option value="0">Select Category</option>
                                    <?php
                                    $rs = Database::search("SELECT * FROM `category`");
                                    $num = $rs->num_rows;

                                    for ($x = 0; $x < $num; $x++) {
                                        $row = $rs->fetch_assoc();
                                    ?>
                                        <option value="<?php echo ($row["cat_id"]) ?>"><?php echo ($row["cat_name"]) ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="mb-2">
                                <label for="regProductCol" class="form-label">Color</label>
                                <select id="regProductCol" class="form-select">
                                    <option value="0">Select Color</option>
                                    <?php
                                    $rs = Database::search("SELECT * FROM `color`");
                                    $num = $rs->num_rows;

                                    for ($x = 0; $x < $num; $x++) {
                                        $row = $rs->fetch_assoc();
                                    ?>
                                        <option value="<?php echo ($row["color_id"]) ?>"><?php echo ($row["color_name"]) ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="mb-2">
                                <label for="regProductBrand" class="form-label">Brand</label>
                                <select id="regProductBrand" class="form-select">
                                    <option value="0">Select Brand</option>
                                    <?php
                                    $rs = Database::search("SELECT * FROM `brand`");
                                    $num = $rs->num_rows;

                                    for ($x = 0; $x < $num; $x++) {
                                        $row = $rs->fetch_assoc();
                                    ?>
                                        <option value="<?php echo ($row["brand_id"]) ?>"><?php echo ($row["brand_name"]) ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="mb-2">
                                <label for="regProductSize" class="form-label">Size</label>
                                <select id="regProductSize" class="form-select">
                                    <option value="0">Select Size</option>
                                    <?php
                                    $rs = Database::search("SELECT * FROM `size`");
                                    $num = $rs->num_rows;

                                    for ($x = 0; $x < $num; $x++) {
                                        $row = $rs->fetch_assoc();
                                    ?>
                                        <option value="<?php echo ($row["size_id"]) ?>"><?php echo ($row["size_name"]) ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="mb-2">
                                <label for="" class="form-label">Product Image</label>
                                <input type="file" id="regProductImg" class="form-control">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="regProductBtn">Add Product</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Register Product Modal -->

            <script src="../../assets/js/script.js"></script>
            <script src="../../assets/js/bootstrap.js"></script>
    </body>

    </html>
<?php
} else {
    header("Location: adminSignIn.php");
    exit;
}
?>