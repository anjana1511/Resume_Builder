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
}
$userid=$id;

$check = mysqli_query(
    $conn,
    "SELECT * FROM summary WHERE user_id='$id' LIMIT 1"
);

if(mysqli_num_rows($check) > 0)
{
    $data = mysqli_fetch_assoc($check);
     if(!empty(trim($data['career_objective'])))
        {
                  $isEdit2 = true;
        }
        else
         {
            $isEdit2= false;
         }   

}
else
{
    $isEdit2 = false;
}

if(isset($_POST["add_objective"]))
{
    $data = mysqli_fetch_assoc($check);
     if(!empty(trim($data['career_objective'])))
        {
                $insert="insert into summary(user_id,career_objective)
                values('".$_POST["userid"]."','".$_POST["objective"]."')";
                $res=mysqli_query($conn,$insert);
        }   
        else 
            {
                $update="UPDATE summary set career_objective='".$_POST["objective"]."' WHERE user_id='".$_POST["userid"]."' ";
                $res=mysqli_query($conn,$update);
             }          
                       if($res)
                       {
                         echo "<script>alert('Record Added');
                               window.location=summary.php;
                               </script>";
                       }
                       else
                       {
                         echo "<script>alert('Something was wrong')</script>";
                       }
                     

}


if(isset($_POST["up_objective"]))
{

    $upd="UPDATE summary SET career_objective='".$_POST["objective"]."' WHERE user_id='".$_POST["userid"]."'";

								                     
                     $res=mysqli_query($conn,$upd);
                       if($res)
                       {
                      echo "<script>alert('Record Updated..');
                          window.location='summary.php';
                      </script>";
                       }
                       else
                       {
                         echo "<script>alert('Something was wrong')</script>";
                       }
     
}


?>
<div class="col-sm-6">
                <div class="box-shadow-full">
                  <div class="card shadow-sm border-0">
                      <div class="card-header bg-primary text-white">
                          <h4 class="mb-0">Career Objective</h4>
                      </div>
                        <div class="card-body">

                            <form method="post">

                                <input type="hidden" name="userid" value="<?php echo $id; ?>">

                                <div class="mb-3">
                                    <label class="form-label fw-bold">
                                        Choose  Sample Career Objective
                                    </label>

                                    <select class="form-select mb-3" onchange="setObjective(this.value)">
                                        <option value="">Select Career Objective</option>
                                        <option value="1">Fresher</option>
                                        <option value="2">Web Developer</option>
                                        <option value="3">Software Engineer</option>
                                        <option value="4">Government Job Aspirant</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">
                                        Career Objective
                                    </label>

                                    <textarea
                                        class="form-control"
                                         id="objective"
                                         name="objective"
                                         rows="6"
                                          ><?php echo isset($data['career_objective']) ? $data['career_objective'] : ''; ?></textarea>
                                </div>

                                <div class="text-end">

                                    <?php if($isEdit2){ ?>

                                        <button type="submit"
                                                name="up_objective"
                                                class="btn btn-warning px-4">
                                            Update Career Objective
                                        </button>

                                    <?php } else { ?>

                                        <button type="submit"
                                                name="add_objective"
                                                class="btn btn-primary px-4">
                                            Save Career Objective
                                        </button>

                                    <?php } ?>

                                </div>

                            </form>

                        </div>   <!-- card body -->          

                  </div><!--card shadow-sm border-0 -->

                </div> <!-- box-shadow-full-->
              </div><!-- col-sm-6 -->
<script>
             function setObjective(val)
{
    let text = "";

    if(val=="1")
    {
        text = "To secure a challenging position in a reputable organization where I can learn new skills, expand my knowledge, and contribute to the success of the organization.";
    }
    else if(val=="2")
    {
        text = "To obtain a Web Developer position where I can utilize my knowledge of PHP, MySQL, HTML, CSS, JavaScript, and Bootstrap to build efficient and user-friendly web applications.";
    }
    else if(val=="3")
    {
        text = "To work as a Software Engineer in a growth-oriented organization where I can apply my technical skills, solve real-world problems, and continuously enhance my professional abilities.";
    }
    else if(val=="4")
    {
        text = "To serve the nation through a responsible government position where I can utilize my knowledge, dedication, and leadership skills for public welfare and development.";
    }
   nicEditors.findEditor('objective').setContent(text);
    // document.getElementById("objective").value = text;
}
</script>