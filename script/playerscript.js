// les fonction du susteme dabpnements

const abn_valu11 = `<svg xmlns="http://www.w3.org/2000/svg" height="15" viewBox="0 -960 960 960" width="15" fill="#fff">
                            <path d="M500-482q29-32 44.5-73t15.5-85q0-44-15.5-85T500-798q60 8 100 53t40 105q0 60-40 105t-100 53Zm220 322v-120q0-36-16-68.5T662-406q51
                            18 94.5 46.5T800-280v120h-80Zm80-280v-80h-80v-80h80v-80h80v80h80v80h-80v80h-80Zm-480-40q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113
                            47t47 113q0 66-47 113t-113 47ZM0-160v-112q0-34 17.5-62.5T64-378q62-31 126-46.5T320-440q66 0 130 15.5T576-378q29 15 46.5 43.5T640-272v112H0Zm320-400q33
                            0 56.5-23.5T400-640q0-33-23.5-56.5T320-720q-33 0-56.5 23.5T240-640q0 33 23.5 56.5T320-560ZM80-240h480v-32q0-11-5.5-20T540-306q-54-27-109-40.5T320-360q-56 0-111
                                13.5T100-306q-9 5-14.5 14T80-272v32Zm240-400Zm0 400Z"/></svg>
                            <span> S'abonner </span>`;
const abn_valu00 = `<svg xmlns="http://www.w3.org/2000/svg" height="15" viewBox="0 -960 960 960" width="15" fill="#fff">
                            <path d="M500-482q29-32 44.5-73t15.5-85q0-44-15.5-85T500-798q60 8 100 53t40 105q0 60-40 105t-100 53Zm220
                            322v-120q0-36-16-68.5T662-406q51 18 94.5 46.5T800-280v120h-80Zm240-360H720v-80h240v80Zm-640 40q-66 
                            0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM0-160v-112q0-34 
                            17.5-62.5T64-378q62-31 126-46.5T320-440q66 0 130 15.5T576-378q29 15 46.5 43.5T640-272v112H0Zm320-400q33 
                            0 56.5-23.5T400-640q0-33-23.5-56.5T320-720q-33 0-56.5 23.5T240-640q0 33 
                            23.5 56.5T320-560ZM80-240h480v-32q0-11-5.5-20T540-306q-54-27-109-40.5T320-360q-56 
                            0-111 13.5T100-306q-9 5-14.5 14T80-272v32Zm240-400Zm0 400Z"/></svg>
                            <span>se desabonner</span>`;          



// getion des abonnerments
function axAbnSysteme() {
    
    var abn_btn = document.querySelector(".abn_btn");
    const abnForom = document.querySelector(".forom_abn");

    const formData = new FormData(abnForom);
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var respx = xhr.response;
            console.log(xhr.response);
            if (respx.success) {
               console.log(respx.echec);
               var abnType = respx.change;
               if (abnType == "Se desabonner") {
                abn_btn.innerHTML = abn_valu00;
               }else if (abnType == "S'abonner") {
                abn_btn.innerHTML = abn_valu11;
               } else {
                // vid abn_btn
               }
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
    const countAbn = document.querySelector('.st_prof_abn');

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

// document.addEventListener('DOMContentLoaded', conteursAbn);






function asyncAllLiking(valParam) {
    var valliked = valParam;
    const likeForm = document.querySelector(".st_cliking_content");
    const formDatax = new FormData(likeForm);
    formDatax.append("liked", valliked);

    const xhrx = new XMLHttpRequest();
    xhrx.onreadystatechange = function() {
        if (xhrx.readyState == 4 && xhrx.status == 200) {
            var respx = xhrx.response;
            console.log(xhrx.response);
            if (respx.success) {
                countAllLikingTrue();
                countAllLikingFalse(); 

            } else {    
                console.log(respx.success);
                console.log(respx.echec); 
            }
        } else if (xhrx.readyState == 4) {
            console.log("Une erreur s'est produite au niveau du serveur");
        }
    };

    xhrx.open('POST', `../async/axlikes.php`, true);
    xhrx.responseType = "json";
    xhrx.send(formDatax);
}


// count for thes like systeme
function countAllLikingTrue() {
    const valliked = 1;
    var contentLikeGood = document.querySelector('.st_nbr_good');

    const likeForm = document.querySelector(".st_cliking_content");
    const formDatax = new FormData(likeForm);
    formDatax.append("likType", valliked);
    

    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                const respx = xhr.response;
                if (respx.success) {
                    contentLikeGood.textContent = respx.NbnLike;
                    console.log(respx.NbnLike);  
                    
                } else {
                    console.log(respx.error); // Afficher le message d'erreur si l'opération échoue
                }
            } else {
                console.log("Une erreur s'est produite au niveau du serveur");
            }
        }
    };

    // Assurez-vous d'envoyer la valeur de l'élément et non l'objet lui-même
    xhr.open('POST', `../async/axcountlikes.php`, true);
    xhr.responseType = "json";
    xhr.send(formDatax);
}









