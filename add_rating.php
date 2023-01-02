<?php
if(!empty($_POST["rate"]) && !empty($_POST["id"])) {
require_once("Rate.php");
$rate = new Rate();
$rate->updateRatingCount($_POST["rate"], $_POST["id"]);
}
?>