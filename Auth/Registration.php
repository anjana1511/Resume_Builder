<?php
require_once ("../config/config.php");

if(isset($_POST["btnsubmit"]))
{
   $name=$_POST["name"];
   $pass=$_POST["password"];
   $email=$_POST["email"];
   date_default_timezone_set('Asia/Kolkata');
   $created_at=date("Y-m-d h:i:sa");
   $hash_id=md5(uniqid(rand(), true));
   $hash =md5($pass);

    $insert="insert into users(hash_id,name,password,email,created_at) values('$hash_id','$name','$hash','$email','$created_at')";
    
    // echo $insert;exit;
	$res=mysqli_query($conn,$insert);
    if($res)
    {
        echo "<script>alert('Registration Successfully')</script>";
    }
    else
    {
        echo "<script>alert('Something was wrong please try again ')</script>";
    }
    
}
?>
<?php 
include ROOT_PATH."includes/header.php";
?><section id="registration" class="about-mf sect-pt4 route">
  <div class="container">

    <div class="row justify-content-center">
      <div class="col-lg-5">

        <div class="card shadow-lg p-4">

          <h3 class="text-center mb-4">Create Account</h3>

          <?php if(!empty($success_msg)){ ?>
            <div class="alert alert-success">
              <?php echo $success_msg; ?>
            </div>
          <?php } ?>

          <?php if(!empty($error_msg)){ ?>
            <div class="alert alert-danger">
              <?php echo $error_msg; ?>
            </div>
          <?php } ?>

          <form method="post">

            <div class="row mb-3">
              <label class="col-md-4 col-form-label">User Name</label>
              <div class="col-md-8"> 
                   <input type="text" name="name" class="form-control" placeholder="Enter your name" required>
            
               </div>
             </div>

            <div class="row mb-3">
              <label class="col-md-4 col-form-label">Email Address</label>
                <div class="col-md-8">
                  <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                </div>
            </div>

            <div class="row mb-4">
              <label class="col-md-4 col-form-label">Password</label>
                <div class="col-md-8">
                     <input type="password" name="password" class="form-control" placeholder="Create password" required>
                </div>
            </div>

            <div class="d-grid mb-3">
              <button type="submit" name="btnsubmit" class="btn btn-primary">
                Register
              </button>
            </div>

            <div class="text-center">
              <a href="login.php">Already have an account? Login</a>
            </div>

          </form>

        </div>

      </div>
    </div>

  </div>
</section>
  <?php

include ROOT_PATH."includes/footer.php";
 ?>  
		 