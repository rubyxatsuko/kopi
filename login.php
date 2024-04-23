<?php

include("db.php");

session_start();


if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $simpan = $conn->query("SELECT * FROM users WHERE username = '$username' AND password = '$password'")->fetch_assoc();



    if ($simpan > 0) {
        $_SESSION['users'] = $simpan;
        $_SESSION['id'] = $simpan['id'];

        echo '<script>alert("mantap")
        location.replace("page/index.php"); </script>';
    }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pos App - Rubyz</title>
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center align-items-center py-5 " style="min-height: 100vh;">
            <div class="col-md-6 col-lg-4">
                <div class="text-center">
                    <img src="assets/img/jokii.png" alt="" width="200">
                </div>
                <h3 class="text-center">Sign In Pos App Rubyz</h3>
                <div class="card mt-4">
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button class="btn btn-primary" name="submit">Sign In</button>

                        </form>
                    </div>
                </div>
                <div class="text-center mt-4">
                        <p>made with rubyz</p>
                    </div>
            </div>
        </div>
    </div>   
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script> 
</body>
</html>