<?php
session_start();

if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]!=true)
{
    header("location: login.php");
    exit;

} 
require_once "config.php";
  
$mail=$_SESSION['email'];
$id=$_SESSION["id"];
$username=$_SESSION["username"];

//    include 'header_single.php';


                        $sel="select * from users join per_info on users.user_id=per_info.user_id where users.name='$username' and users.email='$mail'";
            $res=mysqli_query($conn,$sel);
            $row=mysqli_fetch_array($res);
 ?>
<body>
<br>
                  <div class="submenu">
                  	<a><button  class="button button-a" onClick="PrintDiv();"><i class="fa fa-print"></i> Print</button></a>
				<div class="submenu-right">
                  <a href="home.php"><button  class="button button-a"><i class="fa fa-backward"></i> Back</button></a></div>
                  </div>
<div id="print" class="page">
        <link rel="stylesheet" type="text/css" href="assets/css/resume2.css">
        <link href="assets/css/style.css"  media='screen,print' rel="stylesheet">
        <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<div class="resume-main">
    <div class="left-box">
        <br><br>
        <div class="profile">
            <img src="image/users/<?php if(!isset($row['image']) && empty($row['image']))
              { echo "user.jpg"; } echo $row['image'] ?>">
        </div>
        <div class="content-box">
        <h2>Profile Info</h2>
        <hr class="hr1">
        <?php
                                    $qur=mysqli_query($conn,"SELECT * FROM summary where user_id=$id");
                                    if(mysqli_num_rows($qur) == 0){
         ?>
        <p class="p1">  
        Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
         <?php } else {
		      while($show=mysqli_fetch_array($qur,MYSQLI_ASSOC))
			  {
		   ?>
           <p class="p1">
           <?php echo $show["summary"]; ?>
           </p>
          <?php } }?>
        <h3>Contact info</h3>
        <hr class="hr1">
        <p class="p1">
        <i class="fa fa-phone">&nbsp;<?php if(!isset($row['mono']) && empty($row['mono'])){echo "9999999999";} echo $row["mono"]; ?> </i></p>
        <p class="p1">
        <i class="fa fa-envelope"> <?php if(!isset($row['email']) && empty($row['email'])){echo "adi@example.com";} echo $row["email"]; ?></i><br></p>
        <p class="p1">
        <i class="fa fa-home"><?php if(!isset($row['address']) && empty($row['address'])){echo "Station Road Surat";} echo $row["address"]; ?></i><br></p>
         
        <h3>Language:</h3>
        <hr class="hr1">
        <?php
                $qur=mysqli_query($conn,"SELECT * FROM languages where user_id=$id"); 
                if(mysqli_num_rows($qur)== 0 )
               {
               ?>
               <p class="p2">English</p>
                <div id="progress"></div>
                <p class="p2">Gujrati</p>
                <div id="progress1"></div>
               <?php } else {
               while($qow=mysqli_fetch_array($qur,MYSQLI_ASSOC))
               {
         ?>
        <p class="p2"><?php echo $qow['lname'] ?></p>
        <div id="progress" style='height:8px;width:<?php echo $qow['rate']; ?>%'></div>
      <?php } }?>
        <!--<p class="p2">Hindi</p>
        <div id="progress1"></div> -->

        <br><br>
        <h2>My Skills</h2>
        <hr class="hr1">
        <br>
        <?php 
            $id=$_SESSION['id'];
             $sel1="SELECT * FROM skills WHERE user_id=$id" ;
           $qur=mysqli_query($conn,$sel1);
           if(mysqli_num_rows($qur) == 0){
            ?>
            <div class="col-div-6"><p class="p2">HTML</p></div>
              <div class="col-div-6">
            <?php            
                $row1['rate']="3";   
                for($i=1;$i<=5;$i++) {
                  $selected = 'circle1'; 
                  if(!empty($row1['rate']) && $i<=$row1['rate']) {
              $selected = 'circle';
              }
             ?>
            <i class="fa fa-circle <?php echo $selected;?>"></i>
        <?php } ?>
        </div>
        <div class="clearfix"></div>
           <?php } else {
           while($row1=mysqli_fetch_array($qur,MYSQLI_ASSOC))
           {
        ?>
        <div class="col-div-6"><p class="p2"><?php echo $row1['skill'] ?></p></div>
        <div class="col-div-6">
            <?php               
                for($i=1;$i<=5;$i++) {
                  $selected = 'circle1'; 
                  if(!empty($row1['rate']) && $i<=$row1['rate']) {
              $selected = 'circle';
              }
             ?>
            <i class="fa fa-circle <?php echo $selected;?>"></i>
        <?php } ?>
        </div>
        <div class="clearfix"></div>
    <?php } } ?>
         <div class="clearfix"></div>
            <br>
            <h2>Interests</h2>
            <hr class="hr1">
            <br>
            <div class="col-div-3 col3">

                <span class="inp"><?php if(!isset($row['hobbies']) && empty($row['hobbies'])){echo "Drive";} echo $row['hobbies'] ?></span>
            </div>
            <!-- <div class="col-div-3 col3">

                <span class="inp">Drive</span>
            </div> -->
           <!-- <div class="col-div-3 col3">

                <span class="inp">Sports</span>
            </div>
            <div class="col-div-3 col3">

                <span class="inp">Sports</span>
            </div> -->
        </div>
    </div>

    <div class="right-box">
        <h1>
            <?php if(!isset($row['lname']) && empty($row['lname']))
              { echo "Aditya"; } echo $row['lname'] ?><br>
            <span><?php if(!isset($row['fname']) && empty($row['fname']))
              { echo "Rathod"; } echo $row['fname'] ?></span>
        </h1>
        <p class="p3"><?php if(!isset($row['profession']) && empty($row['profession'])){echo "Developer";} echo $row['profession'] ?></p>

        <br>    
        <h2 class="heading">Work Experience</h2>
        <hr class="hr2">
           <?php 
      
      $qur=mysqli_query($conn,"SELECT * FROM exe_info where user_id=$id");
      if(mysqli_num_rows($qur)== 0)
      {
      ?>
        <br>
        <div class="col-div-4">
            <p class="p5">Dec 2020- Jun 2022</p>
            <span class="span1">TATA</span>
        </div>
        <div class="col-div-8">
            <p class="p5">Senior Developer</p>
            <span class="span1">Implement code based on project specifications.
Create new tables within MySQL.
Test and document code.
Provide feedback to the development group to improve Agile Project management methods.</span>
        </div>
        <div class="clearfix"></div>
      <?php } else {
          while($qow=mysqli_fetch_array($qur,MYSQLI_ASSOC))
        {
      ?>
        <br>
        <div class="col-div-4">
            <p class="p5"><?php echo $qow['jdate']."-".$qow['edate'] ?></p>
            <span class="span1"><?php echo $qow['company_name'] ?></span>
        </div>
        <div class="col-div-8">
            <p class="p5"><?php echo $qow['position']; ?></p>
            <span class="span1"><?php echo $qow['work']; ?></span>
        </div>
        <div class="clearfix"></div>
       <?php }} ?>

        <div class="clearfix"></div>

        <br>    
        <h2 class="heading">My Education</h2>
        <hr class="hr2">
        <?php 
      $qu=mysqli_query($conn,"SELECT * FROM edu_info where user_id=$id"); 
      if(mysqli_num_rows($qu)== 0)
      {
     ?>
             <br>
        <div class="col-div-4">
            <p class="p5">2015-2018</p>
            <span class="span1">London Business School</span>
        </div>
        <div class="col-div-8">
            <p class="p5">Master Degree</p>
      </div>
        <div class="clearfix"></div>
        <div class="col-div-4">
            <p class="p5">2010-2013</p>
            <span class="span1">School of Coding</span>
        </div>
        <div class="col-div-8">
            <p class="p5">Bachelor Degree</p>
      </div>
        <div class="clearfix"></div>
       <?php } else {
          while($qo=mysqli_fetch_array($qu,MYSQLI_ASSOC))
        {
      ?>
        <br>
        <div class="col-div-4">
            <p class="p5"><?php echo $qo['passyear']; ?></p>
            <span class="span1"><?php echo $qo['board']; ?></span>
        </div>
        <div class="col-div-8">
            <p class="p5"><?php echo $qo['qualification'] ?></p>
            <span class="span1"><?php echo $qo['per']; ?>&nbsp;<?php echo $qo['rtype']; ?></span>
        </div>
        <div class="clearfix"></div>
    <?php } }?>

