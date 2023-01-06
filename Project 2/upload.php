<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generated</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
</head>

<body>
    <div class="container-fluid ">
        <div class="row mt-5 ">
            <div class="col-12 d-flex justify-content-center align-middle">
                <div class="alert alert-success alert-dismissible fade show align-self-end d-flex" role="alert">
                    <strong>Csv Uploaded :)</strong>
                </div>
            </div>
            <div class="col-12 d-flex justify-content-center align-middle"> <button type="button" onclick="history.back();" class="btn btn-primary">Back</button></div>
        </div>
</body>

</html>

<?php
require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$servername = $_ENV['SQL_SERVER'];
$username = $_ENV['SQL_USER'];
$password = $_ENV['SQL_PASS'];
$database = $_ENV['SQL_DB'];

//connection
$sql = mysqli_connect($servername, $username, $password, $database);
$file = fopen('output.csv', 'r');
$r = 0;

while (($row = fgetcsv($file, 10000000, ',')) !== false) {
    $table = "csv_import";

    if ($r == 0) {
        $id = $row[0];
        $name = $row[1];
        $surname = $row[2];
        $ini = $row[3];
        $age = $row[4];
        $dob = $row[5];

        $query = "CREATE TABLE $table ($id INT(255) PRIMARY KEY,$name VARCHAR(50),$surname VARCHAR(50),$ini VARCHAR(50),$age INT(50),$dob VARCHAR(50))";

        mysqli_query($sql, $query);
    } else {
        //inserts data into rows
        $query = "INSERT INTO $table($id,$name,$surname,$ini,$age,$dob) VALUES('$row[0]','$row[1]','$row[2]','$row[3]','$row[4]','$row[5]')";
        //submits insert
        mysqli_query($sql, $query);
    }
    $r++;
}
