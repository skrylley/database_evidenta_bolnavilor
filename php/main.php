<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "nume_baza_de_date";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexiune eșuată: " . $conn->connect_error);
}

$sql = "SELECT * FROM tabel_exemplu LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<p>ID: " . $row["id"] . "<br>Nume: " . $row["nume"] . "<br>Prenume: " . $row["prenume"] . "</p>";
    }
} else {
    echo "Nu s-au găsit rezultate în tabel.";
}

$conn->close();
?>