<div class="clearfix"></div>

        <br>    
        <h2 class="heading">Additional Certificate</h2>
        <hr class="hr2">
        <?php 
            $cqu=mysqli_query($conn,"SELECT * FROM add_cer where user_id=$id"); 
            if(mysqli_num_rows($cqu)== 0)
           {
         ?>
         <br>
        <div class="col-div-4">
            <p class="p5">2020</p>
            <span class="span1">Organization</span>
        </div>
        <div class="col-div-8">
            <p class="p5">W3Schools.com</p>
            <span class="span1">Web Development! All I need to know in one place</span>
        </div>
        <div class="clearfix"></div>
      <?php } else {
          while($cer=mysqli_fetch_array($cqu,MYSQLI_ASSOC))
        {
       ?>
        <br>
        <div class="col-div-4">
            <p class="p5"><?php echo $cer['cname'] ?></p>
            <span class="span1"></span>
        </div>
        <div class="col-div-8">
            <p class="p5"></p>
            <span class="span1"><?php echo $cer['cdetails']; ?></span>
        </div>
        <div class="clearfix"></div>
    <?php } } ?>
       
    </div>

    <div class="clearfix"></div>

</div>

</div> <!--print -->
<!-- <button class="btn btn-success"  onClick="PrintDiv();"><i class="fa fa-print"></i> Print</button> -->

</body>
          <script type="text/javascript">     
          function PrintDiv() {    
           var divToPrint = document.getElementById('print');
           var popupWin = window.open('', '_blank');
           popupWin.document.open();
           popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
                }
     </script>
</html>