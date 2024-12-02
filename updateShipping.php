<?php
session_start();
include("includes/openDBConn.php");


$id=$_GET["id"];

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Better Reads - Shipping</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	
<?php
$id = addslashes($_GET["id"]);
$sql = "SELECT ShippingID, Login, Name, Address, City, State, Zip FROM P2Shipping WHERE ShippingID='" . $id . "'";

$result = mysqli_query($db, $sql);

if (empty($result)) {
    $num_results = 0;
} else {
    $num_results = mysqli_num_rows($result);
	$row = mysqli_fetch_array($result);
}

if($num_results == 0){
	$_SESSION["errorMessage"] = "Must pick a value to edit.";
}

?>
	
  <h1 class="text-center display-2 mb-4 p-3">Better Reads</h1>

    <?php include("includes/menu2.php"); ?>


    <div class="container-fluid d-flex justify-content-center">
        <form id="form0" method="post" action="doUpdateShipping.php" style="width:60%" class="bg-white p-4 rounded shadow-sm">
            <fieldset>
                <legend class="text-secondary">Update Shipping Information</legend>
                <div class="mb-3">
                    <label for="shippingID" class="form-label">Shipping ID</label>
                    <input type="text" class="form-control" name="shippingIDis" id="shippingIDis" maxlength="30" placeholder="Enter Shipping ID" value="<?php if($num_results != 0){echo(trim($row["ShippingID"] ) );}?>" disabled = "disabled">
					<input type="hidden" class="form-control" name="shippingID" id="shippingID" maxlength="30" placeholder="Enter Shipping ID" value="<?php if($num_results != 0){echo(trim($row["ShippingID"] ) );}?>" >
                </div>
                <div class="mb-3">
					<label for="login" class="form-label">Login</label>
					<input type="text" class="form-control" name="loginDisplay" id="loginDisplay" maxlength="30" hidden>

					<?php
					if (isset($_SESSION['login']) && !empty($_SESSION['login'])) {
						echo '<input type="hidden" name="login" id="login" value="' . $_SESSION['login'] . '">';
					} else {
						$_SESSION['errorMessage'] = "You must be logged in to submit shipping information.";
						header("Location: login.php");
						exit;
					}
					?>
				</div>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="name" maxlength="50" placeholder="Enter Name" value="<?php if($num_results != 0){echo(trim($row["Name"] ) );}?>">
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" name="address" id="address" maxlength="30" placeholder="Enter Address" value="<?php if($num_results != 0){echo(trim($row["Address"] ) );}?>">
                </div>
                <div class="mb-3">
                    <label for="city" class="form-label">City</label>
                    <input type="text" class="form-control" name="city" id="city" maxlength="30" placeholder="Enter City" value="<?php if($num_results != 0){echo(trim($row["City"] ) );}?>">
                </div>
                <div class="mb-3">
                    <label for="state" class="form-label">State</label>
                    <input type="text" class="form-control" name="state" id="state" maxlength="20" placeholder="Enter State" value="<?php if($num_results != 0){echo(trim($row["State"] ) );}?>">
                </div>
                <div class="mb-3">
                    <label for="zip" class="form-label">Zip Code</label>
                    <input type="text" class="form-control" name="zip" id="zip" maxlength="5" placeholder="Enter Zip Code" value="<?php if($num_results != 0){echo(trim($row["Zip"] ) );}?>">
                </div>
                <div class="text-danger fw-bold mb-3">
                    <?php echo($_SESSION["errorMessage"]); ?>
                </div>
                <button type="submit" class="btn btn-secondary w-100" name="submit" id="submit">Submit</button>
            </fieldset>
        </form>
		<?php
		$_SESSION["errorMessage"] = "";
		include("includes/closeDBConn.php");
	?>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

