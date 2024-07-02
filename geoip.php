<!DOCTYPE html>

<?php session_start() ?>
<?php include ("connect-db.php"); ?>
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
global$connection;
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

?>


<html lang="en">
    <head>
        <title>GeoIP Info</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="geoip.css">
    </head>
    <body style="background: #212529">
        <div class="container ali" data-bs-theme="dark">
            <h1 style="color:white">Geolocation Info</h1>
            <div class="card" id="card-div" style="width: 40rem;" data-bs-theme="dark">
                <div class="card-body">
                    <h5 class="card-title"> Geo Information of <?= $_GET['usr']; ?></h5>
                    <ul>
                        <?php
                            $idGeolocation = $_GET['id'];
                            $geolocationQuery = "SELECT comune, regione, provincia, totale, latitudine, longitudine FROM COMUNI WHERE id = $idGeolocation";
                            $queryResult = mysqli_query($connection, $geolocationQuery);
                            $row = mysqli_fetch_array($queryResult, MYSQLI_NUM);
                            echo "
                                <li>Comune: $row[0]</li>  
                                <li>Regione: $row[1]</li>  
                                <li>Provincia: $row[2]</li>  
                                <li>Totale Abitanti: $row[3]</li>  
                                <li>Latitudine: $row[4]</li>  
                                <li>Longitudine: $row[5]</li>
                                <br>  
                                <a class='btn btn-primary' href='https://maps.google.com/?q=$row[4],$row[5]' role='button'>Open in maps</a>
                            ";
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </body>
</html>
