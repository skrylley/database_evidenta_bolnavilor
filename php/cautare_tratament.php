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

$detalii_cautare = isset($_POST['detalii_cautare']) ? $_POST['detalii_cautare'] : "";
$sql = "SELECT id_tratament, detalii
        FROM tratamente
        WHERE 1";

if (!empty($detalii_cautare)) {
    $sql .= " AND detalii LIKE '%$detalii_cautare%'";
}

$sql .= ";";


$result = $conn->query($sql);

echo "<link rel='stylesheet' type='text/css' href='../css/style.css'>";

echo "<h2>Rezultate Căutare Tratamente</h2>";

if ($result->num_rows > 0) {
    echo "<table>
        <tr>
        <th>Detalii</th>
        <th class='blankrow'></th>
        <th class='buttonrow'>Delete</th>
        </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>" . $row["detalii"] . "</td>
                <td></td>
                <td><button class='delete' onclick='deleteTratament(" . $row["id_tratament"] . ")'>Delete</button></td>
                
            </tr>";
        }

    echo "</table>";
} else {
    echo "Nu există înregistrări care să corespundă criteriilor de căutare.";
}

$conn->close();
?>

<script>
    function deleteTratament(id) {
        if (confirm("Sigur doriți să ștergeți acest tratament?")) {
            $.ajax({
                type: 'POST',
                url: 'php/delete_tratament.php',
                data: { id: id },
                success: function(response) {
                    alert(response);
                    submitNestedForm('searchForm');
                }
            });
        }
    }
</script>