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

$input1 = isset($_POST['input1']) ? $_POST['input1'] : "";


$sql = "SELECT m.id_medicfam, m.nume AS nume_medic, m.prenume AS prenume_medic
        FROM listamedicifamilie m
        JOIN listabolnavi lb ON m.id_medicfam = lb.id_medicfam
        JOIN listabolnavi b ON lb.id_bolnav = b.id_bolnav
        WHERE b.dataNastere > $input1
        GROUP BY m.id_medicfam, m.nume, m.prenume
        HAVING COUNT(b.id_bolnav) = (SELECT COUNT(*) FROM listabolnavi WHERE dataNastere > $input1)";


$result = $conn->query($sql);

echo "<h2>Rezultate Căutare</h2>";

if ($result->num_rows > 0) {
    echo "<table>
        <tr>
        <th>Nume</th>
        <th>Prenume</th>
        </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>" . $row["nume_medic"] . "</td>
                <td>" . $row["prenume_medic"] . "</td>
            </tr>";
        }

    echo "</table>";
} else {
    echo "Nu există înregistrări care să corespundă criteriilor de căutare.";
}

$conn->close();
?>

<script>

</script>
