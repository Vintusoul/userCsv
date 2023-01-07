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
          <strong>Users Generated</strong>, Click the button below to go back and upload the generated CSV :)
        </div>
      </div>
      <div class="col-12 d-flex justify-content-center align-middle"> <button type="button" onclick="history.back();" class="btn btn-success">Back</button></div>
    </div>
</body>

</html>



<?php
require_once __DIR__ . '/vendor/autoload.php';

$number = $_POST['number'];

$headers = array("id", "Name", "Surname", "Intials", "Age", "DateOfBirth");

$name = array(
  'Homer',
  'Edgarth',
  'Rendal',
  'Dorin',
  'Billon',
  'Harry',
  'John',
  'Peter',
  'Billon',
  'Ayleen',
  'Melvan',
  'Kim',
  'Mitsuneko',
  'Frost',
  'Gopher',
  'Thomas',
  'Nicole',
  'Jimmy',
  'Johnny',
  'Nick'
);

$surname = array(
  'Simpson',
  'Baelish',
  'Farring',
  'Estren',
  'Potter',
  'Snow',
  'Steelhammer',
  'Lowcloud',
  'Heartforge',
  'Leafarm',
  'Whisperspell',
  'Noblesword',
  'Stormfury',
  'Foursnow',
  'Grassglide',
  'Sagearrow',
  'Stonetoe',
  'Darkswallow',
  'Elfsong'
);


$file = fopen('output.csv', 'w');

fputcsv($file, $headers);
$Users = array();

//creates users with unique id
for ($id = 1; $id < $number + 1; $id++) {
  ini_set('memory_limit', '-1');

  //randomize name and surname
  $randomName = $name[array_rand($name)];
  $randomSurname = $surname[array_rand($surname)];

  $randomDate = mt_rand(1, time());
  $date = date("d/m/Y", $randomDate);
  $randomYear = date("Y", $randomDate);
  $year = date('Y');
  $age = $year - $randomYear;

  // User initials
  $initials = substr($randomName, 0, 1);

  array_push($Users, array("id" => $id, "name" => $randomName, "surname" => $randomSurname, "initials" => $initials, "age" => $age, "DateOfBirth" => $date));
}
//pushes data into the csv
foreach ($Users as $fields) {
  fputcsv($file, $fields, ",");
}
fclose($file);
