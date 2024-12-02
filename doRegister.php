<?php
session_start();

$Username = addslashes( $_POST["login"] );
$FirstName = addslashes( $_POST["firstName"] );
$LastName = addslashes( $_POST["lastName"] );
$Email = addslashes( $_POST["email"] );
$Password = addslashes( $_POST["password"] );
$Newsletter = $_POST["newsletter"];

$_SESSION["firstName"] = $FirstName;
$_SESSION["lastName"] = $LastName;
$_SESSION["email"] = $Email;
$_SESSION["username"] = $Username;
$_SESSION["newsletter"] = $Newsletter;

$removeThese = array("<?php", "<?", "</", "<", "?>", "/>", ";" );

$Username = str_replace($removeThese, "", $Username);
$FirstName = str_replace($removeThese, "", $FirstName);
$LastName = str_replace($removeThese, "", $LastName);
$Email = str_replace($removeThese, "", $Email);
$Password = str_replace($removeThese, "", $Password);

if(($Username == "") || ($FirstName == "") || ($LastName == "") || ($Email == "") || ($Password == "") || ($Newsletter == ""))
{
	$_SESSION["errorMessage"] = "You must enter a value for all boxes.";
	header("Location: register.php");
	exit;
}
else
{
	$_SESSION["errorMessage"] = "";
}

include("includes/openDBConn.php");

$sql = "SELECT Login FROM P2User WHERE Login='$Username'";
echo($sql);

$result = mysqli_query($db, $sql);

if(empty($result))
{
	$num_results = 0;
}
else
{
	$num_results = mysqli_num_rows($result);
	
}
if ($num_results != 0)
{
	$_SESSION["errorMessage"] = "The Login you entered already exists!";
	header("Location: login.php");
	exit;
}
else
{
	$_SESSION["errorMessage"] = "";
}
$sql = "INSERT INTO P2User(Login, FirstName, LastName, Passwd, Email, NewsLetter) 
        VALUES('".$Username."', '".$FirstName."', '".$LastName."', '".$Password."', '".$Email."', '".$Newsletter."')";

$result = mysqli_query($db, $sql);

include("includes/closeDBConn.php");

header("Location:login.php");
exit;


?>
