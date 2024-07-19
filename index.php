<?php
include('Data/products-data.php');
include('inc/header.php');

$products = $_SESSION['products'];
?>
    <main class="main">       
        <section class="product-tabs section-padding position-relative wow fadeIn animated">
            <div class="bg-square"></div>
            <div class="container">
                <div class="tab-content wow fadeIn animated" id="myTabContent">
                    <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                        <div class="row product-grid-4">
                            <?php foreach($products as $product): ?>
                            <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                                <div class="product-cart-wrap mb-30">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="shop-product-right.html">
                                                <img class="default-img" src="assets/imgs/shop/product-1-1.jpg" alt="">
                                                <img class="hover-img" src="assets/imgs/shop/product-1-2.jpg" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="shop-grid-right.html"><?= $product['category'] ?></a>
                                        </div>
                                        <h2><a href="shop-product-right.html"><?= $product['name'] ?></a></h2>
                                        <div class="product-price">
                                            <span><?= number_format($product['price'],2) ?></span>
                                        </div>
                                        <div class="product-action-1 show">
                                            <a aria-label="Add To Cart" class="action-btn hover-up" href="app/add_to_card.php?id=<?= $product['id'] ?>"><i class="fi-rs-shopping-bag-add"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <!--End product-grid-4-->
                    </div>
                </div>
                <!--End tab-content-->
            </div>
        </section>
    </main>

<?php include('inc/footer.php'); ?>

