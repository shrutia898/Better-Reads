<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$Username = $_SESSION['username'];
$FirstName = $_POST['firstName'];
$LastName = $_POST['lastName'];
$Email = $_POST['email'];
$Newsletter = $_POST['newsletter'];

$removeThese = array("<?php", "<?", "</", "<", "?>", "/>", ";");
$FirstName = str_replace($removeThese, "", $FirstName);
$LastName = str_replace($removeThese, "", $LastName);
$Email = str_replace($removeThese, "", $Email);

if (empty($FirstName) || empty($LastName) || empty($Email) || empty($Newsletter)) {
    $_SESSION["errorMessage"] = "All fields are required.";
    header("Location: updateProfile.php");
    exit;
}


include("includes/openDBConn.php");

$sql = "UPDATE P2User SET FirstName = '" . $FirstName . "', LastName = '" . $LastName . "', Email = '" . $Email . "', NewsLetter = '" . $Newsletter . "' WHERE Login = '" . $Username . "'";

$result = mysqli_query($db, $sql);

header("Location: account.php");

exit;

include("includes/closeDBConn.php");
?>

