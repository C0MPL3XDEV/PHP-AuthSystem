<!DOCTYPE html>
<?php
global$connection;
session_start();
include ("connect-db.php");

if(isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    print($username);
    $login_query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($connection, $login_query);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['username'] = $username;
        header("Location: home.php?$username");
        exit();
    } else {
        echo "
            <div class='card' id='card-div1' data-bs-theme='dark'>
                <div class='card-body'>
                    Incorrect email or password check your credentials
                </div>
            </div>
        ";
    }

$result->free();
mysqli_close($connection);
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body style="background-color: #212529">
<div class="container" data-bs-theme="dark">
    <form action="login.php" method="POST">
        <h1>Login Form</h1>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">@</span>
            <input type="text" class="form-control" placeholder="Username"
                   name="username" aria-label="Username" aria-describedby="basic-addon1">
        </div>
        <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-passport-fill" viewBox="0 0 16 16">
                        <path d="M8 6a2 2 0 1 0 0 4 2 2 0 0 0 0-4"/>
                        <path d="M2 3.252a1.5 1.5 0 0 1 1.232-1.476l8-1.454A1.5 1.5 0 0 1 13 1.797v.47A2 2 0 0 1 14 4v10a2 2 0 0 1-2 2H4a2 2 0 0 1-1.51-.688 1.5 1.5 0 0 1-.49-1.11V3.253ZM5 8a3 3 0 1 0 6 0 3 3 0 0 0-6 0m0 4.5a.5.5 0 0 0 .5.5h5a.5.5 0 0 0 0-1h-5a.5.5 0 0 0-.5.5"/>
                </svg></span>
            <input type="password" class="form-control" placeholder="Password"
                   name="password" aria-label="Password" aria-describedby="basic-addon1">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Sign-In</button><span> Dont have an account? <a href="register.php">Sign-Up</a> </span>
    </form>
</div>
</body>
</html>