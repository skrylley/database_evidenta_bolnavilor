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
    $id_diagnostic = $_POST['id'];

    $sql = "DELETE FROM diagnostic WHERE id_diagnostic = $id_diagnostic";

    if ($conn->query($sql) === TRUE) {
        echo "Diagnosticul a fost șters cu succes!";
    } else {
        echo "Eroare la ștergere: " . $conn->error;
    }
} else {
    echo "ID invalid pentru ștergere.";
}

$conn->close();
?>
