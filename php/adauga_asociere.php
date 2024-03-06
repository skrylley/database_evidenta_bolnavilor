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

    $id_bolnav = $_POST['id_bolnav'];
    $id_tratament = $_POST['id_tratament'];
    $id_medicamente = $_POST['id_medicamente'];
    $data_inceput = $_POST['data_inceput'];
    $data_sfarsit = $_POST['data_sfarsit'];

    $sql = "INSERT INTO listabolnavi_listatratamente (id_bolnav, id_tratament, id_medicamente, data_inceput, data_sfarsit) 
            VALUES ('$id_bolnav', '$id_tratament', '$id_medicamente', '$data_inceput', '$data_sfarsit')";

    if ($conn->query($sql) === TRUE) {
        echo "Asocierea a fost efectuată cu succes!";
    } else {
        echo "Eroare: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    ?>
