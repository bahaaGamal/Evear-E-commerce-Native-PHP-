<?php require("inc/header.php"); ?>
<?php include("app/core/functions.php"); ?>
<?php 
    if(isset($_SESSION["auth"])){
        redirect("index.php");
        die();
    }
 ?>
<div class="container">
  <div class="row">
    <div class="col-8 mx-auto my-5">
      <h1 class="border p-2 my-2 text-center">Create an Account</h1>

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
      <form action="app/handelers/handelRegister.php" method="post">
          <div class="form-group">
              <input type="text"  name="name" placeholder="Name">
          </div>
          <div class="form-group">
              <input type="email"  name="email" placeholder="Email">
          </div>
          <div class="form-group">
              <input  type="password" name="password" placeholder="Password">
          </div>
          <div class="form-group">
              <input type="password" name="confirmPassword" placeholder="Confirm password">
          </div>
          <div class="login_footer form-group">
              <div class="chek-form">
                  <div class="custome-checkbox">
                      <input class="form-check-input" required type="checkbox" name="checkbox" id="exampleCheckbox12" value="">
                      <label class="form-check-label" for="exampleCheckbox12"><span>I agree to terms &amp; Policy.</span></label>
                  </div>
              </div>
          </div>
          <div class="form-group text-center">
              <button type="submit" class="btn btn-fill-out btn-block hover-up" name="login">Submit &amp; Register</button>
          </div>
      </form> 
    </div>
  </div>
</div>

<?php require("inc/footer.php"); ?>

   