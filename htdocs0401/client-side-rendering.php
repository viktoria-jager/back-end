<?php

$conn = new mysqli("localhost", "root", "", "tarskereso");
$sql2 = "SELECT nev, nem FROM felhasznalok where user_id = 1 ";
$stmt2 = $conn->prepare($sql2);
$stmt2->execute();
$result = $stmt2->get_result();
$data = $result->fetch_assoc();

echo json_encode($data);


?>