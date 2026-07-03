<?php
session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]==true)
{
    header("location: ../resume/home.php");
    exit;

}  
require_once "../config/config.php";
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
$error="";
if(isset($_POST["btnlogin"]))
{
// Check if username is empty
if(empty(trim($_POST["username"]))){
  $username_err="Please enter username.";
} else{
    $username = trim($_POST["username"]);
}

// Check if password is empty
if(empty(trim($_POST["pass"]))){
  $password_err="Please enter your password.";
} else{
    $pass = trim($_POST["pass"]);
}

    // Validate credentials
    if(empty($username_err) && empty($password_err))
    {
        // Prepare a select statement
    $pass=md5($_POST["pass"]);
    $sql = "SELECT * FROM users WHERE name = '$username' and password = '$pass'";
    

    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);


           $count = mysqli_num_rows($result);
   
        if($count == 1) 
        {
            session_start();
                             // Store data in session variables
                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $row['user_id'];
                                $_SESSION["username"] = $username;  
                                $_SESSION["email"]=$row['email'];                        
                                               
            
            header("location: ../resume/home.php");
        }
        else
        {
          $error = "Your Login Name or Password is invalid";
        }
      } else
      {
                    //    echo "Oops! Something went wrong. Please try again later.";
      }
}

?><?php 
include ROOT_PATH."includes/header.php";
?>
<section class="section">
<div class="container">
  <div class="row justify-content-center">

    <div class="col-md-4">

      <div class="card shadow p-4">

        <h3 class="text-center mb-3">Login</h3>

        <?php if(!empty($error)) { ?>
        
          <div class="alert alert-danger">
            <?php echo $error; ?>
          </div>
        <?php } ?>

            <form method="post" name="form1">

          <div class="mb-3">

            <input type="text" name="username" class="form-control" placeholder="Username" required>
          </div>

          <div class="mb-3">
            <input type="password" name="pass" class="form-control" placeholder="Password" required>
          </div>

          <button type="submit" name="btnlogin" value="login"  class="btn btn-primary w-100">
            Login
          </button>

        </form>
        <p class="text-center mt-3">
          Don't have an account? <a href="registration.php">Register</a>
        </p>
      </div>

    </div>

  </div>
</div>
</section>
  <?php
include "../includes/footer.php";
 ?>
</body>
</html>