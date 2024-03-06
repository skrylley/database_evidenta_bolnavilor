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

$sqlMedicamente = "SELECT id_medicamente AS id_medicamente, denumire AS denumire, CONCAT(denumire, ' ', concentratie, ' mg') AS nume_medicament FROM listamedicamente";
$resultMedicamente = $conn->query($sqlMedicamente);

$options = "";
while ($medicament = $resultMedicamente->fetch_assoc()) {
    $options .= "<option value='" . $medicament['denumire'] . "'>" . $medicament['nume_medicament'] . "</option>";
}

$conn->close();

echo $options;
?>
