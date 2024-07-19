<?php require("inc/header.php"); ?>

<div class="container">
  <div class="row">
    <div class="col-8 mx-auto my-5">
      <h1 class="border p-2 my-2 text-center">Create New Post</h1>

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

      <form method="POST" action="app/handelers/handelPost.php">
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input name="title" type="text" class="form-control" value="">
        </div>
        <div class="mb-3">
            <label  class="form-label">Description</label>
            <textarea name="description" class="form-control"  rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label  class="form-label">Post Creator</label>
            <select name="post_creator" class="form-control">
                    <option value="Bahaa">Bahaa</option>
                    <option value="Mohamed">Mohamed</option>
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