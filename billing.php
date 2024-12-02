<?php
session_start();
include("includes/openDBConn.php");

$sql = "SELECT BillingID, Login, BillName, BillAddress, BillCity, BillState, BillZip, CardType, CardNumber, ExpDate FROM P2Billing WHERE Login='" . $_SESSION['login'] . "'";
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
    <title>Better Reads - Billing</title>
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
            <th colspan="11">Billing Information</th>
        </tr>
        <tr>
            <th>Actions</th>
            <th>BillingID</th>
            <th>Login</th>
            <th>BillName</th>
            <th>BillAddress</th>
            <th>BillCity</th>
            <th>BillState</th>
            <th>BillZip</th>
            <th>CardType</th>
            <th>CardNumber</th>
			<th>ExpDate</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <td colspan="11" class="text-muted">Information pulled from MySQL database</td>
        </tr>
        </tfoot>
        <tbody>
        <?php
        for ($i = 0; $i < $num_results; $i++) {
            $row = mysqli_fetch_array($result);
            ?>
            <tr>
                <td>
                    <a href="updateBilling.php?id=<?= trim($row['BillingID']); ?>" class="btn btn-sm btn-secondary">Edit</a>
                    <a href="deleteBilling.php?id=<?= trim($row['BillingID']); ?>" class="btn btn-sm btn-secondary">Delete</a>
                </td>
                <td><?= trim($row['BillingID']); ?></td>
                <td><?= trim($row['Login']); ?></td>
                <td><?= trim($row['BillName']); ?></td>
                <td><?= trim($row['BillAddress']); ?></td>
                <td><?= trim($row['BillCity']); ?></td>
                <td><?= trim($row['BillState']); ?></td>
                <td><?= trim($row['BillZip']); ?></td>
                <td><?= trim($row['CardType']); ?></td>
                <td><?= trim($row['CardNumber']); ?></td>
				<td><?= trim($row['ExpDate']); ?></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>

    <div class="container-fluid d-flex justify-content-center">
        <form id="form0" method="post" action="doInsertBilling.php" style="width:60%" class="bg-white p-4 rounded shadow-sm">
            <fieldset>
                <legend class="text-secondary">Billing Information</legend>
                <div class="mb-3">
                    <label for="billingID" class="form-label">Billing ID</label>
                    <input type="text" class="form-control" name="billingID" id="billingID" maxlength="30" placeholder="Enter Billing ID">
                </div>
                <div class="mb-3">
                    <label for="login" class="form-label">Login</label>
                    <input type="text" class="form-control" name="loginDisplay" id="loginDisplay" maxlength="30" hidden>

                    <?php
                    if (isset($_SESSION['login']) && !empty($_SESSION['login'])) {
                        echo '<input type="hidden" name="login" id="login" value="' . $_SESSION['login'] . '">';
                    } else {
                        $_SESSION['errorMessage'] = "You must be logged in to submit billing information.";
                        header("Location: login.php"); // Or wherever your login page is
                        exit;
                    }
                    ?>
                </div>

                <div class="mb-3">
                    <label for="billName" class="form-label">Name</label>
                    <input type="text" class="form-control" name="billName" id="billName" maxlength="50" placeholder="Enter Name">
                </div>
                <div class="mb-3">
                    <label for="billAddress" class="form-label">Address</label>
                    <input type="text" class="form-control" name="billAddress" id="billAddress" maxlength="30" placeholder="Enter Address">
                </div>
                <div class="mb-3">
                    <label for="billCity" class="form-label">City</label>
                    <input type="text" class="form-control" name="billCity" id="billCity" maxlength="30" placeholder="Enter City">
                </div>
                <div class="mb-3">
                    <label for="billState" class="form-label">State</label>
                    <input type="text" class="form-control" name="billState" id="billState" maxlength="20" placeholder="Enter State">
                </div>
                <div class="mb-3">
                    <label for="billZip" class="form-label">Zip Code</label>
                    <input type="text" class="form-control" name="billZip" id="billZip" maxlength="5" placeholder="Enter Zip Code">
                </div>
                <div class="mb-3">
                    <label for="cardType" class="form-label">Card Type</label>
                    <select class="form-control" name="cardType" id="cardType">
                        <option value="Visa">Visa</option>
                        <option value="MasterCard">MasterCard</option>
                        <option value="Discover">Discover</option>
                        <option value="American Express">American Express</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="cardNumber" class="form-label">Card Number</label>
                    <input type="text" class="form-control" name="cardNumber" id="cardNumber" maxlength="16" placeholder="Enter Card Number">
                </div>
                <div class="mb-3">
                    <label for="expDate" class="form-label">Expiration Date (MM/YY)</label>
                    <div class="d-flex">
                        <select class="form-control" name="expMonth" id="expMonth">
                            <option value="01">01</option>
                            <option value="02">02</option>
                            <option value="03">03</option>
                            <option value="04">04</option>
                            <option value="05">05</option>
                            <option value="06">06</option>
                            <option value="07">07</option>
                            <option value="08">08</option>
                            <option value="09">09</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                        <select class="form-control" name="expYear" id="expYear">
                       
                            <option value="24">2024</option>
                            <option value="25">2025</option>
                            <option value="26">2026</option>
                            <option value="27">2027</option>
							<option value="28">2028</option>
                            <option value="29">2029</option>
                        </select>
                    </div>
                </div>

                <!-- Error Message -->
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

