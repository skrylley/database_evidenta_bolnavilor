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

$nume_cautare = isset($_POST['nume_cautare']) ? $_POST['nume_cautare'] : "";
$prenume_cautare = isset($_POST['prenume_cautare']) ? $_POST['prenume_cautare'] : "";
$cabinet_cautare = isset($_POST['cabinet_cautare']) ? $_POST['cabinet_cautare'] : "";
$telefon_cautare = isset($_POST['telefon_cautare']) ? $_POST['telefon_cautare'] : "";

$sql = "SELECT id_medicfam, nume, prenume, cabinet, telefon 
        FROM listamedicifamilie
        WHERE 1";

if (!empty($nume_cautare)) {
    $sql .= " AND nume LIKE '%$nume_cautare%'";
}
if (!empty($prenume_cautare)) {
    $sql .= " AND prenume LIKE '%$prenume_cautare%'";
}
if (!empty($cabinet_cautare)) {
    $sql .= " AND cabinet LIKE '%$cabinet_cautare%'";
}
if (!empty($telefon_cautare)) {
    $sql .= " AND telefon LIKE '%$telefon_cautare%'";
}

$sql .= ";";

$result = $conn->query($sql);

echo "<link rel='stylesheet' type='text/css' href='../css/style.css'>";

echo "<h2>Rezultate Căutare Medici</h2>";

if ($result->num_rows > 0) {
    echo "<table>
        <tr>
        <th>Nume</th>
        <th>Prenume</th>
        <th>Cabinet</th>
        <th>Telefon</th>
        <th class='blankrow'></th>
        <th class='buttonrow'>Delete</th>
        </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>" . $row["nume"] . "</td>
                <td>" . $row["prenume"] . "</td>
                <td>" . $row["cabinet"] . "</td>
                <td>" . $row["telefon"] . "</td>
                <td></td>
                <td><button class='delete' onclick='deleteMedic(" . $row["id_medicfam"] . ")'>Delete</button></td>
            </tr>";
        }

    echo "</table>";
} else {
    echo "Nu există înregistrări care să corespundă criteriilor de căutare.";
}

$conn->close();
?>

<script>
    function deleteMedic(id) {
        if (confirm("Sigur doriți să ștergeți acest medic?")) {
            $.ajax({
                type: 'POST',
                url: 'php/delete_medic.php',
                data: { id: id },
                success: function(response) {
                    alert(response);
                    submitNestedForm('searchForm');
                }
            });
        }
    }
</script>