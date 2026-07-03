<?php
require_once ("../config/config.php");
session_start();

if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]!=true)
{
    header("location: login.php");
    exit;
}  
$id = $_SESSION['id'];

$check = mysqli_query(
    $conn,
    "SELECT * FROM summary WHERE user_id='$id' LIMIT 1"
);

if(mysqli_num_rows($check) > 0)
{
    $data = mysqli_fetch_assoc($check);
     if(!empty(trim($data['summary'])))
        {
                  $isEdit = true;
        }
        else
         {
            $isEdit= false;
         }   
}
else
{
    $isEdit = false;
}
if(isset($_POST["submit"]))
{

    $data = mysqli_fetch_assoc($check);
    
     if(empty(trim($data['summary'])))
        {
                   $insert="insert into summary(user_id,summary)
                   values('".$_POST["userid"]."','".$_POST["summary"]."')";            
                   $res=mysqli_query($conn,$insert);
                   

        }   
        else 
            {
                $update="UPDATE summary set summary='".$_POST["summary"]."' WHERE user_id='".$_POST["userid"]."' ";
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

if(isset($_POST["update"]))
{

    $upd="UPDATE summary SET summary='".$_POST["summary"]."' WHERE user_id='".$_POST["userid"]."'";

								                     
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
<?php 
include ROOT_PATH."includes/header.php";
?>
<section id="about" class="about-mf sect-pt4 route">
      <div class="container">
          <div class="row">
            <?php include ROOT_PATH."Resume/career_objective.php"; ?>
              <div class="col-sm-6">
                <div class="box-shadow-full">
                  <div class="card shadow-sm border-0">
                      <div class="card-header bg-primary text-white">
                          <h4 class="mb-0">Professional Summary</h4>
                      </div>
                        <div class="card-body">

                            <form method="post">

                                <input type="hidden" name="userid" value="<?php echo $id; ?>">

                                <div class="mb-3">
                                    <label class="form-label fw-bold">
                                        Choose Sample Summary
                                    </label>

                                    <select class="form-select" onchange="setSummary(this.value)">
                                        <option value="">Select Summary</option>
                                        <option value="1">Fresher</option>
                                        <option value="2">Web Developer</option>
                                        <option value="3">Software Engineer</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">
                                        Professional Summary
                                    </label>

                                    <textarea
                                        class="form-control"
                                        id="summary"
                                        name="summary"
                                        rows="8"
                                        ><?php echo isset($data['summary']) ? $data['summary'] : ''; ?></textarea>
                                </div>

                                <div class="text-end">

                                    <?php if($isEdit){ ?>

                                        <button type="submit"
                                                name="update"
                                                class="btn btn-warning px-4">
                                            Update Summary
                                        </button>

                                    <?php } else { ?>

                                        <button type="submit"
                                                name="submit"
                                                class="btn btn-primary px-4">
                                            Save Summary
                                        </button>

                                    <?php } ?>

                                </div>

                            </form>

                        </div>   <!-- card body -->          

                  </div><!--card shadow-sm border-0 -->

                </div> <!-- box-shadow-full-->
              </div><!-- col-sm-6 -->
          </div><!-- row -->
       </div><!-- about-mf sect-pt4 route -->
</section>           


  <?php
include ROOT_PATH."includes/footer.php";
 ?>  
		 <script>
function setSummary(val)
{
    let text = "";

    if(val=="1")
    {
        text = "Motivated and detail-oriented Computer Science student with knowledge of PHP, MySQL, HTML, CSS, and JavaScript. Passionate about web development and eager to contribute technical skills while gaining practical industry experience.";
    }
    else if(val=="2")
    {
        text = "Creative and dedicated Web Developer with experience in building responsive and user-friendly websites using PHP, MySQL, Bootstrap, and JavaScript. Strong problem-solving abilities with a focus on delivering high-quality solutions.";
    }
    else if(val=="3")
    {
        text = "Results-driven Software Engineer with strong programming and database management skills. Experienced in developing scalable web applications and committed to continuous learning and innovation.";
    }

    nicEditors.findEditor('summary').setContent(text);
}


</script>