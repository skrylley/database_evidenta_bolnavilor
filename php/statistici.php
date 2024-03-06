




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="icon" type="image/x-icon" href="../img/icon1.png">
    <script type="text/javascript" src="js/functii.js"></script>
    <title>Pagina Principala</title>
</head>

<body>
    <div class="filter">

    </div>

    <div class="navbar">
            <img class="image2" src="../img/redcross2.gif" alt="Red Cross">
    </div>
    
                    <br><br><br><br>
                    <form class="form1" id="searchForm1" method="post">
                        <label for="input1">Denumire Medicament:</label>
                        <input type="date" name="input1" id="input1">
                        <button class="cautare" type="button" onclick="submitNestedForm1('searchForm1')">Căutare</button>
                    </form>


                    <form class="form1" id="searchForm2" method="post">
                        <label for="input2">Detalii Tratament:</label>
                        <input type="text" name="input2" id="input2">
                        <button class="cautare" type="button" onclick="submitNestedForm2('searchForm2')">Căutare</button>
                    </form>  


                    <form class="form1" id="searchForm3" method="post">
                        <label for="input3">Denumire Medicament:</label>
                        <input type="text" name="input3" id="input3">
                        <button class="cautare" type="button" onclick="submitNestedForm3('searchForm3')">Căutare</button>
                    </form>


                    <form class="form1" id="searchForm4" method="post">
                        <label for="input4">Detalii Tratament:</label>
                        <input type="text" name="input4" id="input4">
                        <button class="cautare" type="button" onclick="submitNestedForm4('searchForm4')">Căutare</button>
                    </form>  

                    <div class="tabel" id="rezultateCautare"></div>




<script>
        function submitNestedForm1(formId) {
            var formData = $('#' + 'searchForm1').serialize();

            $.ajax({
                type: 'POST',
                url: 'sqlcomplex1.php',
                data: formData,
                success: function(response) {
                    $('#rezultateCautare').html(response);
                }
            });
        }
        function submitNestedForm2(formId) {
            var formData = $('#' + 'searchForm2').serialize();

            $.ajax({
                type: 'POST',
                url: 'sqlcomplex2.php',
                data: formData,
                success: function(response) {
                    $('#rezultateCautare').html(response);
                }
            });
        }
        function submitNestedForm3(formId) {
            var formData = $('#' + 'searchForm3').serialize();

            $.ajax({
                type: 'POST',
                url: 'sqlcomplex3.php',
                data: formData,
                success: function(response) {
                    $('#rezultateCautare').html(response);
                }
            });
        }
        function submitNestedForm4(formId) {
            var formData = $('#' + 'searchForm4').serialize();

            $.ajax({
                type: 'POST',
                url: 'sqlcomplex4.php',
                data: formData,
                success: function(response) {
                    $('#rezultateCautare').html(response);
                }
            });
        }



        $('form').submit(function(event) {
            event.preventDefault();
        });
    </script>

</body>
</html>
