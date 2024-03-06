<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$database = "evidentabolnavi";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexiune eșuată: " . $conn->connect_error);
}

$sqlMedici = "SELECT id_medicfam, CONCAT(nume, ' ', prenume) AS nume_medic FROM listamedicifamilie";
$resultMedici = $conn->query($sqlMedici);

$options = "";
while ($medic = $resultMedici->fetch_assoc()) {
    $options .= "<option value='" . $medic['id_medicfam'] . "'>" . $medic['nume_medic'] . "</option>";
}

$conn->close();

echo $options;
?>
