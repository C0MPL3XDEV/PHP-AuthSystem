<!DOCTYPE html>
<?php session_start() ?>
<html lang="en">
    <head>
        <title>Home Page</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="home.css">
    </head>
    <body style="background-color: #212529">
        <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
            <div class="container">
                <a class="navbar-brand" href="#"><img src="https://upload.wikimedia.org/wikipedia/commons/b/b2/Bootstrap_logo.svg" alt="" style="height: 34px; width: 46px; position:relative;"/></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">HOME</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="login.php">Change Profile</a>
                        </li>
                    </ul>
                    <form class="d-flex" role="search">
                        <button class="btn btn-danger"><a href="logout.php" style="text-decoration: none; color: white">LOG-OUT</a></button>
                    </form>
                </div>
            </div>
        </nav>
        <br>
        <div class="card" id="card-div" style="width: 40rem;" data-bs-theme="dark">
            <div class="card-body">
                <h5 class="card-title"> Welcome Back <?= $_SESSION['username'] ?> </h5>
                <h6 class="card-subtitle mb-2 text-body-secondary">Test Page</h6>
                <p class="card-text">Welcome this is the test page of the project of creating a platform with a registration and login system and dashboard with password encryption and connection to a database to hold user data, a project made for an introduction to the work figure of the full stack developer</p>
                <a href="#" class="card-link">Source Code</a>
            </div>
        </div>
    </body>
</html>
