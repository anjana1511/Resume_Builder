<?php
require_once "config.php";
session_start();

if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]!=true)
{
    header("location: login.php");
    exit;
}  


// else
// {
//     echo "bye";
// }

if(isset($_POST["addcer"]))
{
	$insertdata="insert into add_cer(user_id,cname,cdetails) values('".$_POST["userid"]."','".$_POST["cname"]."','".$_POST["cdetails"]."')";
	$re=mysqli_query($conn,$insertdata);
	if($re)
	{
		echo "<script>alert('Record Added')</script>";
        //header("Refresh:0");
		header("location: Education.php");
	}
}



if(isset($_GET["edtcer"]))
{
$cid=$_GET['edtcer'];
if (isset($_POST["upcer"]))
{
		$updatedata="UPDATE add_cer SET cname='".$_POST["cname"]."',cdetails='".$_POST["cdetails"]."' WHERE user_id='".$_POST["userid"]."' and id='".$cid."'";
	$re=mysqli_query($conn,$updatedata);
	if($re)
	{
		echo "<script>alert('Record Updated')</script>";
        //header("Refresh:0");
		header("location: Education.php");
	}
}
}

if(isset($_POST["submit"]))
{
    
    $insert="insert into edu_info(user_id,qualification,board,per,passyear,rtype)
               values('".$_POST["userid"]."','".$_POST["qualification"]."','".$_POST["board"]."','".$_POST["per"]."'
                       ,'".$_POST["passyear"]."','".$_POST["rtype"]."')";
                     
                       $res=mysqli_query($conn,$insert);
                       if($res)
                       {
                         echo "<script>alert('Record Added')</script>";
                        // header("Refresh:0");
						header("location: Education.php");

                       }
                       else
                       {
                         echo "<script>alert('Something was wrong')</script>";
                       }
                     

}


