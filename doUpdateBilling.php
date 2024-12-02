<?php
session_start();

if (!empty($_POST["login"])) {
    $_SESSION["login"] = $_POST["login"];
}

var_dump($_POST);

$BillingID = $_POST["billingID"];
$Login = addslashes($_POST["login"]);
$Name = addslashes($_POST["billName"]);
$Address = addslashes($_POST["billAddress"]);
$City = addslashes($_POST["billCity"]);
$State = addslashes($_POST["billState"]);
$Zip = addslashes($_POST["billZip"]);
$CardType = addslashes($_POST["cardType"]);
$CardNumber = addslashes($_POST["cardNumber"]);
$ExpMonth = addslashes($_POST["expMonth"]);
$ExpYear = addslashes($_POST["expYear"]);

var_dump($BillingID, $Login, $Name, $Address, $City, $State, $Zip, $CardType, $CardNumber, $ExpMonth, $ExpYear);

$removeThese = array("<?php", "<?", "</", "<", "?>", "/>", ";" );
$Login = str_replace($removeThese, "", $Login);
$Name = str_replace($removeThese, "", $Name);
$Address = str_replace($removeThese, "", $Address);
$City = str_replace($removeThese, "", $City);
$State = str_replace($removeThese, "", $State);
$Zip = str_replace($removeThese, "", $Zip);

if (empty($BillingID) || empty($Name) || empty($Login) || empty($Address) || empty($City) || empty($State) || empty($Zip) || empty($CardType) || empty($CardNumber) || empty($ExpMonth) || empty($ExpYear)) {
    $_SESSION["errorMessage"] = "You must enter a value for all boxes.";
    header("Location: billing.php");
    exit;
} else {
    $_SESSION["errorMessage"] = "";
}

include("includes/openDBConn.php");

$sql = "SELECT BillingID FROM P2Billing WHERE BillingID = " . (is_numeric($BillingID) ? $BillingID : "'$BillingID'");

$result = mysqli_query($db, $sql);

if (!$result) {
    echo "Error: " . mysqli_error($db);
}
 else {
    $_SESSION["errorMessage"] = "";
}

$expMonth = $_POST['expMonth']; 
$expYear = $_POST['expYear'];  
$expDate = $expMonth ."/" . $expYear;

$sql = "UPDATE P2Billing 
        SET BillName = '$Name', BillAddress = '$Address', BillCity = '$City', BillState = '$State', BillZip = '$Zip', 
            CardType = '$CardType', CardNumber = '$CardNumber', 
          	ExpDate = '$expDate'
        WHERE BillingID = '$BillingID'";


$result = mysqli_query($db, $sql);

if (!$result) {
    echo "Error: " . mysqli_error($db);
}

include("includes/closeDBConn.php");

header("Location: billing.php");
exit;
?>

