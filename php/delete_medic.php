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
    $id_medicfam = $_POST['id'];

    $sql = "DELETE FROM listamedicifamilie WHERE id_medicfam = $id_medicfam";

    if ($conn->query($sql) === TRUE) {
        echo "Medicul a fost anulat cu succes!";
    } else {
        echo "Eroare la ștergere: " . $conn->error;
    }
} else {
    echo "ID invalid pentru ștergere.";
}

$conn->close();
?>
