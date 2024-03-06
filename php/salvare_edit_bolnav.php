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
    $idBolnav = $_GET['id'];

    $nume = isset($_POST['nume']) ? $_POST['nume'] : "";
    $prenume = isset($_POST['prenume']) ? $_POST['prenume'] : "";
    $CNP = isset($_POST['CNP']) ? $_POST['CNP'] : "";
    $sex = isset($_POST['sex']) ? $_POST['sex'] : "";
    $dataNastere = isset($_POST['dataNastere']) ? $_POST['dataNastere'] : "";
    $telefon = isset($_POST['telefon']) ? $_POST['telefon'] : "";
    $strada = isset($_POST['strada']) ? $_POST['strada'] : "";
    $numar = isset($_POST['numar']) ? $_POST['numar'] : "";
    $oras = isset($_POST['oras']) ? $_POST['oras'] : "";
    $judet = isset($_POST['judet']) ? $_POST['judet'] : "";
    
    $id_medicfam = isset($_POST['id_medicfam']) ? $_POST['id_medicfam'] : "";
    $id_diagnostic = isset($_POST['id_diagnostic']) ? $_POST['id_diagnostic'] : "";


    $sql = "UPDATE listaBolnavi 
            SET nume='$nume', prenume='$prenume', CNP='$CNP', sex='$sex', dataNastere='$dataNastere', 
                telefon='$telefon', strada='$strada', numar='$numar', oras='$oras', judet='$judet', 
                id_medicfam='$id_medicfam', id_diagnostic='$id_diagnostic'
            WHERE id_bolnav=$idBolnav";
            
    
    if ($conn->query($sql) === TRUE) {
        echo "Modificările au fost salvate cu succes!";
    } else {
        echo "Eroare la salvarea modificărilor: " . $conn->error;
    }
} else {
    echo "Medicul specificat nu există în bază de date.";
}

$conn->close();
?>
