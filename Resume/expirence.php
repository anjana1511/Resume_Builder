<?php
require_once "config.php";
require_once("Rate.php");
session_start();

if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]!=true)
{
    header("location: login.php");
    exit;
}  
if( isset($_SESSION['loggedin']) && !empty($_SESSION['loggedin']) )
{
  
  $id=$_SESSION["id"];
  $username=$_SESSION["username"];
  //echo $username; exit;
}
$userid=$id;
$rate = new Rate();
$result = $rate->getAllPost($userid);

// add Skills
if(isset($_POST["btnaddskill"]))
{

   $userid=$_POST["userid"];
   $skill=$_POST["skill"];

   $insert="insert into skills(user_id,skill) values('".$userid."','".$skill."')";
  //  echo $insert;exit;
  $res=mysqli_query($conn,$insert);

  if($res)
  {
    echo "<script>alert('Skill Added')</script>";
    header("Refresh:0");
  }
  else
  {
    echo "<script>alert('Something was wrong')</script>";
  }

}

$select="select * from skills";
$res1=mysqli_query($conn,$select);




//Add expirence
if(isset($_POST["submit"]))
{
    
    $insert="insert into exe_info(user_id,company_name,position,work,duration)
               values('".$_POST["userid"]."','".$_POST["company_name"]."','".$_POST["position"]."','".$_POST["work"]."'
                       ,'".$_POST["duration"]."')";
                      
                       $res=mysqli_query($conn,$insert);
                       if($res)
                       {
                         echo "<script>alert('Record Added')</script>";
                        // header("Refresh:0");
						header("location: home.php");

                       }
                       else
                       {
                         echo "<script>alert('Something was wrong')</script>";
                       }
                     

}

