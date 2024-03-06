function playYouTubeVideo() {
    // De sters pana la prezentare sper sa nu uit
    var videoId = 'xeN4A_Pr2SU';
    var embedUrl = 'https://www.youtube.com/embed/' + videoId + '?autoplay=1';
    window.open(embedUrl);
}

function editBolnav(idBolnav) {
    // Deschide pagina de editare cu ID-ul bolnavului
    window.location.href = '../php/edit_bolnav.php?id=' + idBolnav;
    //window.location.href = 'edit_bolnav.html';
}


function editMedicament(idMedicament) {
    
    window.location.href = '../php/edit_medicament.php?id=' + idMedicament;
    
}