if(isset($_GET["edt"]))
{
$edit_id=$_GET['edt'];

if(isset($_POST["update"]))
{

    $upd="UPDATE edu_info SET qualification='".$_POST["qualification"]."',board='".$_POST["board"]."',per='".$_POST["per"]."',
                                   passyear='".$_POST["passyear"]."',rtype='".$_POST["rtype"]."' WHERE user_id='".$_POST["userid"]."' and id='".$edit_id."'";

								                     
                     $res=mysqli_query($conn,$upd);
                       if($res)
                       {
                         echo "<script>alert('Record Added')</script>";
                         						header("location: Education.php");
                       }
                       else
                       {
                         echo "<script>alert('Something was wrong')</script>";
                       }
     
}
}

  if(isset($_REQUEST['del']))
  {
      $id=$_REQUEST['del'];

      $delete="delete from edu_info where user_id='".$_SESSION['id']."' and id=$id";
      $res2=mysqli_query($conn,$delete);
      //header("location:addcity.php");
	  if($res2)
       {
            echo "<script>alert('Record deleted....'); location.replace('Education.php');</script>";
			
       }
       else
       {
           echo "<script>alert('Try Again....');location.replace('Education.php');</script>";
       }
  }

    if(isset($_REQUEST['delcer']))
  {
      $cid=$_REQUEST['delcer'];

      $delete="delete from add_cer where user_id='".$_SESSION['id']."' and id=$cid";
      $res2=mysqli_query($conn,$delete);
      //header("location:addcity.php");
	  if($res2)
       {
            echo "<script>alert('Record deleted....'); location.replace('Education.php');</script>";
			
       }
       else
       {
           echo "<script>alert('Try Again....');location.replace('Education.php');</script>";
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
                <div class="col-md-6">
                  <div class="row">
				     <div class="col-sm-12 col-md-12">
					   <div class="title-box-2">
                      <h2 align="center">
						Education Details
					<hr class="blueline" />
                      </h1>
                    </div>

					 <div class="about-info">
										  
					   <?php
				   if(isset($_GET['edt']))
                      {
                       $edit_id=$_GET['edt'];
					   $id=$_SESSION["id"];
					   $sel="SELECT * FROM `edu_info` WHERE user_id=$id and id=$edit_id";
					   $show=mysqli_query($conn,$sel);
					   $dis=mysqli_fetch_array($show);
					  	?>

           
            <form method="post" name="update">
			       <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="inputqualification">Qualification</label>
					</div>
					<div class="col-sm-6">
                        <label for="inputboard">Board & University</label>
					</div>
					</div>
					<div class="form-group row">
					<div class="col-sm-6">
					    <input type="hidden" class="form-control" id="userid" name="userid" value="<?php echo $id; ?>">
                        <input type="text" class="form-control" id="qualification" name="qualification" placeholder="Qualification" value="<?php echo $dis["qualification"] ?>" required>
                    </div>

                    <div class="col-sm-6">					
                        <input type="text" class="form-control" id="board" name="board" placeholder="Board/University" value="<?php echo $dis["board"] ?>" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="inputpassyear">Passing Year</label>
					</div>
						<div class="col-sm-6">
                        <label for="inputPer">Percentage/CGPA</label>
					</div>					
					</div>
					<div class="form-group row">
                    
                    <div class="col-sm-6">					
                        <input type="text" class="form-control" id="passyear" name="passyear" placeholder="Passing Year" value="<?php echo $dis["passyear"] ?>" required>
                    </div>
					<div class="col-sm-3">					
                        <input type="text" class="form-control" id="per" name="per" placeholder="Percentage/CGPA" value="<?php echo $dis["per"] ?>" required>
					</div>
					<div class="col-sm-3">	
						<input type="text" class="form-control" id="rtype" name="rtype" placeholder="Result Type" value="<?php echo $dis["rtype"] ?>" required>
                    </div>
                </div>
                <br><br>
                <input class="btn btn-primary px-4 float-right" type="submit" value="submit" id="update" name="update" onclick="fun_eduinfo();">
            </form>
			
			
			
<?php

}
else
{
?>
            <form method="post" name="create">
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="inputqualification">Qualification</label>
					</div>
					<div class="col-sm-6">
                        <label for="inputboard">Board & University</label>
					</div>
					</div>
					<div class="form-group row">
					<div class="col-sm-6">
					    <input type="hidden" class="form-control" id="userid" name="userid" value="<?php echo $id; ?>">
                        <input type="text" class="form-control" id="qualification" name="qualification" placeholder="Qualification" required>
                    </div>

                    <div class="col-sm-6">					
                        <input type="text" class="form-control" id="board" name="board" placeholder="Board/University" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="inputpassyear">Passing Year</label>
					</div>
						<div class="col-sm-6">
                        <label for="inputPer">Percentage/CGPA</label>
					</div>					
					</div>
					<div class="form-group row">
                    
                    <div class="col-sm-6">					
                        <input type="text" class="form-control" id="passyear" name="passyear" placeholder="Passing Year" required>
                    </div>
					<div class="col-sm-3">					
                        <input type="text" class="form-control" id="per" name="per" placeholder="Percentage/CGPA" required>
					</div>
					<div class="col-sm-3">	
						<input type="text" class="form-control" id="rtype" name="rtype" placeholder="Result Type" required>
                    </div>
                </div>
                <br><br>
                <input class="btn btn-primary px-4 float-right" type="submit" value="submit" id="submit" name="submit">
            </form>
<?php } ?>

</div>
				</div>	
			  </div>	
			</div>		
			
		<!--------- Additional Certificate -->
			
			<div class="col-md-6">
                  <div class="row">
				     <div class="col-sm-12 col-md-12">
					   <div class="title-box-2">
                      <h2 align="center">
						Additional Certificate
					<hr class="blueline" /></h2>
                    </div>
					<div class="about-info">
										   <?php
				     if(isset($_GET['edtcer']))
                      {
                       $cid=$_GET['edtcer'];
					   $id=$_SESSION["id"];
					   $sel="SELECT * FROM `add_cer` WHERE user_id=$id and id=$cid";
					   $show=mysqli_query($conn,$sel);
					   $di=mysqli_fetch_array($show);
					   				

						?>
				<form method="post" name="cerup">	
					<div class="form-group row">
                    <div class="col-sm-12">
                        <label for="inputqualification">Course Name</label>
					</div>
					</div>
					<div class="form-group row">
					<div class="col-sm-12">
					    <input type="hidden" class="form-control" id="userid" name="userid" value="<?php echo $id; ?>">
                        <input type="text" class="form-control" id="cname" name="cname" placeholder="Course Name" value="<?php echo $di["cname"] ?>" required>
                    </div>
					</div>
					<div class="form-group row">
                    <div class="col-sm-12">
                        <label for="inputboard">Details</label>
					</div>
					</div>
					<div class="form-group row">
                    <div class="col-sm-12">					
                        <textarea class="form-control" id="cdetails" name="cdetails" placeholder="Course Details"><?php echo $di["cdetails"] ?></textarea>
                    </div>
					</div>
					<br>
					<input class="btn btn-primary px-4 float-right" type="submit" value="Update" id="upcer" name="upcer">
				</form>
							<?php }
                             else{							
							?>
				<form method="post" name="ceradd">			
					<div class="form-group row">
                    <div class="col-sm-12">
                        <label for="inputqualification">Course Name</label>
					</div>
					</div>
					<div class="form-group row">
					<div class="col-sm-12">
					    <input type="hidden" class="form-control" id="userid" name="userid" value="<?php echo $id; ?>">
                        <input type="text" class="form-control" id="cname" name="cname" placeholder="Course Name" required>
                    </div>
					</div>
					<div class="form-group row">
                    <div class="col-sm-12">
                        <label for="inputboard">Details</label>
					</div>
					</div>
					<div class="form-group row">
                    <div class="col-sm-12">					
                        <textarea class="form-control" id="cdetails" name="cdetails" placeholder="Course Details"></textarea>
                    </div>
                </div>
				<br>
                <input class="btn btn-primary px-4 float-right" type="submit" value="submit" id="addcer" name="addcer">
							 <?php } ?>
			</form>	
				
				
					</div>
				</div>
            </div>				
		<!-------------Try End -->	
         </div>
        
         <div class="col-md-6">
                  <div class="row">
				     <div class="col-sm-12 col-md-12">
					   <div class="title-box-2">
                      <h2 align="center">
						<!--<button id="showData">Show User Data</button> -->
					<hr class="blueline" /></h2>
                    </div>  
					<div class="about-info">
						<div id="table-container">
							
				     		<div style="overflow-x:auto;">
							    <table class="table record-table">
							    	<th>Degree</th>
							    	<th>University</th>
							    	<th>Pass Year</th>
							    	<th>Result Type</th>
							    	<th colspan="2">Action</th>
				    				<?php

									   $id=$_SESSION["id"];
									   $sel="SELECT * FROM `edu_info` WHERE user_id=$id";
									   $show=mysqli_query($conn,$sel);
				    					while($dis=mysqli_fetch_array($show)){
				    						?>
							        <tr>
							         <td><?php echo $dis['qualification']; ?> </td>
							            <td><?php echo $dis['board']; ?></td>
							            <td><?php echo $dis['passyear']; ?></td>
							            <td><?php echo $dis['rtype']; ?></td>
				                        <td><a href="Education.php?edt=<?php echo $dis['id']; ?>"><img src="assets/img/edit.png" height="30px" width="30px"></a></td>
				                        <td><a href="Education.php?del=<?php echo $dis['id']; ?>"><img src="assets/img/delete.png" height="30px" width="30px"></a></td>
							            </tr>
				    				<?php	}  ?>
							   </table>
               				</div>
						</div>
					</div>
				</div>
            </div>				
         </div>


                  <div class="col-md-6">
                  <div class="row">
				     <div class="col-sm-12 col-md-12">
					   <div class="title-box-2">
                      <h2 align="center">
						
					<hr class="blueline" /></h2>
                    </div>
					<div class="about-info">
						<div id="table-container">
							
				     		<div style="overflow-x:auto;">
							    <table class="table record-table">
							    	<th>Course Name</th>
							    	<th>Details</th>
							    	<th colspan="2">Action</th>
				    				<?php

									   $id=$_SESSION["id"];
									   $sel="SELECT * FROM `add_cer` WHERE user_id=$id";
									   $show=mysqli_query($conn,$sel);
				    					while($dis=mysqli_fetch_array($show)){
				    						?>
							        <tr>
							         <td><?php echo $dis['cname']; ?> </td>
							            <td><?php echo $dis['cdetails']; ?></td>
				                        <td><a href="Education.php?edtcer=<?php echo $dis['id']; ?>"><img src="assets/img/edit.png" height="30px" width="30px"></a></td>
				                        <td><a href="Education.php?delcer=<?php echo $dis['id']; ?>"><img src="assets/img/delete.png" height="30px" width="30px"></a></td>
							            </tr>
				    				<?php	}  ?>
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
		 