function countAllLikingFalse() {
    const valliked = 0;
    var contentLikeBad = document.querySelector('.st_nbr_bad');

    const likeForm = document.querySelector(".st_cliking_content");
    const formDatax = new FormData(likeForm);
    formDatax.append("likType", valliked);
    

    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                const respx = xhr.response;
                if (respx.success) {
                    contentLikeBad.textContent = respx.NbnLike;
                    console.log(respx.NbnLike); 
                } else {
                    console.log(respx.error); // Afficher le message d'erreur si l'opération échoue
                }
            } else {
                console.log("Une erreur s'est produite au niveau du serveur");
            }
        }
    };

    // Assurez-vous d'envoyer la valeur de l'élément et non l'objet lui-même
    xhr.open('POST', `../async/axcountlikes.php`, true);
    xhr.responseType = "json";
    xhr.send(formDatax);
}




function conteneurSectionRax() {
    var contentRax = document.querySelector('.sections_visiteurs');
        contentRax.classList.toggle('modifrax');
}





const countEdAll = setInterval(() => {
    conteursAbn();
    countAllLikingTrue();
    countAllLikingFalse();
}, 300000);

document.addEventListener('DOMContentLoaded', clearInterval(countEdAll));



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
// setCookie("monCookie", "valeurDuCookie", 7);  // Crée un cookie
// console.log(getCookie("monCookie"));          // Récupère et affiche la valeur du cookie
// eraseCookie("monCookie");                     // Supprime le cookie


function changePlayerAll() {
    const vid1 = document.querySelector('.darkPlayer');
    const vid3 = document.querySelector('.lecteurHtml');
    vid1.pause();vid3.pause();

    const sellValues = document.querySelector('.selectyourplayer').value;
    setCookie("playCookie", sellValues, 7);
    onPlayer()
}
function onPlayer() {
    let dsLecteurs = document.querySelectorAll('#darkLecteurs');
    dsLecteurs.forEach(lecteurs => {
        lecteurs.style.display='none';
    });
    if (getCookie("playCookie")) {
        const pCookies = getCookie("playCookie");
        if (pCookies == "darkPlayer") {
            document.querySelector('#player-video-darkstream').style.display='flex';
        }else{
            document.querySelector('#player-video-darkstream').style.display='none';
        }
        
        document.querySelector('.'+pCookies).style.display='flex';
        
    }else{
        document.querySelector(".darkPlayer").style.display='flex';
    }
}

document.addEventListener('DOMContentLoaded', onPlayer());




// envoies des messages
const idStreamForm = document.querySelector(".id_stream").getAttribute('data-id_stream');
const idStreamUserForm = document.querySelector(".id_stream_user").getAttribute('data-id_stream_user');
function getComm() {
    const commForm = document.querySelector(".comm_form");
    const dataComForm = new FormData(commForm);
    dataComForm.append('id_stream', idStreamForm);
    dataComForm.append('id_stream_user', idStreamUserForm);

    const xhrxx = new XMLHttpRequest();
    xhrxx.onreadystatechange = function() {
        if (xhrxx.readyState === 4) {
            if (xhrxx.status === 200) {
                const respx = xhrxx.response;
                console.log(respx);
                if (respx.success) {
                    clearInterval(setCommtIntval);
                    setCmmtx();
                } else {
                    console.log(respx.echec); // Afficher le message d'erreur si l'opération échoue
                }
            } else {
                console.log("Une erreur s'est produite au niveau du serveur");
            }
            
        }
    };
    document.querySelector(".comm_message").value = "";
    // Assurez-vous d'envoyer la valeur de l'élément et non l'objet lui-même
    xhrxx.open('POST', `async/axgetcommentaires.php`, true);
    xhrxx.responseType = "json";
    xhrxx.send(dataComForm);

}
document.querySelector(".comm_form").addEventListener('submit', getComm);

