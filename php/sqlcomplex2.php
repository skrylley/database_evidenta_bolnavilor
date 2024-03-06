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

$input2 = isset($_POST['input1']) ? $_POST['input1'] : "";


$sql = "SELECT lb.listabolnavi, m.nume AS nume_bolnav, m.prenume AS prenume_bolnav
        FROM listamedicifamilie m
        JOIN med ON m.id_medicamente = med.id_medicamente
        JOIN listabolnavi b ON m.id_medicfam = b.id_medicfam
        WHERE med.concentratie > $input2
        GROUP BY m.id_medicfam, m.nume, m.prenume, lb.listabolnavi
        HAVING COUNT(b.id_bolnav) = (SELECT COUNT(*) FROM listabolnavi WHERE med.concentratie > $input2)";

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
                <td>" . $row["nume_bolnav"] . "</td>
                <td>" . $row["prenume_bolnav"] . "</td>
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
