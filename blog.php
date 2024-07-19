<?php require_once("inc/header.php"); ?>
<?php 
$jsonData = file_get_contents('Data/post.json');
$data = json_decode($jsonData, true);
$posts =$data['posts'];
?>
    <main class="main">
        <section class="mt-50 mb-50">
            <div class="container custom">               
                <div class="cart-action mb-20 text-left">
                    <a href="add-post.php" class="btn "><i class="fi-rs-plus mr-10"></i>Add New Post</a>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="single-header mb-50 text-center">
                            <h1 class="font-xxl text-brand">Our Blog</h1>
                        </div>
                        <div class="loop-grid pr-30">
                            <div class="row">
                                <?php foreach($posts as $post): ?>
                                <div class="col-lg-4">
                                    <article class="wow fadeIn animated hover-up mb-30">
                                        <div class="entry-content-2">
                                            <h3 class="post-title mb-15"><?= $post['title'] ?></h3>
                                            <p class="post-exerpt mb-30"><?= $post['description'] ?></p>
                                            <div class="entry-meta meta-1 font-xs color-grey mt-10 pb-10">
                                                <div>
                                                    <span class="post-on">Post By: <?= $post['post_creator'] ?></span>
                                                </div>
                                                <a href="blog-post.php?id=<?= $post['id'] ?>" class="text-brand">Read more <i class="fi-rs-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <!--post-grid-->
                        <div class="pagination-area mt-15 mb-lg-0">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-start">
                                    <li class="page-item active"><a class="page-link" href="#">01</a></li>
                                    <li class="page-item"><a class="page-link" href="#">02</a></li>
                                    <li class="page-item"><a class="page-link" href="#">03</a></li>
                                    <li class="page-item"><a class="page-link dot" href="#">...</a></li>
                                    <li class="page-item"><a class="page-link" href="#">16</a></li>
                                    <li class="page-item"><a class="page-link" href="#"><i class="fi-rs-angle-double-small-right"></i></a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php require_once("inc/footer.php"); ?>
