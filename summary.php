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




if(isset($_POST["submit"]))
{
    
    $insert="insert into summary(user_id,summary)
               values('".$_POST["userid"]."','".$_POST["summary"]."')";
                     
                       $res=mysqli_query($conn,$insert);
                       if($res)
                       {
                         echo "<script>alert('Record Added')</script>";
                        // header("Refresh:0");
						header("location: summary.php");

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

    $upd="UPDATE summary SET summary='".$_POST["summary"]."' WHERE user_id='".$_POST["userid"]."' and id='".$edit_id."'";

								                     
                     $res=mysqli_query($conn,$upd);
                       if($res)
                       {
                         echo "<script>alert('Record Added')</script>";
                         						header("location: summary.php");
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

      $delete="delete from summary where user_id='".$_SESSION['id']."' and id=$id";
      $res2=mysqli_query($conn,$delete);
      //header("location:addcity.php");
	  if($res2)
       {
            echo "<script>alert('Record deleted....'); location.replace('summary.php');</script>";
			
       }
       else
       {
           echo "<script>alert('Try Again....');location.replace('summary.php');</script>";
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
			           Professional Summary
					<hr class="blueline" />
                      </h1>
                    </div>

					 <div class="about-info">
										  
					   <?php
				   if(isset($_GET['edt']))
                      {
                       $edit_id=$_GET['edt'];
					   $id=$_SESSION["id"];
					   $sel="SELECT * FROM `summary` WHERE user_id=$id and id=$edit_id";
					   $show=mysqli_query($conn,$sel);
					   $dis=mysqli_fetch_array($show);
					  	?>

           
            <form method="post" name="update">
            <div class="form-group row">
            <div class="col-sm-6">
            <label for="inputboard">Summary*</label></div>
                    <div class="col-sm-12">
                    <input type="hidden" class="form-control" id="userid" name="userid" value="<?php echo $id; ?>">
                    <textarea class="form-control" id="summary" name="summary" required></textarea>
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
                <label for="inputboard">Summary*</label></div>
                    <div class="col-sm-12">
                    <input type="hidden" class="form-control" id="userid" name="userid" value="<?php echo $id; ?>">
                    <textarea class="form-control" id="summary" name="summary" required></textarea>
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
							    	<th>Summary</th>
							    	<th colspan="2">Action</th>
				    				<?php

									   $id=$_SESSION["id"];
									   $sel="SELECT * FROM `summary` WHERE user_id=$id";
									   $show=mysqli_query($conn,$sel);
				    					while($dis=mysqli_fetch_array($show)){
				    						?>
							        <tr>
							         <td><?php echo $dis['summary']; ?> </td>
				                        <td><a href="summary.php?edt=<?php echo $dis['id']; ?>"><img src="assets/img/edit.png" height="30px" width="30px"></a></td>
				                        <td><a href="summary.php?del=<?php echo $dis['id']; ?>"><img src="assets/img/delete.png" height="30px" width="30px"></a></td>
							            </tr>
				    				<?php	}  ?>
							   </table>
               				</div>
						</div>
					</div>
				</div>
            </div>				
         </div>

<!-- 
                  <div class="col-md-6">
                  <div class="row">
				     <div class="col-sm-12 col-md-12">
					   <div class="title-box-2">
                      <h2 align="center">
						
					<hr class="blueline" /></h2>
                    </div>
					<div class="about-info">
						
					</div>
				</div>
            </div>				
         </div> -->

		 		
		</div>
	</div>
  </div>
</div>
</div>
</section>
  <?php
include "footer.php";
 ?>  
		 