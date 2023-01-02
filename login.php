<?php
session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]==true)
{
    header("location: home.php");
    exit;

}  
require_once "config.php";
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
                                               
            
            header("location: home.php");
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
include "header.php";
?>
    <!-- ======= About Section ======= -->
    <section id="login" class="about-mf sect-pt4 route">
      <div class="container">
    <div class="row">
          <div class="col-sm-12">
            <div class="box-shadow-full">
              <div class="row">
                <div class="col-md-12">
                  <div class="row">
             <div class="col-sm-12 col-md-12">
             <div class="title-box-2">
                      <h1 align="center">
                       Login
             <hr class="blueline" />
                      </h1>
                    </div>
                      <div class="about-info">
 
            <form method="post" name="form1">
            <table class="formtbl">
              <tr><td><span class="highlight"><?php echo $error; ?></span></td></tr>
            <tr>
                       <td class="title-s">Enter User Name: </td> 
                       <td><input type="text" name="username"/>
                       <div class="form-group " <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                      </td></p>
            </tr>
            <tr>
                          <td class="title-s">Enter Password: </td>
                           <td><input type="password" name="pass" />
                           <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                           </td></tr>
              <tr>
              <td  colspan="2"><hr class="blueline" /></td>
              </tr>
                        <tr><td class="title-s"><a class="highlight" href="Registration.php">New User?</a></td>
            <td><input type="submit" name="btnlogin" value="login" /></td></tr>
            </table>
            </form>
                      </div>
                    </div>
                  </div>
         </div>
                </div>
            </div>    
        </div>
     </div>
    </div>   
  </section> 
  <?php
include "footer.php";
 ?>
</body>
</html>