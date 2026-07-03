<?php
require_once("../config/config.php");

session_start();
if( isset($_SESSION['loggedin']) && !empty($_SESSION['loggedin']) )
{
  
  $id=$_SESSION["id"];
  $username=$_SESSION["username"];
  //echo $username; exit;
}
$userid=$id;
if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]!=true)
{
    header("location: ../Auth/login.php");
    exit;

}   

if(isset($_POST["btnaddskill"]))
{

   $userid=$_POST["userid"];
   $skill=$_POST["skill"];
   $rate=$_POST["ratel"];

   $insert="insert into skills(user_id,skill,rate) values('".$userid."','".$skill."','".$rate."')";
   // echo $insert;exit;


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


if(isset($_GET["edit_id"]))
{
$edt=$_GET['edit_id'];
if (isset($_POST["updateskill"]))
{
    
    $updatedata="UPDATE skills SET skill='".$_POST["skill"]."', rate='".$_POST["ratel"]."' WHERE user_id='".$_POST["userid"]."' and id='".$edt."'";
    $re=mysqli_query($conn,$updatedata);
  if($re)
  {
    echo "<script>alert('Record Updated')</script>";
    // header("Refresh:0");
    header("location: skills.php");
  }
}
}


if(isset($_GET["del_id"]))
{
  $del=$_GET["del_id"];

  $query=mysqli_query($conn,"delete from skills where user_id=$id and id=$del");
  if($query)
  {
    
    echo "<script>alert('Record deleted..')</script>";
    header("location: skills.php");
  }
}

$select="select * from skills where user_id=$userid";
$res1=mysqli_query($conn,$select);

if(isset($_GET["edit_id"]))
{
$res2 = mysqli_query($conn, $select . " AND id='".$_GET["edit_id"]."'");
 $show=mysqli_fetch_array($res2,MYSQLI_ASSOC);
}
?>
<?php 
include ROOT_PATH."includes/header.php";
?>
    <section id="about" class="about-mf sect-pt4 route">
      <div class="container">
       <div class="row">
          <div class="col-sm-6">
            <div class="box-shadow-full">

            				<div class="card shadow-sm border-0 rounded-4 mb-4">
                      <form name="create_resume" method="post">
            				    <div class="card-body">
            				        <h4 class="mb-3">Add Skill</h4>

                            <input type="text" class="form-control mb-2"
                                   id="skill" name="skill" value="<?php if(!empty($show)) echo $show['skill']; ?>" placeholder="Skill Name">
                            <label>
                                Skill Level:
                                <span id="rangeValue">  <?php echo !empty($show) ? $show['rate'] : 50; ?></span>%
                            </label>
            				        <input type="range"
                                     name="ratel" id="ratel"
            				               class="form-range"
                                    min="0"
                                    max="100"
                                    value="<?php echo !empty($show) ? $show['rate'] : 50; ?>"
                                    oninput="rangeValue.innerHTML=this.value">
                            <input type="hidden" value="<?php echo $id ?>" name="userid">

                            <?php  if(!empty($show)) {  ?>
            				        <input type="submit"class="btn btn-primary w-100"value="Update Skill" name="updateskill">
                             <?php } else { ?>
                            <input type="submit"class="btn btn-primary w-100"value="Add Skill" name="btnaddskill">
                            <?php } ?>
            				     </div> 
                       </form> 
            				</div>


            </div> <!-- box-shadow-full  -->
            <div class="col-md-12 mb-3">
                  <div class="card shadow-sm border-0 rounded-4">
                      <div class="card-body">

    <div class="row">

                 
<?php while($row=mysqli_fetch_assoc($res1)){ ?>

<div class="col-md-6 mb-3 border-end">
   <div class="d-flex justify-content-between">
                      <div>
                         <h6 class="mb-1"><?php echo $row["skill"]; ?></h6>
                         <span class="badge bg-success"><?php echo $row["rate"]; ?> %</span>
                      </div>   

                      <div>

                          <a href="skills.php?edit_id=<?php echo $row['id']; ?>"
                             class="text-primary me-3">
                              <i class="bi bi-pencil"></i>
                          </a>

                          <a href="skills.php?del_id=<?php echo $row['id']; ?>"
                             class="text-danger"
                             onclick="return confirm('Delete this skill?')">
                              <i class="bi bi-trash"></i>
                          </a>

                      </div> 
                      <!-- ----- -->

                  </div></div><?php } ?>

                  </div>
              </div>
          </div>
      </div>

          </div>
          <?php include ROOT_PATH."Resume/languages.php"; ?>
       

          
      </div>
  </div>
</section>
<script type="text/javascript">
  

</script>


<!--<script type="text/javascript">
  var slider=document.getElementById("slider");
  var selector=document.getElementById("selector");
  var SelectValue=document.getElementById("SelectValue");
  var progressbar=document.getElementById("progressbar");
  SelectValue.innerHTML=slider.value;

  slider.oninput=function(){
      SelectValue.innerHTML=this.value;
    
    selector.style.left=this.value + "%";
        progressbar.style.width=this.value + "%";

  }
</script> -->
  <?php
include ROOT_PATH."includes/footer.php";
 ?>   