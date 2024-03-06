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

$nume = $_POST['nume'];
$prenume = $_POST['prenume'];
$cabinet = $_POST['cabinet'];
$telefon = $_POST['telefon'];

$sql = "INSERT INTO listamedicifamilie (nume, prenume, cabinet, telefon) 
        VALUES ('$nume', '$prenume', '$cabinet', '$telefon')";

if ($conn->query($sql) === TRUE) {
    echo "Medicul a fost adăugat cu succes!";
} else {
    echo "Eroare: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
