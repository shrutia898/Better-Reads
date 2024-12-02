<?php 
session_start();


$ShippingID = $_POST["shippingID"];
$Login = addslashes($_POST["login"]);
$Name = addslashes($_POST["name"]);
$Address = addslashes($_POST["address"]);
$City = addslashes($_POST["city"]);
$State = addslashes($_POST["state"]);
$Zip = addslashes($_POST["zip"]);

$removeThese = array("<?php", "<?", "</", "<", "?>", "/>", ";" );
$Login = str_replace($removeThese, "", $Login);
$Name = str_replace($removeThese, "", $Name);
$Address = str_replace($removeThese, "", $Address);
$City = str_replace($removeThese, "", $City);
$State = str_replace($removeThese, "", $State);
$Zip = str_replace($removeThese, "", $Zip);

if (($ShippingID == "") || ($Login == "") || ($Name == "") || ($Address == "") || ($City == "") || ($State == "") || ($Zip == "")) {
    $_SESSION["errorMessage"] = "You must enter a value for all boxes.";
    header("Location: shipping.php");
    exit;
}

include("includes/openDBConn.php");

$sql = "UPDATE P2Shipping 
        SET Name='$Name', Address='$Address', City='$City', State='$State', Zip='$Zip' 
        WHERE ShippingID='$ShippingID'";

echo($sql);

$result = mysqli_query($db, $sql);

include("includes/closeDBConn.php");

header("Location:shipping.php");
?>