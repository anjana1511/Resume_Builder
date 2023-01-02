<?php
require_once "config.php";
require_once("Rate.php");
session_start();
if( isset($_SESSION['loggedin']) && !empty($_SESSION['loggedin']) )
{
  
  $id=$_SESSION["id"];
  $username=$_SESSION["username"];
  //echo $username; exit;
}
//echo "error";exit;
$userid=$id;
$rate = new Rate();
$result = $rate->getAllPost($userid);


if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]!=true)
{
    header("location: login.php");
    exit;

}   

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

if(isset($_POST["btnaddlug"]))
{
 // print_r($_POST);exit;
  
  $user_id=$_POST["userid"];
  $lname=$_POST["lname"];
  $rate="50";

  $inse=mysqli_query($conn,"insert into languages(user_id,lname,rate) values('".$userid."','".$lname."','".$rate."')");
  if($inse)
  {
    echo "<script>alert('Language Added')</script>";
   // header("Refresh:0");
    header("location:skills.php");
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
    $updatedata="UPDATE skills SET skill='".$_POST["skill"]."' WHERE user_id='".$_POST["userid"]."' and id='".$edt."'";
  $re=mysqli_query($conn,$updatedata);
  if($re)
  {
    echo "<script>alert('Record Updated')</script>";
    // header("Refresh:0");
    header("location: skills.php");
  }
}
}


