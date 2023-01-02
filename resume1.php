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
  //  include 'header.php';


                        $sel="select * from users join per_info on users.user_id=per_info.user_id where users.name='$username' and users.email='$mail'";
            $res=mysqli_query($conn,$sel);
            $row=mysqli_fetch_array($res);
           // include "menubar.php";
            ?>
			      <br>
                  <div class="submenu">
                  	<a><button  class="button button-a" onClick="PrintDiv();"><i class="fa fa-print"></i> Print</button></a>
				<div class="submenu-right">
                  <a href="home.php"><button  class="button button-a"><i class="fa fa-backward"></i> Back</button></a></div>
                  </div>
            
            <!-- <button class="btn btn-success"  onClick="PrintDiv();"><i class="fa fa-print"></i> Print</button> -->
            <div class="resume-main">
            <div id="print" class="page">

              <link href="assets/css/resume1.css"  media='screen,print' rel="stylesheet">
              <link href="assets/css/style.css"  media='screen,print' rel="stylesheet">
              <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
              
  <div class='w3-content w3-margin-top' style='max-width:1400px;'>

    <!-- The Grid -->
    <div class='w3-row-padding'>
    
      <!-- Left Column -->
      <div class='w3-third'>
      
        <div class='w3-white w3-text-grey w3-card-4'>
          <div class='w3-display-container'>
                             <!-- <img src='assets/img/myphoto.jpg' class='img-fluid rounded b-shadow-a' alt=''> -->
                   
            <img src='image/users/<?php if(!isset($row['image']) && empty($row['image']))
              { echo "user.jpg"; }  echo $row['image'] ?>' style='width:100%' alt='Avatar'>
            <div class='w3-display-bottomleft w3-container w3-text-black'>
              <h2><?php 
              if(!isset($row['name']) && empty($row['name']))
              {
                 echo "Username";
              }
              echo $row['name']; ?></h2>
            </div>
          </div>
          <div class='w3-container'>
            <p><i class='fa fa-briefcase fa-fw w3-margin-right w3-large w3-text-teal'></i><?php if(!isset($row['profession']) && empty($row['profession'])){echo "Developer";} echo $row['profession']; ?></p>
            <p><i class='fa fa-home fa-fw w3-margin-right w3-large w3-text-teal'></i><?php if(!isset($row['address']) && empty($row['address'])){echo "Station Road Surat";} echo $row['address']; ?></p>
            <p><i class='fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal'></i><?php if(!isset($row['email']) && empty($row['email'])){echo "adi@example.com";} echo $row['email']; ?></p>
            <p><i class='fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal'></i><?php if(!isset($row['mono']) && empty($row['mono'])){echo "9999999999";} echo $row['mono']; ?></p>
            <hr>

            <p class='w3-large'><b><i class='fa fa-asterisk fa-fw w3-margin-right w3-text-teal'></i>Skills</b></p>
              <table class='demo-table'>
             <tbody>
                  <?php 

                     $id=$_SESSION['id'];
             $sel1="SELECT * FROM skills WHERE user_id=$id" ;
           $qur=mysqli_query($conn,$sel1);
           if(mysqli_num_rows($qur) == 0){
              ?>
                          <tr>
          <td valign='top'>
        
            <p><?php echo "Skill1" ?></p>
              <ul>
              <?php
              $row1['rate']="4";
              for($i=1;$i<=5;$i++) {
              $selected = '';
              if(!empty($row1['rate']) && $i<=$row1['rate']) {
              $selected = 'selected';
              }
              ?>
              <li class="<?php echo $selected;?>" >&#9733;</li>  
              <?php 
              } //for  ?>
            <ul></td></tr>
            <tr>
          <td valign='top'>
        
            <p><?php echo "Skill2" ?></p>
              <ul>
              <?php
              $row1['rate']="3";
              for($i=1;$i<=5;$i++) {
              $selected = '';
              if(!empty($row1['rate']) && $i<=$row1['rate']) {
              $selected = 'selected';
              }
              ?>
              <li class="<?php echo $selected;?>" >&#9733;</li>  
              <?php 
              } //for  ?>
            <ul></td></tr>
              <?php
           }
           else
           {
           while($row1=mysqli_fetch_array($qur,MYSQLI_ASSOC))
           {
            // if(isset($row['row']) && !empty($row['profession']))
                 ?>

            <tr>
          <td valign='top'>
        
            <p><?php echo $row1['skill']; ?></p>
              <ul>
              <?php
              for($i=1;$i<=5;$i++) {
              $selected = '';
              if(!empty($row1['rate']) && $i<=$row1['rate']) {
              $selected = 'selected';
              }
              ?>
              <li class="<?php echo $selected;?>" >&#9733;</li>  
              <?php 
              } //for  ?>
            <ul></td></tr>
           
           <?php }
           }
           
           ?>  </table>
           
            <br>

            <p class='w3-large w3-text-theme'><b><i class='fa fa-globe fa-fw w3-margin-right w3-text-teal'></i>Languages</b></p>
            <?php
               
               $qur=mysqli_query($conn,"SELECT * FROM languages where user_id=$id"); 
               if(mysqli_num_rows($qur)== 0 )
               {
               ?>
              <p>English</p>
            <div class='w3-light-grey w3-round-xlarge'>
              <div class='w3-round-xlarge w3-teal' style='height:24px;width:50%'></div>
            </div>
            <p>Gujrati</p>
            <div class='w3-light-grey w3-round-xlarge'>
              <div class='w3-round-xlarge w3-teal' style='height:24px;width:99%'></div>
            </div>
               <?php
               }
               else
               {
               while($qow=mysqli_fetch_array($qur,MYSQLI_ASSOC))
               {
             ?>
            <p><?php echo $qow["lname"]; ?></p>
            <div class='w3-light-grey w3-round-xlarge'>
              <div class='w3-round-xlarge w3-teal' style='height:24px;width:<?php echo $qow['rate']; ?>%'></div>
            </div>
          <?php } 
               }
          ?>
            <br>
            <p class='w3-large'><b><i class='fa fa-asterisk fa-fw w3-margin-right w3-text-teal'></i>Interests</b></p>
            <p><?php if(!isset($row['hobbies']) && empty($row['hobbies'])){echo "Drive";} echo $row['hobbies'] ?></p>
          </div>
        </div><br>

      <!-- End Left Column -->
      </div>

      <!-- Right Column -->
      <div class='w3-twothird'>
      <!-- Start work experience -->
      
        <div class='w3-container w3-card w3-white w3-margin-bottom'>
          <h2 class='w3-text-grey w3-padding-16'><i class='fa fa-suitcase fa-fw w3-margin-right w3-xxlarge w3-text-teal'></i>Work Experience</h2>
          <?php 
      
      $qur=mysqli_query($conn,"SELECT * FROM exe_info where user_id=$id"); 
      if(mysqli_num_rows($qur)== 0)
      {
      ?>
      <div class='w3-container'>
       
      <h5 class='w3-opacity'><b>Senior Php Developer/TATA </b></h5>
      <h6 class='w3-text-teal'><i class='fa fa-calendar fa-fw w3-margin-right'></i>Dec 2020- Jun 2022 <!--<span class='w3-tag w3-teal w3-round'>Current</span> --></h6>
      <p>Implement code based on project specifications.
Create new tables within MySQL.
Test and document code.
Provide feedback to the development group to improve Agile Project management methods.</p>
      <hr>
    </div>
      <?php } else { while($qow=mysqli_fetch_array($qur,MYSQLI_ASSOC))
        {
      ?>
      <div class='w3-container'>
       
            <h5 class='w3-opacity'><b><?php echo $qow['position']; ?> / <?php echo $qow['company_name']; ?></b></h5>
            <h6 class='w3-text-teal'><i class='fa fa-calendar fa-fw w3-margin-right'></i><?php echo $qow['jdate']."-".$qow['edate']; ?> <!--<span class='w3-tag w3-teal w3-round'>Current</span> --></h6>
            <p><?php echo $qow['work']; ?></p>
            <hr>
          </div>
        <?php } }?>
      </div> 
  <!-- End work experience -->
      <!-- Education -->
        <div class='w3-container w3-card w3-white'>
          <h2 class='w3-text-grey w3-padding-16'><i class='fa fa-certificate fa-fw w3-margin-right w3-xxlarge w3-text-teal'></i>Education</h2>
      <?php 
      $qu=mysqli_query($conn,"SELECT * FROM edu_info where user_id=$id"); 
       if(mysqli_num_rows($qu)== 0)
       {
      ?>
      
        <div class="w3-container">
          <h5 class="w3-opacity"><b>London Business School</b></h5>
          <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>2013 - 2015</h6>
          <p>Master Degree</p>
          <hr>
        </div>
        <div class="w3-container">
          <h5 class="w3-opacity"><b>School of Coding</b></h5>
          <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>2010 - 2013</h6>
          <p>Bachelor Degree</p><br>
        </div>

      <?php
       } else {
          while($qo=mysqli_fetch_array($qu,MYSQLI_ASSOC))
        {
           ?>
          <div class='w3-container'>
            <h5 class='w3-opacity'><b><?php echo $qo['qualification'] ?></b></h5>
            <h6 class='w3-text-teal'><i class='fa fa-calendar fa-fw w3-margin-right'></i><?php echo $qo['passyear']; ?></h6>
            <p><?php echo $qo['board']; ?></p><p><?php echo $qo['per']; ?>&nbsp;<?php echo $qo['rtype']; ?></p>
        
        <hr>
          </div>
        <?php } } ?>

        </div>
      <!-- End Education Details   -->
      <!-- Start Additional Certificate -->
       <div class='w3-container w3-card w3-white'>
          <h2 class='w3-text-grey w3-padding-16'><i class='fa fa-certificate fa-fw w3-margin-right w3-xxlarge w3-text-teal'></i>Additional Certificate</h2>
      <?php 
      $cqu=mysqli_query($conn,"SELECT * FROM add_cer where user_id=$id"); 

      if(mysqli_num_rows($cqu)== 0)
      {
      ?>
      <div class="w3-container">
      <h5 class="w3-opacity"><b>W3Schools.com</b></h5>
      <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>Forever</h6>
      <p>Web Development! All I need to know in one place</p>
      <hr>
    </div>

   <?php } else {
          while($cer=mysqli_fetch_array($cqu,MYSQLI_ASSOC))
        {
      ?>
          <div class='w3-container'>
            <h5 class='w3-opacity'><b><?php echo $cer['cname'] ?></b></h5>
            <!--<h6 class='w3-text-teal'>
            <i class='fa fa-calendar fa-fw w3-margin-right'></i>2020</h6>-->
            <p><?php echo $cer['cdetails']; ?></p>
        
        <hr>
          </div>
        <?php } } ?>
       
        </div>
<!-- End Addtional Certificate  -->

      </div>    <!-- End Right Column -->
    
      
    <!-- End Grid -->
    </div>
    
    <!-- End Page Container -->
  </div>
</div>
        </div>
<!-- <button class="btn btn-success"  onClick="PrintDiv();"><i class="fa fa-print"></i> Print</button> -->
   <?php
// include 'footer.php';
 ?>
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
