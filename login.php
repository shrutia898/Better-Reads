<?php
session_start();

if (empty($_SESSION["errorMessage"])) {
    $_SESSION["errorMessage"] = "";
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
	
<body class="bg-light">
    <div class="container mt-5">
        <div class="text-center mb-4">
            <h1 class="display-4 text-secondary">Welcome to Better Reads</h1>
        </div>
		
		<?php
        include("includes/menu.php");
        ?>
		
		

        <div class="row">
            <div class="col-md-6">
                <div class="bg-white p-4 rounded shadow-sm">
                    <h2 class="text-secondary p-2">About Better Reads</h2>
                    <p>
                        Better Reads is a knock off version of Good Reads. I made this because I have been reading more lately and was not sure what prompt to use for this project!
                    </p>
                    <p>
                        This project contains a page for registration. It also includes a login page -- this current page. When you login, there will be options to set your billing and shipping address, as well change it. 
                    </p>
                    <p>
                        Using PHP, Bootstrap, HTML/CSS, Javascript, and phpMyAdmin - I made the pages, databases for all users, shipping, billing, and php/javascript to pull out the information.
                    </p>
                </div>
            </div>
			
			<div class="col-md-6">
                <form id="form0" method="post" action="doLogin.php" class="bg-white p-4 rounded shadow-sm">
                    <fieldset>
                        <legend class="text-secondary">Login to Better Reads</legend>
                  
                        <div class="mb-3">
                            <label for="login" class="form-label">Username</label>
                            <input type="text" class="form-control" name="login" id="login" maxlength="20" placeholder="Enter Username">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password" maxlength="20" placeholder="Enter Password">
                        </div>
					
                        <div class="text-danger fw-bold mb-3">
                            <?php echo($_SESSION["errorMessage"]); ?>
                        </div>
                        <button type="submit" class="btn btn-secondary w-100" name="submit" id="submit">Login</button>
                    </fieldset>
                </form>
            </div>

        </div>
    </div>

    <?php
    $_SESSION["errorMessage"] = "";
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script type="text/javascript">
        document.getElementById("login").focus();
    </script>
</body>
</html>

