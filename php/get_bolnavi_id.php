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

$sqlBolnavi = "SELECT id_bolnav, CONCAT(nume, ' ', prenume, ' ', CNP) AS nume_bolnav FROM listabolnavi";
$resultBolnavi = $conn->query($sqlBolnavi);

$options = "";
while ($bolnav = $resultBolnavi->fetch_assoc()) {
    $options .= "<option value='" . $bolnav['id_bolnav'] . "'>" . $bolnav['nume_bolnav'] . "</option>";
}

$conn->close();

echo $options;
?>
