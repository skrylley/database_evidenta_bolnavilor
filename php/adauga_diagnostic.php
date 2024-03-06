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

$denumire = $_POST['denumire'];
$detalii = $_POST['detalii'];

$sql = "INSERT INTO diagnostic (denumire, detalii) 
        VALUES ('$denumire', '$detalii')";

if ($conn->query($sql) === TRUE) {
    echo "Diagnosticul a fost adăugat cu succes!";
} else {
    echo "Eroare: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
