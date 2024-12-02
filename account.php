<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include("includes/openDBConn.php");

$Username = $_SESSION['username'];
$sql = "SELECT FirstName, LastName, Email, NewsLetter FROM P2User WHERE Login = '$Username'";
$result = mysqli_query($db, $sql);

if ($result) {
    $user = mysqli_fetch_assoc($result);
} else {
    $_SESSION["errorMessage"] = "Failed to retrieve user data.";
    header("Location: login.php");
    exit;
}

$FirstName = $user['FirstName'];
$LastName = $user['LastName'];
$Email = $user['Email'];
$Newsletter = $user['NewsLetter'];

include("includes/closeDBConn.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="text-center mb-4">
            <h1 class="display-4 text-secondary">Update Your Profile</h1>
        </div>

        <?php include("includes/menu2.php"); ?>

        <div class="row">
            <div class="col-md-6">
                <form method="POST" action="saveAccount.php" class="bg-white p-4 rounded shadow-sm">
                    <fieldset>
                        <legend class="text-secondary">Update Your Information</legend>
                        <div class="mb-3">
                            <label for="firstName" class="form-label">First Name</label>
                            <input type="text" class="form-control" name="firstName" id="firstName" value="<?php echo $FirstName; ?>" maxlength="30" placeholder="Enter First Name">
                        </div>
                        <div class="mb-3">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" name="lastName" id="lastName" value="<?php echo $LastName; ?>" maxlength="30" placeholder="Enter Last Name">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="email" value="<?php echo $Email; ?>" maxlength="50" placeholder="Enter Email">
                        </div>
                        <div class="mb-3">
                            <label for="newsletter" class="form-label">Newsletter</label><br>
                            <input type="radio" id="Yes" name="newsletter" value="Yes" <?php echo ($Newsletter == 'Yes') ? 'checked' : ''; ?>>
                            <label for="Yes">Yes</label><br>
                            <input type="radio" id="No" name="newsletter" value="No" <?php echo ($Newsletter == 'No') ? 'checked' : ''; ?>>
                            <label for="No">No</label><br>
                        </div>
                        <div class="text-danger fw-bold mb-3">
                            <?php echo $_SESSION["errorMessage"] ?? ''; ?>
                        </div>
                        <button type="submit" class="btn btn-secondary w-100">Update Profile</button>
                    </fieldset>
                </form>
            </div>
            <div class="col-md-6">
                <div class="bg-white p-4 rounded shadow-sm">
                    <h2 class="text-secondary">Your Current Information</h2>
					 <p><strong>Username:</strong> <?php echo $Username; ?></p>
                    <p><strong>First Name:</strong> <?php echo $FirstName; ?></p>
                    <p><strong>Last Name:</strong> <?php echo $LastName; ?></p>
                    <p><strong>Email:</strong> <?php echo $Email; ?></p>
                    <p><strong>Newsletter:</strong> <?php echo $Newsletter; ?></p>
                </div>
            </div>
        </div>
    </div>
    <?php $_SESSION["errorMessage"] = ""; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

