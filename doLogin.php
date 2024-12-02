<?php
session_start();
session_unset();
session_regenerate_id(true);

$Username = addslashes($_POST["login"]);
$Password = addslashes($_POST["password"]);

$removeThese = array("<?php", "<?", "</", "<", "?>", "/>", ";");
$Username = str_replace($removeThese, "", $Username);
$Password = str_replace($removeThese, "", $Password);

if (($Username == "") || ($Password == "")) {
    $_SESSION["errorMessage"] = "You must enter a value for all boxes.";
    header("Location: login.php");
    exit;
} else {
    $_SESSION["errorMessage"] = "";
}

include("includes/openDBConn.php");

$sql = "SELECT Login, Passwd FROM P2User WHERE Login='$Username'";

$result = mysqli_query($db, $sql);

if ($result) {
    $num_results = mysqli_num_rows($result);
} else {
    $num_results = 0;
}

if ($num_results == 0) {
    $_SESSION["errorMessage"] = "The Login you entered does not exist.";
    header("Location: register.php");
    exit;
} else {
    $row = mysqli_fetch_row($result);
    if ($Password == $row[1]) {
        $_SESSION['login'] = $Username;
		$_SESSION["firstName"] = $FirstName;
		$_SESSION["lastName"] = $LastName;
		$_SESSION["email"] = $Email;
		$_SESSION["username"] = $Username;
		$_SESSION["newsletter"] = $Newsletter;
        header("Location: home.php");  
        exit;
    } else {
        $_SESSION["errorMessage"] = "Username or Password is incorrect.";
        header("Location: login.php");
        exit;
    }
}

include("includes/closeDBConn.php");

exit;
?>
