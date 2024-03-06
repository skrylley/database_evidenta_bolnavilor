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

$sqlTratamente = "SELECT id_tratament, detalii FROM tratamente";
$resultTratamente = $conn->query($sqlTratamente);

$options = "";
while ($tratament = $resultTratamente->fetch_assoc()) {
    $options .= "<option value='" . $tratament['id_tratament'] . "'>" . $tratament['detalii'] . "</option>";
}

$conn->close();

echo $options;
?>
