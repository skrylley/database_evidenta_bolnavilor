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

$denumire_cautare = isset($_POST['denumire_cautare']) ? $_POST['denumire_cautare'] : "";
$concentratie_cautare = isset($_POST['concentratie_cautare']) ? $_POST['concentratie_cautare'] : "";
$sql = "SELECT id_medicamente, denumire, concentratie
        FROM listamedicamente
        WHERE 1";

if (!empty($denumire_cautare)) {
    $sql .= " AND denumire LIKE '%$denumire_cautare%'";
}
if (!empty($concentratie_cautare)) {
    $sql .= " AND concentratie LIKE '%$concentratie_cautare%'";
}

$sql .= ";";



$result = $conn->query($sql);

echo "<link rel='stylesheet' type='text/css' href='../css/style.css'>";

echo "<h2>Rezultate Căutare Medicamente</h2>";

if ($result->num_rows > 0) {
    echo "<table>
        <tr>
        <th>Denumire</th>
        <th>Concentratie</th>
        <th class='blankrow'></th>
        <th class='buttonrow'>Edit</th>
        <th class='buttonrow'>Delete</th>
        </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>

                <td>" . $row["denumire"] . "</td>
                <td>" . $row["concentratie"] . "</td>
                <td></td>
                <td><button class='edit' onclick='editMedicament(" . $row["id_medicamente"] . ")'>Edit</button>
                <td><button class='delete' onclick='deleteMedicament(" . $row["id_medicamente"] . ")'>Delete</button></td>
                
            </tr>";
        }

    echo "</table>";
} else {
    echo "Nu există înregistrări care să corespundă criteriilor de căutare.";
}

$conn->close();
?>

<script>
    function deleteMedicament(id) {
        if (confirm("Sigur doriți să ștergeți acest medicament?")) {
            $.ajax({
                type: 'POST',
                url: 'php/delete_medicament.php',
                data: { id: id },
                success: function(response) {
                    alert(response);
                    submitNestedForm('searchForm');
                }
            });
        }
    }
    function editMedicament(idMedicament) {
    
    window.location.href = 'php/edit_medicament.php?id=' + idMedicament;
    
}
</script>