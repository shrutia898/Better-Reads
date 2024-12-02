<?php 

session_start();

$id = $_GET["id"];

include("includes/openDBConn.php");

$sql = "DELETE FROM P2Billing WHERE BillingID = '$id'";

$result = mysqli_query($db, $sql);


include("includes/closeDBConn.php");

header("Location:billing.php");
?>