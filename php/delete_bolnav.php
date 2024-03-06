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

if (isset($_POST['id'])) {
    $id_bolnav = $_POST['id'];

    $sql = "DELETE FROM listaBolnavi WHERE id_bolnav = $id_bolnav";

    if ($conn->query($sql) === TRUE) {
        echo "Bolnavul a fost șters cu succes!";
    } else {
        echo "Eroare la ștergere: " . $conn->error;
    }
} else {
    echo "ID invalid pentru ștergere.";
}

$conn->close();
?>
