<?php
require_once("../config/config.php");
if (session_status() === PHP_SESSION_NONE)
{
    session_start();
}
if( isset($_SESSION['loggedin']) && !empty($_SESSION['loggedin']) )
{
  
  $id=$_SESSION["id"];
  $username=$_SESSION["username"];
  //echo $username; exit;
}
//echo "error";exit;
$userid=$id;

if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]!=true)
{
    header("location: ../Auth/login.php");
    exit;

}   

if(isset($_POST["btnaddlug"]))
{

  $user_id=$_POST["userid"];
  $lname=$_POST["lname"];
  $level=$_POST["level"];

  $inse=mysqli_query($conn,"insert into languages(user_id,lname,level) values('".$userid."','".$lname."','".$level."')");
  if($inse)
  {
    echo "<script>alert('Language Added');
          window.location='skills.php';
    </script>";
  }
  else
  {
    echo "<script>alert('Something was wrong')</script>";
  }


}

if(isset($_GET["edt"]))
{
$edt=$_GET['edt'];


if (isset($_POST["updatelug"]))
{
  $updatedata="UPDATE languages SET lname='".$_POST["lname"]."' , level='".$_POST["level"]."' WHERE user_id='".$_POST["userid"]."' and id='".$edt."'";
  $re=mysqli_query($conn,$updatedata);
  if($re)
  {
    echo "<script>alert('Record Updated');
          window.location='skills.php';
    </script>";
  }
}
}
if(isset($_GET["del"]))
{
  $del=$_GET["del"];

  $query=mysqli_query($conn,"delete from languages where user_id=$id and id=$del");
  if($query)
  {
    
    echo "<script>alert('Record deleted..');
         window.location='skills.php';
    </script>";

  }
}

  $sel="select * from languages where user_id=$userid";
  $res2=mysqli_query($conn,$sel);

    if(isset($_GET["edt"]))
    {
        $res3=mysqli_query($conn,$sel." AND id='".$_GET["edt"]."' "); 
        $update=mysqli_fetch_array($res3,MYSQLI_ASSOC);
    }    
?>

       <div class="col-sm-6">
            <div class="box-shadow-full">
	           	<div class="card shadow-sm border-0 rounded-4 mb-4">
                        <form name="create_resume1" method="post">
				              <div class="card-body">
				                <h4 class="mb-3">Add Languages</h4>
                                    <input type="text" placeholder="Language" value="<?php if(!empty($update)) echo $update['lname']; ?>" class="form-control mb-2" name="lname" id="lname">
                                    <select class="form-control mb-3" name="level" id="level">
                                        <option value="Beginner"<?= (!empty($update) && $update['level']=="Beginner" ) ? 'selected' : ''; ?>>Beginner</option>
                                        <option value="Intermediate" <?= (!empty($update) && $update['level']=="Intermediate" ) ? 'selected' : ''; ?> >Intermediate</option>
                                        <option value="Advanced" <?= (!empty($update) && $update['level']=="Advanced" ) ? 'selected' : ''; ?> >Advanced</option>
                                        <option value="Native" <?= (!empty($update) && $update['level']=="Native" ) ? 'selected' : ''; ?> >Native</option>
                                    </select>
                                <input type="hidden" value="<?php echo $id ?>" name="userid"> 
                                
                                <?php if(!empty($update)) {  ?>
                                <input type="submit" name="updatelug" value="Update Language" class="btn btn-primary w-100">
                                <?php } else { ?>
                                <input type="submit" name="btnaddlug" value="Add Language" class="btn btn-primary w-100">                    
                                <?php } ?>
                             </div>   <!-- card body  -->
                       </form>
				</div> <!-- card shadow-sm border-0 rounded-4 mb-4   -->
           </div> <!-- box-shadow-full  -->
           <div class="col-md-12 mb-3 ">
                  <div class="card shadow-sm border-0 rounded-4">
                      <div class="card-body">
                           <div class="row">
                                    <?php while($row=mysqli_fetch_assoc($res2)) { ?>

                                        <div class="col-md-6 mb-3 border-end">

                                            <div class="d-flex justify-content-between">

                                                <div>
                                                    <h6 class="mb-1">
                                                        <?php echo $row['lname']; ?>
                                                    </h6>

                                                    <span class="badge bg-success">
                                                        <?php echo $row['level']; ?>
                                                    </span>
                                                </div>

                                                <div>
                                                    <a href="skills.php?edt=<?php echo $row['id']; ?>"
                                                    class="text-primary me-2">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>

                                                    <a href="skills.php?del=<?php echo $row['id']; ?>"
                                                    class="text-danger">
                                                        <i class="bi bi-trash"></i>
                                                    </a>
                                                </div>

                                            </div> <!-- d-flex justify-content-between -->

                                        </div><!--  col-md-6 mb-3 border-end -->

                            <?php } ?>

                        </div> 

                    </div> <!-- card body end -->
                 </div><!--card shadow-sm border-0 rounded-4 -->
          </div> <!--col-md-12 mb-3 -->
</div>   <!-- col-sm-6   -->



