<!DOCTYPE html>
<html lang="en">
<?php include ("connect-db.php"); ?>

<?php

global $connection;

ini_set('display_errors', 1);

if (isset($_POST["submit"])) {
    error_reporting(E_ALL);
    $country = $_POST['country'];
    $name = $_POST["name"];
    $date = $_POST["date"];
    $username = $connection->real_escape_string($_POST["username"]);
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $email = $connection->real_escape_string($_POST["usermail"]."@".$_POST["mailserver"]);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "
            <div class='card' id='card-div1' data-bs-theme='dark'>
                <div class='card-body'>
                    Incorrect email format. Try Again
                </div>
            </div>
        ";
    }

    // check email unique
    $verify_query = mysqli_execute_query($connection, "SELECT users.email, users.username FROM users WHERE users.email = '$email' OR users.username = '$username'" );
    /** @noinspection PhpIfWithCommonPartsInspection */
    if (mysqli_num_rows($verify_query) != 0) {
        header("Location: existing_account.php");
        exit();
    } else {
        session_start();
        $insert_query = "INSERT INTO users (callsign, datebirth, username, email, password, fk_id_comune) VALUES ('$name', '$date', '$username', '$email', '$password', '$country')";
        $execute = mysqli_execute_query($connection, $insert_query);
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $name;
        $_SESSION['date'] = $date;
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
</head>
<body style="background-color: #212529">
   <div class="container" data-bs-theme="dark">
       <form action="register.php" method="POST">
            <h1>Registration Form</h1>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/></svg></span>
               <input type="text" class="form-control" placeholder="Name" name="name" aria-label="Name" aria-describedby="basic-addon1" required>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">@</span>
                <input type="text" class="form-control" placeholder="Username"
                       name="username" aria-label="Username" aria-describedby="basic-addon1" required>
            </div>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Username" aria-label="Username" name="usermail" required>
                <span class="input-group-text">@</span>
                <input type="text" class="form-control" placeholder="mail.com" aria-label="Server" name="mailserver" required>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-passport-fill" viewBox="0 0 16 16">
                        <path d="M8 6a2 2 0 1 0 0 4 2 2 0 0 0 0-4"/>
                        <path d="M2 3.252a1.5 1.5 0 0 1 1.232-1.476l8-1.454A1.5 1.5 0 0 1 13 1.797v.47A2 2 0 0 1 14 4v10a2 2 0 0 1-2 2H4a2 2 0 0 1-1.51-.688 1.5 1.5 0 0 1-.49-1.11V3.253ZM5 8a3 3 0 1 0 6 0 3 3 0 0 0-6 0m0 4.5a.5.5 0 0 0 .5.5h5a.5.5 0 0 0 0-1h-5a.5.5 0 0 0-.5.5"/>
                </svg></span>
                <input type="password" class="form-control" placeholder="Password"
                       name="password" aria-label="Password" aria-describedby="basic-addon1" required/>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                    </svg>
                </span>
                <input type="date" class="form-control" placeholder="Date Of Birth" name="date" aria-label="Date" aria-describedby="basic-addon1" required>
            </div>
            <select class="form-select" aria-label="Select Country" name="country" required>
            <option selected>Select Country</option>
                <?php
                    $location_query = "SELECT * from COMUNI WHERE NOT(comune = '') ORDER BY comune";
                    $execute = mysqli_execute_query($connection, $location_query);
                    while ($row = mysqli_fetch_array($execute, MYSQLI_NUM)) {
                        echo "<option value='$row[0]'>$row[1]</option>";
                    }
                ?>
            </select>
            <br>
            <button type="submit" class="btn btn-primary" name="submit">Sign-Up</button><span> Do you have already an account? <a href="login.php">Sign-in</a></span>
        </form>
   </div>
</body>
</html>