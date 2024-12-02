<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Better Reads</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<style>
    body {
        margin: 0;
        padding: 0;
        height: 100vh;
        background: url('images/good_reads.png') no-repeat center center/cover;
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
</style>
</head>
<body>
    <div id="header1">
        <h1 class="display-1">Better Reads</h1>
        <p class="fs-3">A knock-off Good Reads</p>
        <div class="d-flex justify-content-center mt-4">
            <a href="register.php"><button type="button" class="btn btn-light mx-2">Register</button></a>
            <a href="login.php"><button type="button" class="btn btn-light mx-2">Login</button></a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

