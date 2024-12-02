<?php 

session_start();

$id = $_GET["id"];

include("includes/openDBConn.php");

$sql = "DELETE FROM P2Shipping WHERE ShippingID = '$id'";

$result = mysqli_query($db, $sql);


include("includes/closeDBConn.php");

header("Location:shipping.php");
?>