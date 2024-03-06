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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nume = $_POST['nume'];
    $prenume = $_POST['prenume'];
    $CNP = $_POST['CNP'];
    $sex = $_POST['sex'];
    $dataNastere = date('Y-m-d', strtotime($_POST['dataNastere']));
    $telefon = $_POST['telefon'];
    $strada = $_POST['strada'];
    $numar = $_POST['numar'];
    $oras = $_POST['oras'];
    $judet = $_POST['judet'];
    $id_medicfam = $_POST['medic'];
    $id_diagnostic = $_POST['diagnostic'];
    
    $sql = "INSERT INTO listaBolnavi (nume, prenume, CNP, sex, dataNastere, telefon, strada, numar, oras, judet, id_medicfam, id_diagnostic) 
            VALUES ('$nume', '$prenume', '$CNP', '$sex', '$dataNastere', '$telefon', '$strada', '$numar', '$oras', '$judet', '$id_medicfam', '$id_diagnostic')";

    if ($conn->query($sql) === TRUE) {
        echo "Înregistrarea a fost adăugată cu succes!";
    } else {
        echo "Eroare: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
