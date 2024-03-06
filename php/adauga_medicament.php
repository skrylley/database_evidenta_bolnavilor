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
$concentratie = $_POST['concentratie'];

$sql = "INSERT INTO listamedicamente (denumire, concentratie) 
        VALUES ('$denumire', '$concentratie')";

if ($conn->query($sql) === TRUE) {
    echo "Medicamentul a fost adăugat cu succes!";
} else {
    echo "Eroare: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
