// Fonction pour créer un cookie
function setCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000)); // Durée en jours
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

// Fonction pour récupérer un cookie
function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

// Fonction pour supprimer un cookie
function eraseCookie(name) {   
    document.cookie = name + '=; Max-Age=-99999999;';  
}

// Exemple d'utilisation
setCookie("monCookie", "valeurDuCookie", 7);  // Crée un cookie
console.log(getCookie("monCookie"));          // Récupère et affiche la valeur du cookie
eraseCookie("monCookie");                     // Supprime le cookie
