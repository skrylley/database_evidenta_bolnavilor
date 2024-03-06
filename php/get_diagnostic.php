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

$sqlDiagnostic = "SELECT id_diagnostic, CONCAT(denumire, ' ', detalii) AS denumire FROM diagnostic";
$resultDiagnostic = $conn->query($sqlDiagnostic);

$options = "";
while ($diagnostic = $resultDiagnostic->fetch_assoc()) {
    $options .= "<option value='" . $diagnostic['id_diagnostic'] . "'>" . $diagnostic['denumire'] . "</option>";
}

$conn->close();

echo $options;
?>