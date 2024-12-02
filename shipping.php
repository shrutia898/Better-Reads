<?php
session_start();
include("includes/openDBConn.php");

$sql = "SELECT ShippingID, Login, Name, Address, City, State, Zip FROM P2Shipping WHERE Login='" . $_SESSION['login'] . "'";
$result = mysqli_query($db, $sql);

if (empty($result)) {
    $num_results = 0;
} else {
    $num_results = mysqli_num_rows($result);
}

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
<div class="container my-5">
    <h1 class="text-center display-2 mb-4">Better Reads</h1>

    <?php include("includes/menu2.php"); ?>

    <div class="text-danger fw-bold mb-3">
        <?php echo($_SESSION["errorMessage"]); ?>
    </div>
    <table class="table table-bordered table-hover text-center">
        <thead class="table-dark">
        <tr>
            <th colspan="8">Shipping Information</th>
        </tr>
        <tr>
            <th>Actions</th>
            <th>ShippingID</th>
            <th>Login</th>
            <th>Name</th>
            <th>Address</th>
            <th>City</th>
            <th>State</th>
            <th>Zip</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <td colspan="8" class="text-muted">Information pulled from MySQL database</td>
        </tr>
        </tfoot>
        <tbody>
        <?php
        for ($i = 0; $i < $num_results; $i++) {
            $row = mysqli_fetch_array($result);
            ?>
            <tr>
                <td>
                    <a href="updateShipping.php?id=<?= trim($row['ShippingID']); ?>" class="btn btn-sm btn-secondary">Edit</a>
                    <a href="deleteShipping.php?id=<?= trim($row['ShippingID']); ?>" class="btn btn-sm btn-secondary">Delete</a>
                </td>
                <td><?= trim($row['ShippingID']); ?></td>
                <td><?= trim($row['Login']); ?></td>
                <td><?= trim($row['Name']); ?></td>
                <td><?= trim($row['Address']); ?></td>
                <td><?= trim($row['City']); ?></td>
                <td><?= trim($row['State']); ?></td>
                <td><?= trim($row['Zip']); ?></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    <div class="container-fluid d-flex justify-content-center">
        <form id="form0" method="post" action="doInsertShipping.php" style="width:60%" class="bg-white p-4 rounded shadow-sm">
            <fieldset>
                <legend class="text-secondary">Shipping Information</legend>
                <!-- Shipping ID -->
                <div class="mb-3">
                    <label for="shippingID" class="form-label">Shipping ID</label>
                    <input type="text" class="form-control" name="shippingID" id="shippingID" maxlength="30" placeholder="Enter Shipping ID">
                </div>
                <!-- Login -->
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
                    <input type="text" class="form-control" name="name" id="name" maxlength="50" placeholder="Enter Name">
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" name="address" id="address" maxlength="30" placeholder="Enter Address">
                </div>
                <div class="mb-3">
                    <label for="city" class="form-label">City</label>
                    <input type="text" class="form-control" name="city" id="city" maxlength="30" placeholder="Enter City">
                </div>
                <div class="mb-3">
                    <label for="state" class="form-label">State</label>
                    <input type="text" class="form-control" name="state" id="state" maxlength="20" placeholder="Enter State">
                </div>
                <div class="mb-3">
                    <label for="zip" class="form-label">Zip Code</label>
                    <input type="text" class="form-control" name="zip" id="zip" maxlength="5" placeholder="Enter Zip Code">
                </div>
                <div class="text-danger fw-bold mb-3">
                    <?php echo($_SESSION["errorMessage"]); ?>
                </div>
                <button type="submit" class="btn btn-secondary w-100" name="submit" id="submit">Submit</button>
            </fieldset>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
include("includes/closeDBConn.php");
?>


