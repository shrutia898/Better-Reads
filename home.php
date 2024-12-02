<?php
session_start();
if (!isset($_SESSION["username"]) || empty($_SESSION["username"])) {
    $_SESSION["errorMessage"] = "You must log in first!";
    header("Location: login.php");
    exit;
}

include("includes/openDBConn.php");

$Username = $_SESSION['username'];
$sql = "SELECT FirstName, LastName FROM P2User WHERE Login = '$Username'";
$result = mysqli_query($db, $sql);

if ($result) {
    $user = mysqli_fetch_assoc($result);
} else {
    $_SESSION["errorMessage"] = "Failed to retrieve user data.";
    header("Location: login.php");
    exit;
}
if ($user) {
    $FirstName = $user['FirstName'];
	$LastName = $user['LastName'];
} else {
    $_SESSION["errorMessage"] = "User data not found.";
    header("Location: login.php");
    exit;
}

include("includes/closeDBConn.php");
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Better Reads Home</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	
<style>
    body {
        margin: 0;
        padding: 0;
        height: 100vh;
        background: url('images/good_reads.png') no-repeat center center/cover; background */
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        text-align: center;
    }
    #header1 {
        margin-top: 20px;
        background-color: rgba(0, 0, 0, 0.5);
        padding: 20px;
        border-radius: 10px;
    }
    .btn {
        width: 120px;
        height: 45px;
    }
    img {
        display: none;
    }
	a{
		text-decoration: none;
		color:black;
	}
	h1,p{
		color: white;
	}
</style>
</head>
<body>
     <div id="header1">
        <h1 class="display-1">Hello!</h1>
        <p class="fs-3"><?php echo $FirstName." ".$LastName ;?></p>
        <div class="d-flex justify-content-center mt-4">
            <a href="account.php"><button type="button" class="btn btn-light mx-2">Account</button></a>
            <a href="shipping.php"><button type="button" class="btn btn-light mx-2">Shipping</button></a>
            <a href="billing.php"><button type="button" class="btn btn-light mx-2">Billing</button></a>
			<a href="logout.php"><button type="button" class="btn btn-light mx-2">Logout</button></a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