// charger le formulaire pour repondres a un messages
function changeRepForom(idparams) {
    const contOfForom = `
                <form action="" class="comm_form resp" method="post">
                    <input type="text" name="comm_message" id="comm_message" placeholder="Saisire Un Commentaires" required> <!-- Input for comment -->
                    <button type="button" class="sub_comm_btn" onclick="getCommRepx(this)">
                        <svg xmlns="http://www.w3.org/2000/svg" height="22" viewBox="0 -960 960 960" fill="#fff" width="22">
                        <path d="M142.463-193.271v-224.884L402.691-480.5l-260.228-63.268v-223.961L823.535-480.5 142.463-193.271Z"></path></svg>
                     </button>
                </form>`;
    
    var rexPerent = idparams.parentNode;
    var perentForm = rexPerent.parentNode;

    perentForm.innerHTML = contOfForom;
    clearInterval(setCommtIntval);
}


// envoies des reponse aux messages
function getCommRepx(idparams) {
    var rexPerent = idparams.parentNode;
    var perentForm = rexPerent.parentNode;
    var id_comm = perentForm.getAttribute('data-comm');
    const commForm = perentForm.querySelector(".comm_form");
    const dataComRepForm = new FormData(commForm);
    dataComRepForm.append('id_stream', idStreamForm);
    dataComRepForm.append('id_stream_user', idStreamUserForm);
    dataComRepForm.append('id_comm', id_comm);

    const xhrxx = new XMLHttpRequest();
    xhrxx.onreadystatechange = function() {
        if (xhrxx.readyState === 4) {
            if (xhrxx.status === 200) {
                const respx = xhrxx.response;
                if (respx.success) {
                    clearInterval(setCommtIntval);
                    setCmmtx();
                } else {
                    console.log(respx.echec); // Afficher le message d'erreur si l'opération échoue
                    
                }
            } else {
                console.log("Une erreur s'est produite au niveau du serveur");
            }
        }
    };

    // Assurez-vous d'envoyer la valeur de l'élément et non l'objet lui-même
    xhrxx.open('POST', `async/axgetcommentaires.php`, true);
    xhrxx.responseType = "json";
    xhrxx.send(dataComRepForm);
}
document.querySelectorAll(".comm_form.resp").forEach(element => {
    element.addEventListener('submit', getCommRepx);
});

// recupere les commentaires et reponce
var offset = 0;
var limit;
const idStream = document.querySelector(".dsidstream").value
function setCmmtx(limit = 15) {
    const xhrt = new XMLHttpRequest();
    xhrt.onreadystatechange = function(){ 
        if (xhrt.readyState === 4 && xhrt.status === 200) {
            var repx = xhrt.response;
            document.querySelector(".comm_body").innerHTML = repx;
        }
    }
            
    xhrt.open("POST", "async/axsetcommentaires.php" , true);
    xhrt.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhrt.send("id_stream="+idStream+"&offset="+offset+"&limit="+limit);
}


function checkScroll() {
    ds_content_player = document.querySelector('.ds_content_player');
    limit += limit;
    if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
        setCmmtx(limit);
        // console.log(limit);
    }
    // console.log(limit);
}

window.addEventListener('scroll', checkScroll());
document.addEventListener('DOMContentLoaded', setCmmtx());
setCommtIntval = setInterval(setCmmtx(), 2000);




