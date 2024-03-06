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

$detalii = $_POST['detalii'];

$sql = "INSERT INTO tratamente (detalii) 
        VALUES ('$detalii')";

if ($conn->query($sql) === TRUE) {
    echo "Tratamentul a fost adăugat cu succes!";
} else {
    echo "Eroare: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
