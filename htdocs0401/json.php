<?php

$verda = 
    [
        'marka'=>'Maserati',
        'index'=>'orange',
        'tipus'=>'X6',
        'tulajok'=>["Tóni", "Tamás", "Viki"]
    ];


$verdak_string = json_encode($verda);

$conn = new mysqli("localhost", "root", "", "tarskereso");

$sql = "UPDATE felhasznalok SET 
    profilkep =  ?
    WHERE user_id = '1'"; 

$stmt = $conn->prepare($sql);

$stmt->bind_param("s", $verdak_string);

$stmt->execute();



$sql2 = "SELECT profilkep FROM felhasznalok where user_id = ? ";

$stmt2 = $conn->prepare($sql2);

$id = 1; 
$stmt2->bind_param("i", $id);

$stmt2->execute();

$result = $stmt2->get_result();

$data = $result->fetch_assoc();


echo $data['profilkep'];
?>