function suprCommt(param1, param2) {
    const deletIt = param1;
    const commType = param2
    const xhrq = new XMLHttpRequest();
    xhrq.onreadystatechange = function() {
        if (xhrq.readyState === 4) {
            if (xhrq.status === 200) {
                const respx = xhrq.response;
                if (respx.success) {
                    console.log(respx.message);
                    clearInterval(setCommtIntval);
                    setCmmtx();
                } else {
                    console.log(respx.message); // Afficher le message d'erreur si l'opération échoue
                    
                }
            } else {
                console.log("Une erreur s'est produite au niveau du serveur");
            }
        }
    }

    // Assurez-vous d'envoyer la valeur de l'élément et non l'objet lui-même
    xhrq.open('POST', `async/axdeletcommentaires.php`, true);
    xhrq.responseType = "json";
    xhrq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhrq.send("id_delet="+deletIt+"&commtType="+commType);

}


// conteurs de vue for all videos
const plectCookies = getCookie("playCookie");
if (plectCookies == "darkPlayer") {
    var LectVid = document.querySelector('.darkPlayer');
}else{
    var LectVid = document.querySelector('.lecteurHtml')
}


LectVid.addEventListener('timeupdate', function (event) {
    event.preventDefault;
    const timesOfLect = this.currentTime;
    if (!this.duration) return;
    var dureeOfLect = this.duration;
    var moitierDuree = dureeOfLect/2;

    if (moitierDuree - 2 <= timesOfLect && timesOfLect <= moitierDuree + 2) {  
        if (getCookie("VuesCookie_"+idStreamForm)) {
            console.log("la videos est deja visionner ajourduit");
        }else{
            // const commForm = document.querySelector(".comm_form");
            const dataFormVues = new FormData();
            dataFormVues.append('id_stream', idStreamForm);

            const xhtq = new XMLHttpRequest();
            xhtq.onreadystatechange = function() {
                if (xhtq.readyState === 4) {
                    if (xhtq.status === 200) {
                        console.log("consult");
                        const respx = xhtq.response;
                        console.log(respx);
                        if (respx.success) {
                            setCookie("VuesCookie_"+idStreamForm, "True", 1);
                        } else {
                            console.log(respx.echec); // Afficher le message d'erreur si l'opération échoue
                        }
                    } else {
                        console.log("Une erreur s'est produite au niveau du serveur");
                    }
                    
                }
                
            }
            // Assurez-vous d'envoyer la valeur de l'élément et non l'objet lui-même
            xhtq.open('POST', `async/axcountvues.php`, true);
            xhtq.responseType = "json";
            xhtq.send(dataFormVues);
        }
    } 
});

// function conteursVues(dsLecteurs) {
//     const timesOfLect = dsLecteurs.currentTime;
//     var dureeOfLect = dsLecteurs.duration;
//     var moitierDuree = dureeOfLect/2;
//     // moitierDuree - 222 >= timesOfLect && timesOfLect >= moitierDuree + 222
//     console.log(moitierDuree +'______' +timesOfLect);
//     if (2 == timesOfLect ) {
//         if (getCookie("VuesCookie"+idStreamForm)) {
//             console.log("la videos est deja visionner ajourduit");
//         }else{
//             // const commForm = document.querySelector(".comm_form");
//             const dataFormVues = new FormData();
//             dataFormVues.append('id_stream', idStreamForm);

//             const xhtq = new XMLHttpRequest();
//             if (xhtq.readyState === 4) {
//                 if (xhtq.status === 200) {
//                     const respx = xhrxx.response;
//                     console.log(respx);
//                     if (respx.success) {
//                         console.log("collll");
//                         setCookie("monCookie"+idStreamForm, "True", 1);
//                     } else {
//                         console.log(respx.echec); // Afficher le message d'erreur si l'opération échoue
//                     }
//                 } else {
//                     console.log("Une erreur s'est produite au niveau du serveur");
//                 }
                
//             }
//             // Assurez-vous d'envoyer la valeur de l'élément et non l'objet lui-même
//             xhtq.open('POST', `async/axcountvues.php`, true);
//             xhtq.responseType = "json";
//             xhtq.send(dataFormVues);
//         }
//     }  
// }

