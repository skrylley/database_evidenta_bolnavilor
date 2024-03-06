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

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $idMedicament = $_GET['id'];

    $denumire = isset($_POST['denumire']) ? $_POST['denumire'] : "";
    $concentratie = isset($_POST['concentratie']) ? $_POST['concentratie'] : "";


    $sql = "UPDATE listamedicamente 
            SET denumire='$denumire', concentratie='$concentratie'
            WHERE id_medicamente=$idMedicament";
            
    
    if ($conn->query($sql) === TRUE) {
        echo "Modificările au fost salvate cu succes!";
    } else {
        echo "Eroare la salvarea modificărilor: " . $conn->error;
    }
} else {
    echo "Medicamentul specificat nu există în bază de date.";
}

$conn->close();
?>
