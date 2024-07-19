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
<?php require("inc/header.php"); ?>

<div class="container">
  <div class="row">
    <div class="col-8 mx-auto my-5">
      <h1 class="border p-2 my-2 text-center">Edit Post</h1>

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

      <form method="POST" action="app/handelers/handelEdit.php?id=<?= $post['id'] ?>">
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input name="title" type="text" class="form-control" value="<?= $post['title'] ?>">
        </div>
        <div class="mb-3">
            <label  class="form-label">Description</label>
            <input type="text" name="description" class="form-control"  rows="3" value="<?= $post['description'] ?>"></input>
        </div>

        <div class="mb-3">
            <label  class="form-label">Post Creator</label>
            <select name="post_creator" class="form-control">
                    <option value="Bahaa" <?= $post['post_creator'] == 'Bahaa' ? 'selected' : '' ?>>Bahaa</option>
                    <option value="Mohamed" <?= $post['post_creator'] == 'Mohamed' ? 'selected' : '' ?>>Mohamed</option>
            </select>
        </div>
        <div class="form-group text-center">
              <button type="submit" class="btn btn-fill-out btn-block hover-up" name="login">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php require("inc/footer.php"); ?>