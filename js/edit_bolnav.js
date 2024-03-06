$(document).ready(function() {
    // Apelată când pagina este încărcată complet

    // Implementează funcționalitatea de ștergere bolnav
    function stergeBolnav() {
        // Adaugă codul pentru ștergere
        // Puteți utiliza AJAX pentru a trimite o cerere către server pentru ștergere
        console.log('Bolnav șters');
    }

    // Implementează funcționalitatea de salvare modificări
    function salveazaModificari() {
        // Adaugă codul pentru salvare modificări
        // Puteți utiliza AJAX pentru a trimite datele către server pentru salvare
        console.log('Modificări salvate');
    }

    // Event listener pentru butonul de ștergere
    $('#stergeBolnavBtn').click(function() {
        stergeBolnav();
    });

    // Event listener pentru butonul de salvare modificări
    $('#salveazaModificariBtn').click(function() {
        salveazaModificari();
    });
});