if(isset($_GET["edt"]))
{
$edt=$_GET['edt'];
if (isset($_POST["updatelug"]))
{

 // print_r($_POST);exit;
    $updatedata="UPDATE languages SET lname='".$_POST["lname"]."' WHERE user_id='".$_POST["userid"]."' and id='".$edt."'";
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

$select="select * from skills";
$res1=mysqli_query($conn,$select);
?>
<?php 
include "header_single.php";
?>
    <section id="about" class="about-mf sect-pt4 route">
      <div class="container">
       <div class="row">
          <div class="col-sm-12">
            <div class="box-shadow-full">
              <div class="row">

                <div class="col-md-6">
                  <div class="row">
                      <div class="col-sm-12 col-md-12">
                        <div class="title-box-2">
                        <h2 align="center">
                          Add Skills
                          <hr class="blueline" /></h2>
                      </div>
                    <div class="about-info">
                    
          

                        <!-- <form name="create_resume" method="post">  -->
                          <?php
           if(isset($_GET['edit_id']))
                      {
                       $edit_id=$_GET['edit_id'];
             $id=$_SESSION["id"];
             $sel="SELECT * FROM `skills` WHERE user_id=$id and id=$edit_id";
             $show=mysqli_query($conn,$sel);
             $dis=mysqli_fetch_array($show);
              ?>
                        <form name="update_resume" method="post">
                           <div class="form-group row">
                              <div class="col-sm-4">
                        <label for="inputskill">Skill</label>
                              </div>
                           <div class="col-sm-8"> 
                              <input type="text" class="form-control" id="skill" name="skill" placeholder="Skills" value="<?php echo $dis['skill'] ?>" required>
                            </div>
                             &nbsp;&nbsp;&nbsp;&nbsp;
                            <div class="col-sm-12">
                        
                              <input type="hidden" value="<?php echo $id ?>" name="userid">
                              <input type="submit" value="Update Skill" name="updateskill">
                           </div>
                          </div>
                        </form>

           <?php 
                }
                 else
                   {  ?>
                        <form name="create_resume" method="post">
                           <div class="form-group row">
                              <div class="col-sm-4">
                        <label for="inputskill">Skill</label>
				                      </div>
					                 <div class="col-sm-8">	
                              <input type="text" class="form-control" id="skill" name="skill" placeholder="Skills" required>
                            </div>
					                   &nbsp;&nbsp;&nbsp;&nbsp;
                            <div class="col-sm-12">
                        
                              <input type="hidden" value="<?php echo $id ?>" name="userid">
                              <input type="submit" value="Add Skill" name="btnaddskill">
                           </div>
                          </div>
                        </form>

                      <?php } ?>
                             </div>
                            </div>
                          </div>    
                         </div>

                            <div class="col-md-6">
                              <div class="row">
                                <div class="col-sm-12 col-md-12">
                                  <div class="title-box-2">
                                    <h2 align="center">
                                      Add Languages
                                      <hr class="blueline" /></h2>
                                  </div>
                                      <div class="about-info">
                                         <?php if(isset($_GET["edt"])) 
                                          {
                                             
                                            $upd=mysqli_query($conn,"SELECT * FROM languages WHERE user_id=$userid AND id='".$_GET["edt"]."'");
                                             $opq=mysqli_fetch_array($upd);
                                              # code...                                      
                                         ?>
                                        <form name="create_resume1" method="post">
                                           <div class="form-group row">
                                              <div class="col-sm-4">
                                                    <label for="inputskill">Language</label>
                                              </div>
                                           <div class="col-sm-8"> 
                                              <input type="text" class="form-control" id="lname" name="lname" placeholder="Languages" value="<?php echo $opq["lname"]; ?>" required>
                                            </div>
                                             &nbsp;&nbsp;&nbsp;&nbsp;
                                            <div class="col-sm-12">
                                        
                                              <input type="hidden" value="<?php echo $id ?>" name="userid">
                                              <input type="submit" value="Add Language" name="updatelug">
                                           </div>
                                          </div>
                                        </form>
                                          <?php }
                                              else {
                                          ?>
                                         <form name="create_resume1" method="post">
                                           <div class="form-group row">
                                              <div class="col-sm-4">
                                                    <label for="inputskill">Language</label>
                                              </div>
                                           <div class="col-sm-8"> 
                                              <input type="text" class="form-control" id="lname" name="lname" placeholder="Languages" required>
                                            </div>
                                             &nbsp;&nbsp;&nbsp;&nbsp;
                                            <div class="col-sm-12">
                                        
                                              <input type="hidden" value="<?php echo $id ?>" name="userid">
                                              <input type="submit" value="Add Language" name="btnaddlug">
                                           </div>
                                          </div>
                                        </form>

                                      <?php } ?>
                                      </div>
                                  </div>
                                 </div>
                                </div>




                           <!---- Displayy skill......   -->
                            <div class="col-md-6">
                              <div class="row">
                                <div class="col-sm-12 col-md-12">
                                  <div class="title-box-2">
                                    <h2 align="center">
                                      Rate Your Skills
                                      <hr class="blueline" /></h2>
                                  </div>
                                      <div class="about-info">

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
                                </ul>
                                <div><a href="skills.php?edit_id=<?php echo $skills['id']; ?>"><img src="assets/img/edit.png" height="30px" width="30px"></a><a href="skills.php?del_id=<?php echo $skills['id']; ?>"><img src="assets/img/delete.png" height="30px" width="30px"></a></div>
                                </div>
                                  <hr />
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
                              <!-- </form> -->
                                      </div>
                                    </div>
                                   </div>
                                 </div>


                            <div class="col-md-6">
                              <div class="row">
                                <div class="col-sm-12 col-md-12">
                                  <div class="title-box-2">
                                    <h2 align="center">
                                      Rate Your Language
                                      <hr class="blueline" /></h2>
                                  </div>

                                      <div class="about-info">
                                        <table  class="demo-table">
                                          <tbody>
                                          <tr>
                                        <?php
                                            $qur=mysqli_query($conn,"SELECT * FROM languages WHERE user_id=$userid");
                                            $i=0; $trEnd=0;
                                            while($row=mysqli_fetch_array($qur))
                                            {
                                              if($i == 0)
                                              { 
                                        ?>
                                           <tr>
                                          <?php
                                               }
                                          ?>
                                         <td>
                                          <?php echo $row["lname"]; ?><br><br>
                                          <input type="hidden" name="lid" value="<?php echo $row['id']; ?>">

                                          <span id="valBox-<?php echo $row['id'] ?>" hidden="hidden"></span>
                                          
                                          <input type="range" name="ratel" id="ratel" value="<?php echo $row["rate"]; ?>" onchange="showVal(this.value,<?php echo $row["id"]; ?>)" oninput="showVal(this.value,<?php echo $row["id"]; ?>)">
                                          <br><br>
                                          <a href="skills.php?edt=<?php echo $row['id']; ?>"><img src="assets/img/edit.png" height="30px" width="30px"></a><a href="skills.php?del=<?php echo $row['id']; ?>"><img src="assets/img/delete.png" height="30px" width="30px"></a>
                                            <br> <hr/>
                                          </td>
                                           <?php
                                               if($i == 2)
                                               {
                                                  $i=0; $trEnd=1;
                                               }
                                               else
                                               {
                                                $trEnd=0;
                                                $i++;
                                               } 
                                               if($trEnd == 1)
                                               { ?>
                                                   </tr>
                                            <?php  } 
                                          }
                                            if($trEnd == 0)
                                            ?>
                                        </tr>

                                       </tbody>    
                                      </table>  
                                           <!-- <div class="mainr">
                                              <input type="range" min="0" max="100" value="50" id="slider" name="slider">
                                                <div id="selector">
                                                   <div class="SelectBtn"></div>
                                                   <div id="SelectValue"></div> 
                                                    </div> 
                                                    <div id="progressbar"></div>
                                            </div>  -->
                                          
                                        
                                         </div> 
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
<script type="text/javascript">
  

</script>

?>

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
include "footer.php";
 ?>   