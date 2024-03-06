<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "evidentabolnavi";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexiune eșuată: " . $conn->connect_error);
}

$sql = "SELECT * FROM listaBolnavi";
$result = $conn->query($sql);

echo "<link rel='stylesheet' type='text/css' href='style.css'>";

echo "<h2>Lista Bolnavilor</h2>";

if ($result->num_rows > 0) {
    echo "<table>
    <tr>
    <th>ID</th>
    <th>Nume</th>
    <th>Prenume</th>
    <th>CNP</th>
    <th>Sex</th>
    <th>Data Nasterii</th>
    <th>Telefon</th>
    <th>Strada</th>
    <th>Numar</th>
    <th>Oras</th>
    <th>Judet</th>
    </tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>".$row["id_Bolnav"]."</td>
        <td>".$row["nume"]."</td>
        <td>".$row["prenume"]."</td>
        <td>".$row["CNP"]."</td>
        <td>".$row["sex"]."</td>
        <td>".$row["dataNasterii"]."</td>
        <td>".$row["telefon"]."</td>
        <td>".$row["strada"]."</td>
        <td>".$row["numar"]."</td>
        <td>".$row["oras"]."</td>
        <td>".$row["judet"]."</td>
        </tr>";
    }

    echo "</table>";
} else {
    echo "Nu există înregistrări în baza de date.";
}

$conn->close();
?>
