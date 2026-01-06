<?php
session_start();
if (isset($_SESSION["user"])) {
?>
    <!DOCTYPE html>
    <html lang="en" data-bs-theme="dark">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home | Online Store</title>

        <link rel="icon" href="../../assets/images/logo/logo01.png">
        <link rel="stylesheet" href="../../assets/css/style.css">
        <link rel="stylesheet" href="../../assets/css/bootstrap.css">
    </head>

    <body>
        <!-- Include the user header -->
        <?php include 'userHeader.php'; ?>
        <!-- Include the user header -->

        <div class="container-fluid mb-5">
            <div class="row">
                <div class="col-5 offset-3 mt-3">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="search" placeholder="Search...">
                        <label for="search">search</label>
                    </div>
                </div>

                <div class="col-1 mt-4 d-grid">
                    <button class="btn btn-sm btn-secondary">search</button>
                </div>
            </div>

            <div class="row">
                <div class="col-12 mt-5 mx-0 overflow-hidden">
                    <img src="../../assets/images/banners/23761001_6811885.jpg" alt="" width="100%" height="325px" style="position: relative; transform: scale(1.1); object-fit: cover; transition: transform 0.5s ease;">
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-8 offset-2">
                    <div class="row">

                        <div class="col-12 col-md-4 col-lg-3 my-3 mt-3">
                            <div class="card rounded-3">
                                <a href="" class="link-light text-decoration-none"><img src="../../assets/images/product/694dd21015b4eimages.jpg" class="card-img-top rounded-top-3" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title fs-4">Card title</h5>
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card’s content.</p>
                                        <p class="card-text fs-3 fw-bold text-secondary-emphasis text-end"> LKR 2500.00</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg-3 my-3 mt-3">
                            <div class="card rounded-3">
                                <a href="" class="link-light text-decoration-none"><img src="../../assets/images/product/694dd21015b4eimages.jpg" class="card-img-top rounded-top-3" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title fs-4">Card title</h5>
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card’s content.</p>
                                        <p class="card-text fs-3 fw-bold text-secondary-emphasis text-end"> LKR 2500.00</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg-3 my-3 mt-3">
                            <div class="card rounded-3">
                                <a href="" class="link-light text-decoration-none"><img src="../../assets/images/product/694dd21015b4eimages.jpg" class="card-img-top rounded-top-3" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title fs-4">Card title</h5>
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card’s content.</p>
                                        <p class="card-text fs-3 fw-bold text-secondary-emphasis text-end"> LKR 2500.00</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg-3 my-3 mt-3">
                            <div class="card rounded-3">
                                <a href="" class="link-light text-decoration-none"><img src="../../assets/images/product/694dd21015b4eimages.jpg" class="card-img-top rounded-top-3" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title fs-4">Card title</h5>
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card’s content.</p>
                                        <p class="card-text fs-3 fw-bold text-secondary-emphasis text-end"> LKR 2500.00</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg-3 my-3 mt-3">
                            <div class="card rounded-3">
                                <a href="" class="link-light text-decoration-none"><img src="../../assets/images/product/694dd21015b4eimages.jpg" class="card-img-top rounded-top-3" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title fs-4">Card title</h5>
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card’s content.</p>
                                        <p class="card-text fs-3 fw-bold text-secondary-emphasis text-end"> LKR 2500.00</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg-3 my-3 mt-3">
                            <div class="card rounded-3">
                                <a href="" class="link-light text-decoration-none"><img src="../../assets/images/product/694dd21015b4eimages.jpg" class="card-img-top rounded-top-3" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title fs-4">Card title</h5>
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card’s content.</p>
                                        <p class="card-text fs-3 fw-bold text-secondary-emphasis text-end"> LKR 2500.00</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg-3 my-3 mt-3">
                            <div class="card rounded-3">
                                <a href="" class="link-light text-decoration-none"><img src="../../assets/images/product/694dd21015b4eimages.jpg" class="card-img-top rounded-top-3" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title fs-4">Card title</h5>
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card’s content.</p>
                                        <p class="card-text fs-3 fw-bold text-secondary-emphasis text-end"> LKR 2500.00</p>
                                    </div>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <!-- Include the user footer -->
        <?php include '../admin/adminFooter.php'; ?>
        <!-- Include the user footer -->

        <script src="../../assets/js/script.js"></script>
        <script src="../../assets/js/bootstrap.js"></script>
    </body>

    </html>
<?php
} else {
    header('location:../../index.php');
    exit;
}
