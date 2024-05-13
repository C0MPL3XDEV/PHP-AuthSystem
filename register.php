<!DOCTYPE html>
<html lang="en">
<?php include ("connect-db.php"); ?>

<?php

global $connection;

ini_set('display_errors', 1);

if (isset($_POST["submit"])) {
    error_reporting(E_ALL);
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["usermail"]."@".$_POST["mailserver"];

    // check email unique
    $verify_query = mysqli_execute_query($connection, "SELECT users.email, users.username FROM users WHERE users.email = '$email' OR users.username = '$username'");
    /** @noinspection PhpIfWithCommonPartsInspection */
    if (mysqli_num_rows($verify_query) != 0) {
        header("Location: existing_account.php");
        exit();
    } else {
        session_start();
        $insert_query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
        $execute = mysqli_query($connection, $insert_query);
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        header("Location: register_success.php");
        exit();
    }
}
?>
<head>
    <meta charset="UTF-8">
    <title>Registration Page</title>
    <link rel="stylesheet" href="register.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body style="background-color: #212529">
   <div class="container" data-bs-theme="dark">
       <form action="register.php" method="POST">
            <h1>Registration Form</h1>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">@</span>
                <input type="text" class="form-control" placeholder="Username"
                       name="username" aria-label="Username" aria-describedby="basic-addon1">
            </div>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Username" aria-label="Username" name="usermail">
                <span class="input-group-text">@</span>
                <input type="text" class="form-control" placeholder="mail.com" aria-label="Server" name="mailserver">
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
            <button type="submit" class="btn btn-primary" name="submit">Sign-Up</button><span> Do you have already an account? <a href="login.php">Sign-in</a></span>
        </form>
   </div>
</body>
</html>