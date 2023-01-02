<?php
require_once "config.php";

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

//Add expirence
if(isset($_POST["submit"]))
{
   // print_r($_POST);exit;
   if(!isset($_POST["current"]))
   {
    $_POST["current"]='0';
   }
    $insert="insert into exe_info(user_id,company_name,position,state,city,jdate,edate,work,current)
               values('".$_POST["userid"]."','".$_POST["company_name"]."','".$_POST["position"]."','".$_POST["state"]."','".$_POST["city"]."','".$_POST["jdate"]."','".$_POST["edate"]."','".$_POST["work"]."','".$_POST["current"]."')";
                      
                  //    echo $insert;exit;
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

if(isset($_GET["edt"]))
{
   $edt=$_GET["edt"];
if(isset($_POST["update"]))
{

    $upd="UPDATE exe_info SET company_name='".$_POST["company_name"]."',position='".$_POST["position"]."',city='".$_POST["city"]."',state='".$_POST["state"]."',work='".$_POST["work"]."',
                                   jdate='".$_POST["jadate"]."',edate='".$_POST["edate"]."',current='".$_POST["current"]."' WHERE user_id='".$_POST["userid"]."' and id='".$edt."'";
								                     
                     $res=mysqli_query($conn,$upd);
                       if($res)
                       {
                         echo "<script>alert('Record Added')</script>";
                         						header("location: expirence.php");
                       }
                       else
                       {
                         echo "<script>alert('Something was wrong')</script>";
                       }
     
}
}
if(isset($_GET["del"]))
{

   $delete=mysqli_query($conn,"DELETE FROM exe_info WHERE user_id='".$_SESSION["id"]."' AND id='".$_GET["del"]."'");
   if($delete)
   {
                         echo "<script>alert('Record Deleted')</script>";
                                    header("location: expirence.php");
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
			
			
	<!--   Experience Section Start -->	 
		 <div class="col-md-12">
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
                           if(isset($_GET["edt"]))
                           {
                            $edt=$_GET["edt"];
              					   $id=$_SESSION["id"];
              					   $sel="SELECT * FROM `exe_info` WHERE user_id=$id and id=$edt";
              					   $show=mysqli_query($conn,$sel);
              					   $dis=mysqli_fetch_array($show);
              					   
              						?>

                         
                          <form method="post" name="update">
              			       <div class="form-group row">
                             <div class="col-sm-4">
                                      <label for="inputcompany_name">Company name</label>
              					          </div>
              					     <div class="col-sm-4">
                                      <label for="inputposition">Position</label>
              					     </div>
                              <div class="col-sm-4">
                                      <label for="inputjdate">Start date</label>
                              </div>
              				    	</div>
              					   <div class="form-group row">
              					       <div class="col-sm-4">
              					           <input type="hidden" class="form-control" id="userid" name="userid" value="<?php echo $id; ?>">
                                       <input type="text" class="form-control" id="company_name" name="company_name" placeholder="company name" value="<?php echo $dis["company_name"] ?>" required>
                               </div>

                                <div class="col-sm-4">					
                                      <input type="text" class="form-control" id="position" name="position" placeholder="Position" value="<?php echo $dis["position"] ?>" required>
                                </div>
                                 <div class="col-sm-4">
                                      <input type="text" class="form-control" id="jdate" name="jadate" placeholder="Duration" value="<?php echo $dis["jdate"] ?>" required>
                                 </div>
                            </div>
                          <div class="form-group row">
                              <div class="col-sm-4">
                                          <label for="inputecity">City</label>
                              </div>      
                               <div class="col-sm-4">
                                          <label for="inputstate">State</label>
                              </div>      
                               <div class="col-sm-4">
                                          <label for="inputedate">End Date</label>
                               </div>                  
                          </div> 
                          <div class="form-group row">         
                  					 <div class="col-sm-4">					
                                    <input type="text" class="form-control" id="city" name="city" placeholder="City" value="<?php echo $dis["city"]; ?>" required>
                  					 </div>
                              <div class="col-sm-4">
                                    <input type="text" class="form-control" id="state" name="state" placeholder="State" value="<?php echo $dis["state"]; ?>" required>
                              </div>
                                <div class="col-sm-4">
                                            <input type="text" class="form-control" id="edate" name="edate" placeholder="End date" value="<?php echo $dis["edate"] ?>" required>
                                </div>
                          </div>
                         <div class="form-group row">
                            <div class="col-sm-8">
                                                    <label for="inputwork">Work</label>
                            </div>
                            <div class="col-sm-4">
                              <?php if($dis["current"] == 1 ){ ?>
                                     <input type="checkbox" name="current" value="1" checked>
                              <?php }else { ?>
                                      <input type="checkbox" name="current" value="0">
                                      <?php } ?>
                                     &nbsp;current  

                            </div>
                         </div>
                          <div class="form-group row">
                              <div class="col-sm-12">
                                        <textarea class="form-control" id="work" name="work" placeholder="Work"><?php echo $dis["work"] ?></textarea>
                              </div>
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
                             <div class="col-sm-4">
                                      <label for="inputcompany_name">Company name</label>
                                  </div>
                             <div class="col-sm-4">
                                      <label for="inputposition">Position</label>
                             </div>
                              <div class="col-sm-4">
                                      <label for="inputjdate">Start date</label>
                              </div>
                            </div>
                           <div class="form-group row">
                               <div class="col-sm-4">
                                   <input type="hidden" class="form-control" id="userid" name="userid" value="<?php echo $id; ?>">
                                       <input type="text" class="form-control" id="company_name" name="company_name" placeholder="company name" required>
                               </div>

                                <div class="col-sm-4">          
                                      <input type="text" class="form-control" id="position" name="position" placeholder="Position" required>
                                </div>
                                 <div class="col-sm-4">
                                      <input type="text" class="form-control" id="jdate" name="jdate" placeholder="Joining Date" required>
                                 </div>
                            </div>
                          <div class="form-group row">
                              <div class="col-sm-4">
                                          <label for="inputecity">City</label>
                              </div>      
                               <div class="col-sm-4">
                                          <label for="inputstate">State</label>
                              </div>      
                               <div class="col-sm-4">
                                          <label for="inputedate">End Date</label>
                               </div>                  
                          </div> 
                          <div class="form-group row">         
                             <div class="col-sm-4">         
                                    <input type="text" class="form-control" id="city" name="city" placeholder="City" required>
                             </div>
                              <div class="col-sm-4">
                                    <input type="text" class="form-control" id="state" name="state" placeholder="State" required>
                              </div>
                                <div class="col-sm-4">
                                            <input type="text" class="form-control" id="edate" name="edate" placeholder="edate" required>
                                </div>
                          </div>
                         <div class="form-group row">
                            <div class="col-sm-8">
                                                    <label for="inputwork">Work</label>
                            </div>
                            <div class="col-sm-4">
                                     <input type="checkbox" name="current" value="0">&nbsp;current
                            </div>
                         </div>
                          <div class="form-group row">
                              <div class="col-sm-12">
                                        <textarea class="form-control" id="work" name="work" placeholder="Work"></textarea>
                              </div>
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

      <div class="col-md-12">
         <div class="row">
           <div class="col-sm-12 col-md-12">
              <div class="title-box-2">
                 <h2 align="center">
                    
                    <hr class="blueline" /></h2>
             </div>
            <div class="about-info">
                  <div id="table-container">
                  
                    <div style="overflow-x:auto;">
                      <table class="table record-table1">
                        <th>Company Name</th>
                        <th>Position</th>
                        <th>Duration</th>
                        <th>City</th>
                        <th>State</th>
                        <th colspan="2">Action</th>
                        <?php

                         $id=$_SESSION["id"];
                         $sel="SELECT * FROM `exe_info` WHERE user_id=$id";
                         $show=mysqli_query($conn,$sel);
                          while($dis=mysqli_fetch_array($show)){
                            ?>
                          <tr>
                           <td><?php echo $dis['company_name']; ?> </td>
                              <td><?php echo $dis['position']; ?></td>
                              <td><?php echo $dis['jdate']."-".$dis['edate']; ?></td>
                              <td><?php echo $dis['city']; ?></td>
                              <td><?php echo $dis['state']; ?></td>
                                    <td><a href="expirence.php?edt=<?php echo $dis['id']; ?>"><img src="assets/img/edit.png" height="30px" width="30px"></a></td>
                                    <td><a href="expirence.php?del=<?php echo $dis['id']; ?>"><img src="assets/img/delete.png" height="30px" width="30px"></a></td>
                              </tr>
                        <?php }  ?>
                     </table>
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
</div>
</section>
  <?php
include "footer.php";
 ?>  
		 