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
    $idMedicamente = $_GET['id'];

    $sql = "SELECT * FROM listamedicamente WHERE id_medicamente = $idMedicamente";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $medicament = $result->fetch_assoc();

        $sqlMedicamente = "SELECT id_medicamente, denumire, concentratie FROM listamedicamente";
        $resultMedicamente = $conn->query($sqlMedicamente);

        ?>
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <link rel='stylesheet' type='text/css' href='../css/style.css' />
            <link rel="icon" type="image/x-icon" href="../img/icon1.png">
            <script type="text/javascript" src="../js/functii.js"></script>
            <title>Editare Medicament</title>
        </head>
        <body>

        <div class="filter">
       
        </div>

        <div class="navbar">
            <a href="../">
                <img class="image2" src="../img/redcross2.gif" alt="Red Cross">
            </a>
            <div class="line">
                <a class='blueB' href="../bolnavCautare.html">Căutare Bolnav</a>
                <a class='blueB' href="../medicCautare.html">Căutare Medic</a>

                <a class='orangeB' href="../asociereCautare.html">Căutare Asociere</a>

                <a class='blueB' href="../diagnosticCautare.html">Căutare Diagnostic</a>
                <a class='blueB' href="../medtratCautare.html">Căutare Med. / Trat.</a>
            </div>
            <div class="line">
                <a class='blueB' href="../bolnavAdaugare.html">Adăugare Bolnav</a>
                <a class='blueB' href="../medicAdaugare.html">Adăugare Medic</a>

                <a class='orangeB' href="../asociereAdaugare.html">Adăugare Asociere</a>

                <a class='blueB' href="../diagnosticAdaugare.html">Adăugare Diagnostic</a>
                <a class='blueB' href="../medtratAdaugare.html">Adăugare Med. / Trat.</a>
            </div>
        </div>

        <div class="content">
        <div class="element">
            <div class="colFlex">
            <form id='editForm' method='post'>
                <div class="col2">
                    
                        <label for='denumire'>Denumire:</label>
                        <input type='text' name='denumire' value='<?php echo $medicament['denumire']; ?>' required>

                        
    
                    
                </div>

                <div class="col2">
                        
                <label for='concentratie'>Concentratie:</label>
                        <input type='text' name='concentratie' value='<?php echo $medicament['concentratie']; ?>' required>
                    <button class = 'cautare' type='button' onclick='submitForm()'>Salvare</button>

                </div>
                </form>
            </div>
        </div>

            <div class="element">
                <div class="textbox1">
                    <h1>Editare medicament</h1>
                    <h3>modificati detaliile medicamentului</h3>
                </div>
            </div>

        </div>
            
                    
            <script src='https://code.jquery.com/jquery-3.6.4.min.js'></script>
            <script type='text/javascript' src='../js/functii.js'></script>
            <script>
                function submitForm() {
                    var formData = $('#editForm').serialize();

                    $.ajax({
                        type: 'POST',
                        url: 'salvare_edit_medicament.php?id=<?php echo $idMedicamente; ?>',
                        data: formData,
                        success: function(response) {
                            alert(response);
                        }
                    });
                }
            </script>

        </body>
        </html>

        <?php
    } else {
        echo "Medicamentul cu ID-ul specificat nu a fost găsit.";
    }
} else {
    echo "ID invalid pentru medicament.";
}

$conn->close();
?>
