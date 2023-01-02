<?php
require_once "config.php";

$id=$_POST["id"];
$rate=$_POST["rate"];
//echo $rate;
$upd=mysqli_query($conn,"UPDATE languages SET rate='".$rate."' WHERE id='".$id."'");
//echo $upd;
?>
