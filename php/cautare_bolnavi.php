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
$cnp_cautare = isset($_POST['cnp_cautare']) ? $_POST['cnp_cautare'] : "";
$telefon_cautare = isset($_POST['telefon_cautare']) ? $_POST['telefon_cautare'] : "";
$nume_medic_cautare = isset($_POST['nume_medic_cautare']) ? $_POST['nume_medic_cautare'] : "";
echo $nume_medic_cautare;
$sql = "SELECT b.*, m.nume AS nume_medic, m.prenume AS prenume_medic, d.* 
        FROM listaBolnavi AS b
        LEFT JOIN listamedicifamilie AS m ON b.id_medicfam = m.id_medicfam
        LEFT JOIN diagnostic AS d ON b.id_diagnostic = d.id_diagnostic
        WHERE 1";


if (!empty($nume_cautare)) {
    $sql .= " AND b.nume LIKE '%$nume_cautare%'";
}
if (!empty($prenume_cautare)) {
    $sql .= " AND b.prenume LIKE '%$prenume_cautare%'";
}
if (!empty($cnp_cautare)) {
    $sql .= " AND b.CNP LIKE '%$cnp_cautare%'";
}
if (!empty($telefon_cautare)) {
    $sql .= " AND b.telefon LIKE '%$telefon_cautare%'";
}
if (!empty($nume_medic_cautare)) {
    $sql .= " AND m.id_medicfam LIKE '%$nume_medic_cautare%'";
}
$result = $conn->query($sql);

echo "<link rel='stylesheet' type='text/css' href='../css/style.css'>";

echo "<h2>Rezultate Căutare Bolnavi</h2>";

if ($result->num_rows > 0) {
    echo "<table>
        <tr>
        <th>Nume</th>
        <th>Prenume</th>
        <th>CNP</th>
        <th>Sex</th>
        <th>Data_Nasterii</th>
        <th>Telefon</th>
        <th>Strada</th>
        <th>Numar</th>
        <th>Oras</th>
        <th>Judet</th>
        <th>Nume_Medic</th>
        <th>Prenume_Medic</th>
        <th>Diagnostic</th>
        <th class='blankrow'></th>
        <th class='buttonrow'>Edit</th>
        <th class='buttonrow'>Delete</th>
        </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>" . $row["nume"] . "</td>
                <td>" . $row["prenume"] . "</td>
                <td>" . $row["CNP"] . "</td>
                <td>" . $row["sex"] . "</td>
                <td>" . (isset($row["dataNastere"]) ? $row["dataNastere"] : 'Data lipsă') . "</td>
                <td>" . $row["telefon"] . "</td>
                <td>" . $row["strada"] . "</td>
                <td>" . $row["numar"] . "</td>
                <td>" . $row["oras"] . "</td>
                <td>" . $row["judet"] . "</td>
                <td>" . $row["nume_medic"] . "</td>
                <td>" . $row["prenume_medic"] . "</td>
                <td>" . $row["denumire"] . "</td>
                <td></td>
                <td><button class='edit' onclick='editBolnav(" . $row["id_bolnav"] . ")'>Edit</button></td>
                <td><button class='delete' onclick='deleteBolnav(" . $row["id_bolnav"] . ")'>Delete</button></td>
            </tr>";
        }

    echo "</table>";
} else {
    echo "Nu există înregistrări care să corespundă criteriilor de căutare.";
}

$conn->close();
?>

<script>
    function deleteBolnav(id) {
        if (confirm("Sigur doriți să ștergeți acest bolnav?")) {
            $.ajax({
                type: 'POST',
                url: 'php/delete_bolnav.php',
                data: { id: id },
                success: function(response) {
                    alert(response);
                    submitNestedForm('searchForm');
                }
            });
        }
    }
</script>
