<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>



<?php

$conn = new mysqli("localhost", "root", "", "tarskereso");
$sql2 = "SELECT * FROM felhasznalok where user_id = 1 ";
$stmt2 = $conn->prepare($sql2);
$stmt2->execute();
$result = $stmt2->get_result();
$data = $result->fetch_assoc();



?>


<h1><?= $data['nev'] ?></h1>
<h1><?= $data['nem'] ?></h1>




    
</body>
</html>