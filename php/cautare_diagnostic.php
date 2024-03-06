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

$denumire = isset($_POST['denumire']) ? $_POST['denumire'] : "";
$detalii = isset($_POST['detalii']) ? $_POST['detalii'] : "";

$sql = "SELECT id_diagnostic, denumire, detalii
        FROM diagnostic
        WHERE 1";

if (!empty($denumire)) {
    $sql .= " AND denumire LIKE '%$denumire%'";
}
if (!empty($detalii)) {
    $sql .= " AND detalii LIKE '%$detalii%'";
}


$sql .= ";";


$result = $conn->query($sql);

echo "<link rel='stylesheet' type='text/css' href='../css/style.css'>";

echo "<h2>Rezultate Căutare Diagnostic</h2>";

if ($result->num_rows > 0) {
    echo "<table>
        <tr>
        <th>Denumire</th>
        <th class='bigrow'>Detalii</th>
        <th class='blankrow'></th>
        <th class='buttonrow'>Delete</th>
        </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>" . $row["denumire"] . "</td>
                <td>" . $row["detalii"] . "</td>
                <td></td>
                <td><button class='delete' onclick='deleteDiagnostic(" . $row["id_diagnostic"] . ")'>Delete</button></td>
            </tr>";
        }

    echo "</table>";
} else {
    echo "Nu există înregistrări care să corespundă criteriilor de căutare.";
}

$conn->close();
?>

<script>
    function deleteDiagnostic(id) {
        if (confirm("Sigur doriți să ștergeți acest diagnostic?")) {
            $.ajax({
                type: 'POST',
                url: 'php/delete_diagnostic.php',
                data: { id: id },
                success: function(response) {
                    alert(response);
                    submitNestedForm('searchForm');
                }
            });
        }
    }
</script>