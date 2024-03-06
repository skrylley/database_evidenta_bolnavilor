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
$tratament_cautare = isset($_POST['tratament_cautare']) ? $_POST['tratament_cautare'] : "";
$medicament_cautare = isset($_POST['medicament_cautare']) ? $_POST['medicament_cautare'] : "";


$id_bolnavcache = null; 
$id_tratamentcache = null;
$id_medicamentecache = null;

// Cauta id_bolnav
if (!empty($nume_cautare) || !empty($prenume_cautare)) {
    $sql_bolnav = "SELECT id_bolnav FROM listabolnavi WHERE ";
    if (!empty($nume_cautare)) {
        $sql_bolnav .= "nume LIKE '%$nume_cautare%' ";
    }
    if (!empty($prenume_cautare)) {
        $sql_bolnav .= (!empty($nume_cautare) ? "AND " : "") . "prenume LIKE '%$prenume_cautare%' ";
    }
    $sql_bolnav .= "LIMIT 1";

    $result_bolnav = $conn->query($sql_bolnav);

    if ($result_bolnav->num_rows > 0) {
        $row_bolnav = $result_bolnav->fetch_assoc();
        $id_bolnavcache = $row_bolnav['id_bolnav'];
    }
    
}

// Cauta id_tratament
if (!empty($tratament_cautare)) {
    $sql_tratament = "SELECT id_tratament FROM tratamente WHERE detalii LIKE '%$tratament_cautare%' LIMIT 1";
    $result_tratament = $conn->query($sql_tratament);

    if ($result_tratament->num_rows > 0) {
        $row_tratament = $result_tratament->fetch_assoc();
        $id_tratamentcache = $row_tratament['id_tratament'];
    }
}

// Cauta id_medicamente
if (!empty($medicament_cautare)) {
    $sql_medicamente = "SELECT id_medicamente FROM listamedicamente WHERE denumire LIKE '%$medicament_cautare%' LIMIT 1";
    $result_medicamente = $conn->query($sql_medicamente);

    if ($result_medicamente->num_rows > 0) {
        $row_medicamente = $result_medicamente->fetch_assoc();
        $id_medicamentecache = $row_medicamente['id_medicamente'];
    }
}

// Construiește interogarea SQL
$sql_associere = "SELECT lt.id_bolnav, lb.nume, lb.prenume, lb.CNP, lb.dataNastere, d.denumire AS diagnostic,
                        lt.data_inceput, lt.data_sfarsit, t.detalii AS tratament, m.denumire AS medicament, m.concentratie
                 FROM listabolnavi_listatratamente lt
                 LEFT JOIN listaBolnavi lb ON lt.id_bolnav = lb.id_bolnav
                 LEFT JOIN diagnostic d ON lb.id_diagnostic = d.id_diagnostic
                 LEFT JOIN tratamente t ON lt.id_tratament = t.id_tratament
                 LEFT JOIN listamedicamente m ON lt.id_medicamente = m.id_medicamente
                 WHERE 1";

if (!is_null($id_bolnavcache)) {
    $sql_associere .= " AND lt.id_bolnav = $id_bolnavcache";
}
if (!is_null($id_tratamentcache)) {
    $sql_associere .= " AND lt.id_tratament = $id_tratamentcache";
}
if (!is_null($id_medicamentecache)) {
    $sql_associere .= " AND lt.id_medicamente = $id_medicamentecache";
}

$result_associere = $conn->query($sql_associere);

echo "<link rel='stylesheet' type='text/css' href='../css/style.css'>";

echo "<h2>Rezultate Căutare Asociere</h2>";

if ($result_associere->num_rows > 0) {
    echo "<table>
        <tr>
        <th>Nume</th>
        <th>Prenume</th>
        <th>CNP</th>
        <th>Data_Nasterii</th>
        <th>Diagnostic</th>
        <th>Data_Inceput</th>
        <th>Data_Sfarsit</th>
        <th>Tratament</th>
        <th>Medicament</th>
        <th>Concentratie</th>
        <th class='blankrow'></th>
        
        <th class='buttonrow'>Delete</th>
        </tr>";

    while ($row_associere = $result_associere->fetch_assoc()) {
        echo "<tr>
            <td>" . $row_associere["nume"] . "</td>
            <td>" . $row_associere["prenume"] . "</td>
            <td>" . $row_associere["CNP"] . "</td>
            <td>" . (isset($row_associere["dataNastere"]) ? $row_associere["dataNastere"] : 'Data lipsă') . "</td>
            <td>" . $row_associere["diagnostic"] . "</td>
            <td>" . (isset($row_associere["data_inceput"]) ? $row_associere["data_inceput"] : 'Data lipsă') . "</td>
            <td>" . (isset($row_associere["data_sfarsit"]) ? $row_associere["data_sfarsit"] : 'Data lipsă') . "</td>
            <td>" . $row_associere["tratament"] . "</td>
            <td>" . $row_associere["medicament"] . "</td>
            <td>" . $row_associere["concentratie"] . "</td>
            <td></td>
            
            <td><button class='delete' onclick='deleteAsociere(" . $row_associere["id_bolnav"] . ")'>Delete</button></td>
        </tr>";
    }

    echo "</table>";
} else {
    echo "Nu există înregistrări care să corespundă criteriilor de căutare.";
}

$conn->close();
?>

<script>
    function deleteAsociere(id) {
        if (confirm("Sigur doriți să ștergeți această asociere?")) {
            $.ajax({
                type: 'POST',
                url: 'php/delete_asociere.php',
                data: { id: id },
                success: function(response) {
                    alert(response);
                    submitNestedForm('searchForm');
                }
            });
        }
    }
</script>