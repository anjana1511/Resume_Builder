<?php
require_once "config.php";
session_start();

if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]!=true)
{
    header("location: login.php");
    exit;
}  

if(isset($_POST["submit"]))
{
    	$date=date("d-m-Y",strtotime($_POST["dob"]));
		$pic=$_FILES['userfile']['name'];
		
    $insert="insert into per_info(user_id,fname,lname,address,city,postalcode,mono,email,dob,gender,lug,hobbies,profession,image)
               values('".$_POST["userid"]."','".$_POST["fname"]."','".$_POST["lname"]."','".$_POST["address"]."'
                       ,'".$_POST["city"]."','".$_POST["pcode"]."','".$_POST["Mono"]."','".$_POST["email"]."','".$date."','".$_POST["gender"]."','".$_POST["lug"]."','".$_POST["hobbies"]."','".$_POST["prof"]."','".$pic."')";
                     
                       $res=mysqli_query($conn,$insert);
                       if($res)
                       {
						    move_uploaded_file($_FILES['userfile']['name'],"image/users/$img");

                         echo "<script>alert('Record Added')</script>";
                        // header("Refresh:0");
						header("location: Education.php");

                       }
                       else
                       {
                         echo "<script>alert('Something was wrong')</script>";
                       }
                     

}

if(isset($_POST["update"]))
{


	$date=date("d-m-Y",strtotime($_POST["dob"]));
	$image=$_FILES['userfile']['name'];
    if($image=="")
    {
        $pic=$_POST["hpic"];
    }
    else
    {
        $pic=$image;
    }
	$target_dir = "image/users/";
    $target_file = $target_dir . basename($_FILES["userfile"]["name"]);
						 	  
	
    $upd="UPDATE per_info SET fname='".$_POST["fname"]."',lname='".$_POST["lname"]."',address='".$_POST["address"]."',
                                   city='".$_POST["city"]."',postalcode='".$_POST["pcode"]."',mono='".$_POST["Mono"]."',email='".$_POST["email"]."',dob='".$date."',gender='".$_POST["gender"]."',lug='".$_POST["lug"]."',hobbies='".$_POST["hobbies"]."',image='".$pic."',profession='".$_POST["prof"]."' WHERE user_id='".$_POST["userid"]."'";
                

                     $res=mysqli_query($conn,$upd);
                       if($res)
                       {
                         move_uploaded_file($_FILES["userfile"]["tmp_name"],$target_file);
                         echo "<script>alert('Record Added')</script>";
                         						header("location: Education.php");
                       }
                       else
                       {
                         echo "<script>alert('Something was wrong')</script>";
                       }
     
}
?>
<?php 
include "header_single.php";
?>
    <!-- ======= About Section ======= -->
    <section id="about" class="about-mf sect-pt4 route">
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
						Personal Information
					<hr class="blueline" />
                      </h1>
                    </div>
					   <?php
					   $id=$_SESSION["id"];
					   $sel="SELECT * FROM `per_info` WHERE user_id=$id";
					   $show=mysqli_query($conn,$sel);
					   $dis=mysqli_fetch_array($show,MYSQLI_ASSOC);
					   if(!empty($dis))
							{

						?>
                      <div class="about-info">
            
            <form method="post" name="update" enctype="multipart/form-data">
			     <input type="hidden" class="form-control" id="userid" name="userid" value="<?php echo $id; ?>">
				   <div class="form-group row">
                    <div class="col-sm-2">
                        <label for="inputFirstname">First name</label>
					</div>
                     <div class="col-sm-4">                 					
                        <input type="text" class="form-control" id="fname" name="fname" placeholder="First name" value="<?php echo $dis["fname"] ?>" required>
                    </div>
                    <div class="col-sm-2">
                        <label for="inputLastname">Last name</label>
					</div>	
					<div class="col-sm-4">
                        <input type="text" class="form-control" id="lname" name="lname" placeholder="Last name" value="<?php echo $dis["lname"] ?>" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label for="inputAddressLine1">Address</label>
					</div>
                    <div class="col-sm-10">					
                        <input type="text" class="form-control" id="address" name="address" placeholder="Street Address" value="<?php echo $dis["address"] ?>" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label for="inputCity">City</label>
					</div>
					<div class="col-sm-4">
                        <input type="text" class="form-control" id="city" name="city" placeholder="City" value="<?php echo $dis["city"] ?>" required>
                    </div>
                    <div class="col-sm-2">
                        <label for="inputPostalCode">Postal Code</label>
					</div>
                    <div class="col-sm-4">					
                        <input type="text" class="form-control" id="pcode" name="pcode" placeholder="Postal Code" value="<?php echo $dis["postalcode"] ?>" required>
                    </div>
                </div> 
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label for="inputContactNumber">Contact Number</label>
					</div>
					<div class="col-sm-4">	
                        <input type="text" class="form-control" id="Mono" name="Mono" placeholder="Contact Number" value="<?php echo $dis["mono"] ?>" required>
                    </div>
                    <div class="col-sm-2">
                        <label for="inputEmail">Email</label>
					</div>
					<div class="col-sm-4">	
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $dis["email"] ?>" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label for="inputdob">Date Of Birth</label>
					</div>
					<div class="col-sm-4">	
                        <input type="date" class="form-control" id="dob" name="dob" value="<?php echo strftime('%Y-%m-%d', strtotime($dis["dob"])); ?>" required>
                    </div>
                    <div class="col-sm-2">
                        <label for="inputgender">Gender</label>
					</div>
					<div class="col-sm-4">	
					    <input type="radio" id="gender" name="gender" <?php if($dis['gender']=="Male") {echo "checked"; } ?> value="Male" > &nbsp; Male &nbsp;&nbsp;
                        <input type="radio" id="gender" name="gender" <?php if($dis['gender']=="Female") {echo "checked"; } ?> value="Female"> &nbsp; Female
                    </div>
                </div>
				<div class="form-group row">
					<div class="col-sm-2">
                        <label for="inputlug">Language Known</label>
					</div>
					<div class="col-sm-4">	
                        <input type="text" class="form-control" id="lug" name="lug" placeholder="Language known" value="<?php echo $dis["lug"] ?>" required>
                    </div>
                     
                    <div class="col-sm-2">
                        <label>Profession</label>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" name="prof" id="prof" class="form-control" placeholder="Eg. Student" value="<?php echo $dis["profession"] ?>" required>
                    </div>
				</div>
				<div class="form-group row">
					<div class="col-sm-2">
					   <label for="inputlug">Profile image</label>
					</div>
				    <div class="col-sm-6">
				      <input name="userfile" type="file" id="file">
                      <input type="hidden" value="<?php echo $dis["image"]; ?>" name="hpic" id="hpic" >
					</div>
					<img src="image/users/<?php echo $dis["image"] ?>" height="60px" width="40px"/>
				</div>
                <div class="form-group row">
                   <div class="col-sm-2">
                        <label for="inputhobbies">Hobbies</label>
                    </div>
                    <div class="col-sm-10">  
                        <input type="text" class="form-control" id="hobbies" name="hobbies" placeholder="Hobbies" value="<?php echo $dis["hobbies"] ?>" required>
                    </div>
                </div>
				
				
                <br>
                <input class="btn btn-primary px-4 float-right" type="submit" value="UPDATE" id="update" name="update">
            </form>
<?php
}
else
{
?>
            <form method="post" name="create" enctype="multipart/form-data">
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label for="inputFirstname">First name</label>
					</div>
					<div class="col-sm-4">
					    <input type="hidden" class="form-control" id="userid" name="userid" value="<?php echo $id; ?>">
                        <input type="text" class="form-control" id="fname" name="fname" placeholder="First name" required>
                    </div>
                    <div class="col-sm-2">
                        <label for="inputLastname">Last name</label>
					</div>
                    <div class="col-sm-4">					
                        <input type="text" class="form-control" id="lname" name="lname" placeholder="Last name" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label for="inputAddressLine1">Address</label>
					</div>
                    <div class="col-sm-10">					
                        <input type="text" class="form-control" id="address" name="address" placeholder="Street Address" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label for="inputCity">City</label>
					</div>
                    <div class="col-sm-4">					
                        <input type="text" class="form-control" id="city" name="city" placeholder="City" required>
                    </div>
                    <div class="col-sm-2">
                        <label for="inputPostalCode">Postal Code</label>
					</div>
                    <div class="col-sm-4">					
                        <input type="text" class="form-control" id="pcode" name="pcode" placeholder="Postal Code" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label for="inputContactNumber">Contact Number</label>
					</div>
                    <div class="col-sm-4">					
                        <input type="text" class="form-control" id="Mono" name="Mono" placeholder="Contact Number" required>
                    </div>
                    <div class="col-sm-2">
                        <label for="inputEmail">Email</label>
					</div>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email" required>
                    </div>
                </div>
				                <div class="form-group row">
                    <div class="col-sm-2">
                        <label for="inputdob">Date Of Birth</label>
					</div>
					<div class="col-sm-4">	
                        <input type="date" class="form-control" id="dob" name="dob">
                    </div>
                    <div class="col-sm-2">
                        <label for="inputgender">Gender</label>
					</div>
					<div class="col-sm-4">	
					    <input type="radio" id="gender" name="gender" checked required> &nbsp; Male &nbsp;&nbsp;
                        <input type="radio" id="gender" name="gender"> &nbsp; Female
                    </div>
                </div>
				<div class="form-group row">
					<div class="col-sm-2">
                        <label for="inputlug">Language Known</label>
					</div>
					<div class="col-sm-4">	
                        <input type="text" class="form-control" id="lug" name="lug" placeholder="Language known" required>
                    </div>
                    <div class="col-sm-2">
                        <label>Profession</label>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" name="prof" id="prof" class="form-control" placeholder="Eg. Student" required>
                    </div>
				
				</div>
				<div class="form-group row">
					<div class="col-sm-2">
					   <label for="inputlug">Profile image</label>
					</div>
				    <div class="col-sm-6">
				      <input name="userfile" type="file" >
					</div>
				</div>
                <div class="fo row">
                    <div class="col-sm-2">
                        <label for="inputhobbies">Hobbies</label>
                    </div>
                    <div class="col-sm-10">  
                        <input type="text" class="form-control" id="hobbies" name="hobbies" placeholder="Hobbies" required>
                    </div>
                </div>
                <br>
                <input class="btn btn-primary px-4 float-right" type="submit" value="submit" id="submit" name="submit">
            </form>
<?php } ?>

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
		 