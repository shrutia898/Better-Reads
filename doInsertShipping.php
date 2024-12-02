<?php
session_start();

if (!empty($_POST["login"])) {
    $_SESSION["login"] = $_POST["login"];
}


var_dump($_POST);

$ShippingID = $_POST["shippingID"];
$Login = addslashes($_POST["login"]);
$Name = addslashes($_POST["name"]);
$Address = addslashes($_POST["address"]);
$City = addslashes($_POST["city"]);
$State = addslashes($_POST["state"]);
$Zip = addslashes($_POST["zip"]);

echo "ShippingID: $ShippingID<br>";
echo "Login: $Login<br>";
echo "Name: $Name<br>";
echo "Address: $Address<br>";
echo "City: $City<br>";
echo "State: $State<br>";
echo "Zip: $Zip<br>";

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

} else {
    $_SESSION["errorMessage"] = "";
}

include("includes/openDBConn.php");

$sql = "SELECT ShippingID FROM P2Shipping WHERE ShippingID = " . (is_numeric($ShippingID) ? $ShippingID : "'$ShippingID'");

$result = mysqli_query($db, $sql);

if (!$result) {
    echo "Error: " . mysqli_error($db);
}

if (mysqli_num_rows($result) != 0) {
    $_SESSION["errorMessage"] = "The ShippingID you entered already exists!";
    header("Location: shipping.php");
    exit;
} else {
    $_SESSION["errorMessage"] = "";
}

$sql = "INSERT INTO P2Shipping (ShippingID, Login, Name, Address, City, State, Zip) 
        VALUES (" . (is_numeric($ShippingID) ? $ShippingID : "'$ShippingID'") . ", '$Login', '$Name', '$Address', '$City', '$State', '$Zip')";

$result = mysqli_query($db, $sql);

if (!$result) {
    echo "Error: " . mysqli_error($db);
}

include("includes/closeDBConn.php");

header("Location: shipping.php");
exit;
?>


