
// masque et copiers le comptes des utilisateurs

function crakUrl() {
    // Récupérer l'URL actuelle
    var urlActuelle = window.location.href;

    // Séparer l'URL de base et les paramètres
    var urlParts = urlActuelle.split('?');
    var baseUrl = urlParts[0];
    var params = urlParts[1];

    // Si des paramètres existent, les encoder
    if (params) {
        // Encoder les paramètres en Base64
        var encodedParams = btoa(params);

        // Construire l'URL masquée
        var urlEncodee = baseUrl + '?params=' + encodedParams;
    } else {
        // Si pas de paramètres, utiliser simplement l'URL de base
        var urlEncodee = baseUrl;
    }
    return urlEncodee;
}

// recuprer le lien lasque pour l'afficher;
document.addEventListener('DOMContentLoaded', function () {
    const myLink = crakUrl()
    document.querySelector(".link").textContent = myLink;
});

function copyLink() {
    var urlEncodee = crakUrl();

    // Créer un élément temporaire pour copier l'URL
    var inputTemp = document.createElement('input');
    inputTemp.value = urlEncodee;
    document.body.appendChild(inputTemp);
    // Sélectionner le texte dans le champ de texte
    inputTemp.select();
    inputTemp.setSelectionRange(0, 99999); // Pour les appareils mobiles

    // Copier le texte dans le presse-papier
    document.execCommand("copy");
    document.body.removeChild(inputTemp);

}




let offset = 0;
var limit = 20;
const container = document.getElementById('allcard_content');
const loading = document.getElementById('loading');
var idUsing = getQueryParameter('id_using');
loading.style.display = 'none';

function fetchVideos() {
    loading.style.display = 'block';
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `../async/userasync/stvideosax.php?idusing=${idUsing}offset=${offset}&limit=${limit}`, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const videos = JSON.parse(xhr.responseText);
            videos.forEach(video => {
                const videoDiv = document.createElement('div');
                videoDiv.classList.add('card_content');
                videoDiv.innerHTML = `
                    <a href="${video.idStream}">
                        <video src="${video.stream}" poster="${video.couver}" class="vid_extrait" id="vid_plays"></video>
                    </a>
                    <a href=""></a>
                    <p href="" class="card_tr">
                        <a href="">${video.titre}</a>
                    </p>`;
                container.appendChild(videoDiv);
                autoplaysvidx();
            });
            offset += limit;
            loading.style.display = 'none';
        }
    };
    xhr.send();
}

function checkScroll() {
    if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
        fetchVideos();
    }
}

window.addEventListener('scroll', checkScroll);
document.addEventListener('DOMContentLoaded', fetchVideos);


function getQueryParameter(name) {
    var urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(name);
}






// plys shot text videos
function autoplaysvidx() {
    const outplay = document.querySelectorAll('#vid_plays');


    outplay.forEach(function (vidplay) {
        // var timesInit = new Date().getTime();
        var timesout;
        vidplay.addEventListener('mouseover', function () {
        vidplay.volume = 0.15;
        timesout = setTimeout(function() {
            vidplay.play();
            vidplay.setAttribute("controls", "true");
            }, 3000);
        });
        
        vidplay.addEventListener("mouseout", function () {
            vidplay.removeAttribute("controls");
            vidplay.pause();
            clearTimeout(timesout);
        });
        
    });   
    
}

// getion des abonnerments
function axAbnSysteme() {
    
    const btnAbn = document.querySelector('.syblx_abnx');
    const AbnForm = document.querySelector('#Abn');

    const formData = new FormData(AbnForm);
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var respx = xhr.response;
            if (respx.success) {
               console.log(respx.echec);
               btnAbn.value = respx.change;
               conteursAbn();
            } else {
                console.log(respx.echec);
                
            }
        } else if (xhr.readyState == 4) {
            console.log("Une erreur s'est produite au niveau du serveur");
        }
    };

    xhr.open('POST', `../async/axabnsysteme.php`, true);
    xhr.responseType = "json";
    xhr.send(formData);
}


// conteures des abnonner
function conteursAbn() {
    // Sélectionner l'élément et récupérer sa valeur
    const idUsing = document.querySelector('.idusing').value;
    const countAbn = document.querySelector('.coneteursabn');

    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                const respx = xhr.response;
                if (respx.success) {
                    console.log(respx.error); // Remplacer 'echec' par 'message' pour les succès
                    countAbn.textContent = respx.change;
                } else {
                    console.log(respx.error); // Afficher le message d'erreur si l'opération échoue
                }
            } else {
                console.log("Une erreur s'est produite au niveau du serveur");
            }
        }
    };

    // Assurez-vous d'envoyer la valeur de l'élément et non l'objet lui-même
    xhr.open('GET', `../async/axcountabn.php?idusing=${idUsing}`, true);
    xhr.responseType = "json";
    xhr.send();
}

document.addEventListener('DOMContentLoaded', conteursAbn);





