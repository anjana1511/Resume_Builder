<?php
require_once("../config/config.php");
session_start();

if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]!=true)
{
    header("location: ../Auth/login.php");
    exit;
}  

if(isset($_POST["submit"]))
{
    	$date=date("d-m-Y",strtotime($_POST["dob"]));
		$pic=time().$_FILES['userfile']['name'];
        $tmp = $_FILES['userfile']['tmp_name'];

		
    $insert="insert into per_info(user_id,fname,lname,address,city,postalcode,mono,email,dob,gender,lug,hobbies,profession,image)
               values('".$_POST["userid"]."','".$_POST["fname"]."','".$_POST["lname"]."','".$_POST["address"]."'
                       ,'".$_POST["city"]."','".$_POST["pcode"]."','".$_POST["Mono"]."','".$_POST["email"]."','".$date."','".$_POST["gender"]."','".$_POST["lug"]."','".$_POST["hobbies"]."','".$_POST["prof"]."','".$pic."')";
                     
                       $res=mysqli_query($conn,$insert);

                       if($res)
                       {
						    move_uploaded_file($tmp,"../image/users/".$pic);

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

    $date = date("d-m-Y",strtotime($_POST["dob"]));
    $image = $_FILES['userfile']['name'];

    if($image=="")
    {
        $pic = $_POST["hpic"]; // old image
    }
    else
    {
        $pic = $image; // new image
    }

    $target_dir = "../image/users/";
    $target_file = time().$target_dir.$pic;

    $upd="UPDATE per_info SET 
        fname='".$_POST["fname"]."',
        lname='".$_POST["lname"]."',
        address='".$_POST["address"]."',
        city='".$_POST["city"]."',
        postalcode='".$_POST["pcode"]."',
        mono='".$_POST["Mono"]."',
        email='".$_POST["email"]."',
        dob='".$date."',
        gender='".$_POST["gender"]."',
        lug='".$_POST["lug"]."',
        hobbies='".$_POST["hobbies"]."',
        image='".$pic."',
        profession='".$_POST["prof"]."' 
        WHERE user_id='".$_POST["userid"]."'";

    $res=mysqli_query($conn,$upd);

    if($res)
    {
        // upload only if new file selected
        if($image!=""){
            move_uploaded_file($_FILES["userfile"]["tmp_name"], $target_file);
        }

        echo "<script>alert('Record Updated')</script>";
        header("location: Education.php");
    }
    else
    {
        echo "<script>alert('Something was wrong')</script>";
    }

}
?>
<?php 
   include ROOT_PATH.'includes/header.php';
?>
    <!-- ======= About Section ======= -->
    <section>
      <div class="container">
	  <div class="row">
<div class="col-sm-12">
            <div class="box-shadow-full">
              <div class="row">
                <div class="col-md-12">
                  <div class="row">
				     <div class="col-sm-12 col-md-12">
					   <div class="title-box-2">
                        <div class="text-center mb-4">
                        <h2 class="title-a">Personal Information</h2>
                        <p class="text-muted">Fill your personal details for resume</p>
                        </div>
                    </div>
					   <?php
					   $id=$_SESSION["id"];
					   $sel="SELECT * FROM `per_info` WHERE user_id=$id";
					   $show=mysqli_query($conn,$sel);
					   $dis=mysqli_fetch_array($show,MYSQLI_ASSOC);
					//    if(!empty($dis))
					// 		{

						?>
          <div class="resume-form-card">
  
            <form method="post" name="create" enctype="multipart/form-data">
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label for="inputFirstname">First name</label>
					</div>
					<div class="col-md-4">
					    <input type="hidden" class="form-control" id="userid" name="userid" value="<?php echo $id; ?>">
                        <input type="text" class="form-control" id="fname" name="fname" value="<?php if(!empty($dis)) echo $dis["fname"]; ?>" placeholder="First name" required>
                    </div>
                    <div class="col-sm-2">
                        <label for="inputLastname">Last name</label>
					</div>
                    <div class="col-sm-4">					
                        <input type="text" class="form-control" id="lname" name="lname" value="<?php if(!empty($dis)) echo $dis["lname"]; ?>" placeholder="Last name" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label for="inputAddressLine1">Address</label>
					</div>
                    <div class="col-sm-10">					
                        <input type="text" class="form-control" id="address" name="address" value="<?php if(!empty($dis)) echo $dis["address"]; ?>" placeholder="Street Address" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label for="inputCity">City</label>
					</div>
                    <div class="col-sm-4">					
                        <input type="text" class="form-control" id="city" name="city" value="<?php if(!empty($dis)) echo $dis["city"]; ?>" placeholder="City" required>
                    </div>
                    <div class="col-sm-2">
                        <label for="inputPostalCode">Postal Code</label>
					</div>
                    <div class="col-sm-4">					
                        <input type="text" class="form-control" id="pcode" name="pcode" value="<?php if(!empty($dis)) echo $dis["postalcode"]; ?>" placeholder="Postal Code" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label for="inputContactNumber">Contact Number</label>
					</div>
                    <div class="col-sm-4">					
                        <input type="text" class="form-control" id="Mono" name="Mono" value="<?php if(!empty($dis)) echo $dis["mono"]; ?>" placeholder="Contact Number" required>
                    </div>
                    <div class="col-sm-2">
                        <label for="inputEmail">Email</label>
					</div>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="email" name="email" value="<?php if(!empty($dis)) echo $dis["email"]; ?>" placeholder="Email" required>
                    </div>
                </div>
				                <div class="form-group row">
                    <div class="col-sm-2">
                        <label for="inputdob">Date Of Birth</label>
					</div>
					<div class="col-sm-4">	
                        <input type="date" class="form-control" id="dob" name="dob" value="<?php if(!empty($dis)) echo strftime('%Y-%m-%d', strtotime($dis["dob"])); ?>">
                    </div>
                    <div class="col-sm-2">
                        <label for="inputgender">Gender</label>
					</div>
					<div class="col-sm-4">	
					    <input type="radio" id="gender" name="gender" <?php if($dis['gender']=="Male") {echo "checked"; } ?> value="Male" > &nbsp; Male &nbsp;&nbsp;
                        <input type="radio" id="gender" name="gender"<?php if($dis['gender']=="Female") {echo "checked"; } ?> value="Female" > &nbsp; Female
                    </div>
                </div>
				<div class="form-group row">
					<div class="col-sm-2">
                        <label for="inputlug">Language Known</label>
					</div>
					<div class="col-sm-4">	
                        <input type="text" class="form-control" id="lug" name="lug" value="<?php if(!empty($dis)) echo $dis["lug"]; ?>" placeholder="Language known" required>
                    </div>
                    <div class="col-sm-2">
                        <label>Profession</label>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" name="prof" id="prof" class="form-control" value="<?php if(!empty($dis)) echo $dis["profession"]; ?>"placeholder="Eg. Student" required>
                    </div>
				
				</div>
				<div class="form-group row">
					<div class="col-sm-2">
					   <label for="inputlug">Profile image</label>
					</div>
				    <div class="col-sm-6">
				      <input name="userfile" type="file" >
                    </div>
                    <?php if(!empty($dis)){ ?>
                    <input type="hidden" value="<?php echo $dis["image"]; ?>" name="hpic" id="hpic" >
                    <img src="<?php echo BASE_URL; ?>image/users/<?php echo $dis["image"]; ?>" class="profile-preview"/>
                    <?php } ?>
				</div>
                <div class="fo row">
                    <div class="col-sm-2">
                        <label for="inputhobbies">Hobbies</label>
                    </div>
                    <div class="col-sm-10">  
                        <input type="text" class="form-control" id="hobbies" name="hobbies" value="<?php if(!empty($dis)) echo $dis["hobbies"]; ?>" placeholder="Hobbies" required>
                    </div>
                </div>
                <br>
                <?php if(!empty($dis)){ ?>
                <input class="btn btn-primary px-4 float-right" type="submit" value="UPDATE" id="update" name="update">
                 <?php } else {?>
                       <input class="btn btn-primary px-4 float-right" type="submit" value="submit" id="submit" name="submit">
                 <?php } ?>
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
include ROOT_PATH.'includes/footer.php';
 ?>
		 