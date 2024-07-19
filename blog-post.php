<?php

// Get Posts
$jsonData = file_get_contents('Data/post.json');
$data = json_decode($jsonData, true);
$posts =$data['posts'];

// Check Post ID

$id =$_GET['id'];

if(!is_numeric($id)){
  header("location: blog.php");
  exit();
}

$exists = false;
foreach($posts as $post){
  if($post['id'] == $id){
    $exists = true;
    break;
  }
}

if(!$exists){
  header("location: blog.php");
  exit();
}
?>
<?php require_once("inc/header.php"); ?>

    <main class="main">
        <section class="mt-50 mb-50">
            <div class="container custom">
                <div class="row">
                    <div class="col-lg-10 m-auto">
                        <div class="single-page pl-30">
                            <div class="single-header style-2">
                                <h1 class="mb-30"><?= $post['title'];?></h1>
                                <div class="single-header-meta">
                                    <div class="entry-meta meta-1 font-xs mt-15 mb-15">
                                        <span class="post-by">Post By: <?= $post['post_creator'];?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="single-content"><?= $post['description'];?> </div>
                            <div class="entry-bottom mt-50 mb-30 wow fadeIn  animated" style="visibility: visible; animation-name: fadeIn;">
                                <div class="tags w-50 w-sm-100">
                                    <a href="edit-post.php?id=<?= $post['id'] ?>" rel="tag" class="hover-up btn btn-primary btn-rounded mr-10">Edit</a>
                                    <a href="app/handelers/handelDelete.php?id=<?= $post['id'] ?>" rel="tag" class="hover-up btn btn-danger btn-rounded mr-10">Delete</a>
                                </div>
                            </div>
                            <div class="comments-area">
                                <div class="row">
                                    <div class="col-12">
                                        <h4 class="mb-30">Comments</h4>
                                        <div class="comment-list">
                                            <?php 
                                                if(isset($post['comments'])):
                                                foreach($post['comments'] as $comment): 
                                            ?>
                                            <div class="single-comment justify-content-between d-flex">
                                                <div class="user justify-content-between d-flex">
                                                    <div class="thumb text-center">
                                                        <img src="assets/imgs/page/avatar-6.jpg" alt="">
                                                        <h6><?= $comment['name'] ?></h6>
                                                    </div>
                                                    <div class="desc">
                                                        <p><?= $comment['comment'] ?></p>
                                                        <!-- Display replies -->
                                                        <?php 
                                                            if(isset($comment['replies'])):
                                                            echo "<hr>";
                                                            foreach($comment['replies'] as $reply): 
                                                        ?>
                                                        <div class="replies">
                                                            <div class="single-reply">
                                                                <p><strong><?= $reply['name'] ?>:</strong> <?= $reply['reply'] ?></p>
                                                            </div>
                                                        </div>
                                                        <?php
                                                            endforeach;
                                                            endif;        
                                                        ?>
                                                        
                                                    </div>
                                                </div>
                                                <!-- Reply form -->
                                                <div class="reply-form">
                                                    <!-- Print Errors -->
                                                    <?php 
                                                    if(isset($_SESSION['errors'])):
                                                    foreach($_SESSION['errors'] as $error): 
                                                    ?>
                                                    <div class="alert alert-danger text-center">
                                                        <?php echo $error; ?>
                                                    </div>
                                                    <?php
                                                    endforeach;
                                                    unset($_SESSION['errors']);
                                                    endif;        
                                                    ?>
                                                    <form action="app/handelers/handelReply.php?id=<?= $post['id'] ?>&comment_id=<?= $comment['comment_id'] ?>" method="POST" class="form-inline">
                                                        <div class="form-group mb-2">
                                                            <input type="text" name="reply" class="form-control" placeholder="Write your reply..."></ه>
                                                        </div>
                                                        <div class="form-group mb-2">
                                                            <input type="text" name="name" class="form-control" placeholder="Your name">
                                                        </div>
                                                        <button type="submit" class="btn btn-primary mb-2">Reply</button>
                                                    </form>
                                                </div>
                                            </div>
                                            <?php
                                                endforeach;
                                                endif;        
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="comment-form">
                                <h4 class="mb-15">Leave a Comment</h4>
                                </div>
                                <div class="row">
                                    <div class="col-lg-8 col-md-12">
                                        <!-- Print Errors -->
                                        <?php 
                                        if(isset($_SESSION['errors'])):
                                        foreach($_SESSION['errors'] as $error): 
                                        ?>
                                        <div class="alert alert-danger text-center">
                                            <?php echo $error; ?>
                                        </div>
                                        <?php
                                        endforeach;
                                        unset($_SESSION['errors']);
                                        endif;        
                                        ?>
                                        <form method="POST" class="form-contact comment_form" action="app/handelers/handelComment.php?id=<?= $post['id'] ?>" id="commentForm">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9" placeholder="Write Comment"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <input class="form-control" name="name" id="name" type="text" placeholder="Name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="button button-contactForm">Post Comment</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php require_once("inc/footer.php"); ?>
