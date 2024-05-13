<!DOCTYPE html>
<?php
session_start();
?>
<html lang="en">
    <head>
        <title>Registration Successful</title>
        <link rel="stylesheet" href="register.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    </head>
    <body style="background-color: #212529">
        <div class="container" data-bs-theme="dark">
            <h1 style="align-items: center; text-align: center; position: relative; top: 80px">Registration Confirmed</h1>
            <p style="position: relative; top: 80px">Hello <?= $_SESSION["username"] ?>, we confirm that your registration to our web portal has been successfully completed!</p>
            <p style="position: relative; top: 80px">Thank you for registering with us and welcome to our community! Go to the Log-In</p>
            <button style="position: relative; top: 80px;" class="btn btn-primary"><a style="text-decoration: none; color: #fff" href="login.php">Log-In</a></button>
        </div>
    </body>
</html>

<?php
session_start();
session_destroy();

