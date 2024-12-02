<?php
session_start();
include("includes/openDBConn.php");

$id = $_GET["id"];

$id = addslashes($_GET["id"]); 

$sql = "SELECT BillingID, Login, BillName, BillAddress, BillCity, BillState, BillZip, CardType, CardNumber, ExpDate FROM P2Billing WHERE BillingID='" . $id . "'";

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

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Better Reads - Billing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<h1 class="text-center display-2 mb-4 p-3">Better Reads</h1>

<?php include("includes/menu2.php"); ?>

<div class="container-fluid d-flex justify-content-center">
    <form id="form0" method="post" action="doUpdateBilling.php" style="width:60%" class="bg-white p-4 rounded shadow-sm">
        <fieldset>
            <legend class="text-secondary">Update Billing Information</legend>

            <div class="mb-3">
                <label for="billingID" class="form-label">Billing ID</label>
                <input type="text" class="form-control" name="billingIDis" id="billingIDis" maxlength="30" placeholder="Enter Billing ID" value="<?php if($num_results != 0){echo(trim($row["BillingID"]));}?>" disabled="disabled">
                <input type="hidden" class="form-control" name="billingID" id="billingID" maxlength="30" placeholder="Enter Billing ID" value="<?php if($num_results != 0){echo(trim($row["BillingID"]));}?>">
            </div>
            <div class="mb-3">
                <label for="login" class="form-label">Login</label>
                <input type="text" class="form-control" name="loginDisplay" id="loginDisplay" maxlength="30" hidden>

                <?php
                if (isset($_SESSION['login']) && !empty($_SESSION['login'])) {
                    echo '<input type="hidden" name="login" id="login" value="' . $_SESSION['login'] . '">';
                } else {
                    $_SESSION['errorMessage'] = "You must be logged in to submit billing information.";
                    header("Location: login.php");
                    exit;
                }
                ?>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="billName" id="billName" maxlength="50" placeholder="Enter Name" value="<?php if($num_results != 0){echo(trim($row["BillName"]));}?>">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" name="billAddress" id="billAddress" maxlength="100" placeholder="Enter Address" value="<?php if($num_results != 0){echo(trim($row["BillAddress"]));}?>">
            </div>
            <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <input type="text" class="form-control" name="billCity" id="billCity" maxlength="50" placeholder="Enter City" value="<?php if($num_results != 0){echo(trim($row["BillCity"]));}?>">
            </div>
            <div class="mb-3">
                <label for="state" class="form-label">State</label>
                <input type="text" class="form-control" name="billState" id="billState" maxlength="20" placeholder="Enter State" value="<?php if($num_results != 0){echo(trim($row["BillState"]));}?>">
            </div>
            <div class="mb-3">
                <label for="zip" class="form-label">Zip Code</label>
                <input type="text" class="form-control" name="billZip" id="billZip" maxlength="10" placeholder="Enter Zip Code" value="<?php if($num_results != 0){echo(trim($row["BillZip"]));}?>">
            </div>
            <div class="mb-3">
                <label for="cardType" class="form-label">Card Type</label>
                <select class="form-control" name="cardType" id="cardType">
                    <option value="" disabled <?php if(empty($row["CardType"])) { echo 'selected'; } ?>>Select Card Type (Optional)</option>
                    <option value="Visa" <?php if($row["CardType"] == "Visa") { echo 'selected'; } ?>>Visa</option>
                    <option value="MasterCard" <?php if($row["CardType"] == "MasterCard") { echo 'selected'; } ?>>MasterCard</option>
                    <option value="Discover" <?php if($row["CardType"] == "Discover") { echo 'selected'; } ?>>Discover</option>
                    <option value="American Express" <?php if($row["CardType"] == "American Express") { echo 'selected'; } ?>>American Express</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="cardNumber" class="form-label">Card Number</label>
                <input type="text" class="form-control" name="cardNumber" id="cardNumber" maxlength="16" placeholder="Enter Card Number" value="<?php if($num_results != 0){echo(trim($row["CardNumber"]));}?>">
            </div>

            <?php
            if (!empty($row["ExpDate"])) {
              @list($ExpMonth, $ExpYear) = explode("/", $row["ExpDate"]);
            }
            ?>
            <div class="mb-3">
                <label for="expMonth" class="form-label">Expiration Month</label>
                <select name="expMonth" id="expMonth" class="form-control">
                    <option value="" <?php if($num_results != 0 && $ExpMonth == '') {echo 'selected';} ?>>Select Month</option>
                    <option value="01" <?php echo (isset($ExpMonth) && $ExpMonth == '01') ? 'selected' : ''; ?>>01</option>
                    <option value="02" <?php echo (isset($ExpMonth) && $ExpMonth == '02') ? 'selected' : ''; ?>>02</option>
                    <option value="03" <?php echo (isset($ExpMonth) && $ExpMonth == '03') ? 'selected' : ''; ?>>03</option>
                    <option value="04" <?php echo (isset($ExpMonth) && $ExpMonth == '04') ? 'selected' : ''; ?>>04</option>
                    <option value="05" <?php echo (isset($ExpMonth) && $ExpMonth == '05') ? 'selected' : ''; ?>>05</option>
                    <option value="06" <?php echo (isset($ExpMonth) && $ExpMonth == '06') ? 'selected' : ''; ?>>06</option>
                    <option value="07" <?php echo (isset($ExpMonth) && $ExpMonth == '07') ? 'selected' : ''; ?>>07</option>
                    <option value="08" <?php echo (isset($ExpMonth) && $ExpMonth == '08') ? 'selected' : ''; ?>>08</option>
                    <option value="09" <?php echo (isset($ExpMonth) && $ExpMonth == '09') ? 'selected' : ''; ?>>09</option>
                    <option value="10" <?php echo (isset($ExpMonth) && $ExpMonth == '10') ? 'selected' : ''; ?>>10</option>
                    <option value="11" <?php echo (isset($ExpMonth) && $ExpMonth == '11') ? 'selected' : ''; ?>>11</option>
                    <option value="12" <?php echo (isset($ExpMonth) && $ExpMonth == '12') ? 'selected' : ''; ?>>12</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="expYear" class="form-label">Expiration Year</label>
                <select name="expYear" id="expYear" class="form-control">
                    <option value="" <?php if($num_results != 0 && $ExpYear == '') {echo 'selected';} ?>>Select Year</option>
                    <option value="24" <?php echo ($ExpYear == '24') ? 'selected' : ''; ?>>2024</option>
                    <option value="25" <?php echo ($ExpYear == '25') ? 'selected' : ''; ?>>2025</option>
                    <option value="26" <?php echo ($ExpYear == '26') ? 'selected' : ''; ?>>2026</option>
                    <option value="27" <?php echo ($ExpYear == '27') ? 'selected' : ''; ?>>2027</option>
                    <option value="28" <?php echo ($ExpYear == '28') ? 'selected' : ''; ?>>2028</option>
                    <option value="29" <?php echo ($ExpYear == '29') ? 'selected' : ''; ?>>2029</option>
                </select>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary w-100">Update Billing Info</button>
            </div>
        </fieldset>
    </form>
</div>

</body>
</html>