if(isset($_POST["update"]))
{

    $upd="UPDATE exe_info SET company_name='".$_POST["company_name"]."',position='".$_POST["position"]."',work='".$_POST["work"]."',
                                   duration='".$_POST["duration"]."' WHERE user_id='".$_POST["userid"]."'";
								                     
                     $res=mysqli_query($conn,$upd);
                       if($res)
                       {
                         echo "<script>alert('Record Added')</script>";
                         						header("location: home.php");
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
                
			
		<!--------- Add Skills -->
			
			<div class="col-md-6">
                  <div class="row">
				     <div class="col-sm-12 col-md-12">
					   <div class="title-box-2">
                      <h2 align="center">
						Add Skills
					<hr class="blueline" /></h2>
                    </div>
					<div class="about-info">
					
					
					
					<form name="create_resume" method="post">
    
            <form>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label for="inputskill">Skill</label>
				    </div>
					<div class="col-sm-8">	
                        <input type="text" class="form-control" id="skill" name="skill" placeholder="Skills">
                    </div>
					&nbsp;&nbsp;&nbsp;&nbsp;
                    <div class="col-sm-12">
                        
                        <input type="hidden" value="<?php echo $id ?>" name="userid">
                        <input type="submit" value="Add Skill" name="btnaddskill">
                    </div>
                </div>
            </form> 

<?php
if(!empty($result)) {
$i=0;
?>
<table class="demo-table" id="table-to-refresh">
<tbody>
<tr>
<?php
        $x = 0; $trEnd = 0;
foreach ($result as $skills) {
if($x == 0){
                echo '<tr>';
            }
?>
<td valign="top">
<div><?php echo $skills["skill"]; ?></div>
<div id="skills-<?php echo $skills["id"]; ?>">
<input type="hidden" name="rate" id="rate" value="<?php echo $skills["rate"]; ?>" />
<ul onMouseOut="resetRating(<?php echo $skills["id"]; ?>);">
  <?php
  for($i=1;$i<=5;$i++) {
  $selected = "";
  if(!empty($skills["rate"]) && $i<=$skills["rate"]) {
	$selected = "selected";
  }
  ?>
  <li class='<?php echo $selected; ?>' onmouseover="highlightStar(this,<?php echo $skills["id"]; ?>);" onmouseout="removeHighlight(<?php echo $skills["id"]; ?>);" onClick="addRating(this,<?php echo $skills["id"]; ?>);">&#9733;</li>  
  <?php 
  } //for  ?>
<ul>
</div>

</td>
<?php
if($x == 2){
                $x = 0; $trEnd = 1;
            }else{
                $trEnd = 0; $x++;
            }
            if($trEnd == 1) {
                echo '</tr>';
            }			
}  // foreach result	
             if($trEnd == 0) echo '</tr>';
?>
</tr>
<?php
} //first if
else

?>
</tbody>
</table>
</form>					
					
					</div>
				</div>
            </div>				
         </div>
		 
	<!--   Experience Section Start -->	 
		 <div class="col-md-6">
                  <div class="row">
				     <div class="col-sm-12 col-md-12">
					   <div class="title-box-2">
                      <h2 align="center">
						Experience Details
					<hr class="blueline" />
                      </h1>
                    </div>

					 <div class="about-info">
										  
					   <?php
					   $id=$_SESSION["id"];
					   $sel="SELECT * FROM `exe_info` WHERE user_id=$id";
					   $show=mysqli_query($conn,$sel);
					   $dis=mysqli_fetch_array($show);
					   if(!empty($dis))
							{

						?>

           
            <form method="post" name="update">
			       <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="inputcompany_name">Company name</label>
					</div>
					<div class="col-sm-6">
                        <label for="inputposition">Position</label>
					</div>
					</div>
					<div class="form-group row">
					<div class="col-sm-6">
					    <input type="hidden" class="form-control" id="userid" name="userid" value="<?php echo $id; ?>">
                        <input type="text" class="form-control" id="company_name" name="company_name" placeholder="company name" value="<?php echo $dis["company_name"] ?>">
                    </div>

                    <div class="col-sm-6">					
                        <input type="text" class="form-control" id="position" name="position" placeholder="Position" value="<?php echo $dis["position"] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="inputduration">Duration</label>
					</div>
						<div class="col-sm-6">
                        <label for="inputwork">Work</label>
					</div>					
					</div>
					<div class="form-group row">
                    
                    <div class="col-sm-6">					
                        <input type="text" class="form-control" id="duration" name="duration" placeholder="Duration" value="<?php echo $dis["duration"] ?>">
                    </div>
					<div class="col-sm-6">					
                        <input type="text" class="form-control" id="work" name="work" placeholder="Work" value="<?php echo $dis["work"] ?>">
					</div>
                </div>
                <br><br>
                <input class="btn btn-primary px-4 float-center" type="submit" value="submit" id="update" name="update">
            </form>
			
			
			
<?php
}
else
{
?>
            <form method="post" name="create">
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="inputcompany_name">Company name</label>
					</div>
					<div class="col-sm-6">
                        <label for="inputposition">Position</label>
					</div>
					</div>
					<div class="form-group row">
					<div class="col-sm-6">
					    <input type="hidden" class="form-control" id="userid" name="userid" value="<?php echo $id; ?>">
                        <input type="text" class="form-control" id="company_name" name="company_name" placeholder="company name">
                    </div>

                    <div class="col-sm-6">					
                        <input type="text" class="form-control" id="position" name="position" placeholder="position">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="inputduration">Duration</label>
					</div>
						<div class="col-sm-6">
                        <label for="inputwork">Work</label>
					</div>					
					</div>
					<div class="form-group row">
                    
                    <div class="col-sm-6">					
                        <input type="text" class="form-control" id="duration" name="duration" placeholder="Duration">
                    </div>
					<div class="col-sm-6">					
                        <input type="text" class="form-control" id="work" name="work" placeholder="work">
					</div>
                </div>
                <br>
                <input class="btn btn-primary px-4 float-center" type="submit" value="submit" id="submit" name="submit">
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
</section>
  <?php
include "footer.php";
 ?>  
		 