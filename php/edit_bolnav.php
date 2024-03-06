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

    $sql = "SELECT * FROM listaBolnavi WHERE id_bolnav = $idBolnav";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $bolnav = $result->fetch_assoc();

        $sqlMedici = "SELECT id_medicfam, nume, prenume FROM listamedicifamilie";
        $resultMedici = $conn->query($sqlMedici);
        $sqlDiagnostic = "SELECT id_diagnostic, denumire FROM diagnostic";
        $resultDiagnostic = $conn->query($sqlDiagnostic);
        ?>
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <link rel='stylesheet' type='text/css' href='../css/style.css' />
            <link rel='icon' type='image/x-icon' href='../img/redcross2.gif'>
            <script type="text/javascript" src="../js/functii.js"></script>
            <title>Editare Bolnav</title>
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
                            
                                <label for='nume'>Nume:</label>
                                <input type='text' name='nume' value='<?php echo $bolnav['nume']; ?>' required>

                                <label for='prenume'>Prenume:</label>
                                <input type='text' name='prenume' value='<?php echo $bolnav['prenume']; ?>' required>

                                <label for='CNP'>CNP:</label>
                                <input type='text' name='CNP' value='<?php echo $bolnav['CNP']; ?>' readonly>

                                <label for='sex'>Sex:</label>
                                <select name='sex' required>
                                    <option value='M' <?php echo ($bolnav['sex'] === 'M' ? 'selected' : ''); ?>>Masculin</option>
                                    <option value='F' <?php echo ($bolnav['sex'] === 'F' ? 'selected' : ''); ?>>Feminin</option>
                                </select>

                                <label for='dataNastere'>Data Nasterii:</label>
                                <input type='date' name='dataNastere' value='<?php echo $bolnav['dataNastere']; ?>' required>

                                <label for='id_medicfam'>Medic:</label>
                                <select name='id_medicfam' required>
                                    <option value=''>Alegeți un medic</option>
                                    <?php
                                    while ($medic = $resultMedici->fetch_assoc()) {
                                        echo "<option value='" . $medic['id_medicfam'] . "' " . ($bolnav['id_medicfam'] == $medic['id_medicfam'] ? 'selected' : '') . ">" . $medic['nume'] . " " . $medic['prenume'] . "</option>";
                                    }
                                    ?>
                                </select>



                               
                        </div>

                        <div class="col2">

                                <label for='telefon'>Telefon:</label>
                                <input type='text' name='telefon' value='<?php echo $bolnav['telefon']; ?>' required>

                                <label for='strada'>Strada:</label>
                                <input type='text' name='strada' value='<?php echo $bolnav['strada']; ?>' required>

                                <label for='numar'>Numar:</label>
                                <input type='text' name='numar' value='<?php echo $bolnav['numar']; ?>' required>


                                <label for='oras'>Oras:</label>
                                <input type='text' name='oras' value='<?php echo $bolnav['oras']; ?>' required>

                                <label for='judet'>Judet:</label>
                                <input type='text' name='judet' value='<?php echo $bolnav['judet']; ?>' required>

                            

                            
                            <label for='id_diagnostic'>Diagnostic:</label>
                            <select name='id_diagnostic' required>
                                <option value=''>Alegeți un diagnostic</option>
                                <?php
                                while ($diagnostic = $resultDiagnostic->fetch_assoc()) {
                                    echo "<option value='" . $diagnostic['id_diagnostic'] . "' " . ($bolnav['id_diagnostic'] == $diagnostic['id_diagnostic'] ? 'selected' : '') . ">" . $diagnostic['denumire']  . "</option>";
                                }
                                ?>
                            </select>
                                    

                            <button class='cautare' type='button' onclick='submitForm()'>Salvare</button>

                        </div>
                    </form>
                </div>
            </div>

            <div class="element">
                <div class="textbox1">
                    <h1>Editare bolnav</h1>
                    <h3>modificati detaliile bolnavului</h3>
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
                        url: 'salvare_edit_bolnav.php?id=<?php echo $idBolnav; ?>',
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
        echo "Bolnavul cu ID-ul specificat nu a fost găsit.";
    }
} else {
    echo "ID invalid pentru bolnav.";
}

$conn->close();
?>
