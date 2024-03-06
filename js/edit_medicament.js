$(document).ready(function() {
    // Sterge bolnav
    function stergeBolnav() {

        console.log('Bolnav șters');
    }

    // Salvare modificari
    function salveazaModificari() {
        console.log('Modificări salvate');
    }

    // Event listener pentru butonul de stergere
    $('#stergeBolnavBtn').click(function() {
        stergeBolnav();
    });

    // Event listener pentru butonul de salvare modificari
    $('#salveazaModificariBtn').click(function() {
        salveazaModificari();
    });
});
