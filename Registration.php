<?php
require_once "config.php";

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
include "header.php";
?>
    <!-- ======= About Section ======= -->
    <section id="registration" class="about-mf sect-pt4 route">
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
                       Registration
					   <hr class="blueline" />
                      </h1>
                    </div>
                      <div class="about-info">

						<form name="users" id="users" method="post">
							<table class="formtbl">
								<tr>
								<td>Enter Name:</td>
								<td colspan="2">
								<input type="text" name="name" id="name"  required />
								</td>
								</tr>
								<tr>
								<td>Enter Password:
								</td>
								<td colspan="2">
								<input type="password" name="password" id="password" required />
								</td>
								</tr>
								<tr>
								<td>
								Enter Email:</td>
								<td colspan="2">
								<input type="email" name="email" id="email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"/>
								</td></tr>
								<tr>
								<td  colspan="3"><hr class="blueline" /></td>
								</tr>
								<tr>
								<td><a class="highlight" href="index.php">Already Registered?</a></td>
								<td>
								<input type="submit" value="submit" name="btnsubmit"/>
								</td><td>
								<input type="reset" value="Reset" />
								</td>
								</tr>
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
  <?php
include "footer.php";
 ?>  
		 