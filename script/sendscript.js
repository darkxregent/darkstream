// Sélectionner les éléments une fois
const btnAlert = document.querySelector(".btn_alert");
const alertContent = document.querySelector(".alert_content");
const dsAlert = document.querySelector('.ds_alert');

// Tous les formulaires
const allForm = document.querySelector('.up_comtent');

// Les différents formulaires avec leurs éléments intégrés
const FF1 = document.querySelector('.form1');
const upFiles = document.querySelector('.ds_uploadfile');
const myFile = document.querySelector('.myfiles');

const FF2 = document.querySelector('.form2');

const FF3 = document.querySelector('.form3');
const nopl = document.querySelector('.noPlaylist');
const ispl = document.querySelector('.isPlaylist');

const FF4 = document.querySelector('.form4');

const FF5 = document.querySelector('.form5');
const imgLect = document.querySelector('.canvas_couvers');
const covaSvg = document.querySelector('.couvers_svg');
const covaUp = document.querySelector('.couvers');
const covaGr = document.querySelector('.btn_genere');
const mycanvas = document.querySelector('#mycanvas');

const FF6 = document.querySelector('.form6');

// Vérifier si les fichiers ont été bien sélectionnés selon les consignes
nopl.style.display = "none";
FF1.classList.add('active');

upFiles.addEventListener('change', () => {
    const contFiles = upFiles.files;
    if (contFiles.length === 0) {
        alertModes('Le fichier a été mal sélectionné.');
    } else {
        const file = contFiles[0];
        if (file.type.startsWith('video')) {
            // Animation du chargement 
            setTimeout(() => {
                // Lecture de la vidéo choisie
                myFile.src = URL.createObjectURL(file);
                myFile.controls = 'controls';
                FF1.classList.remove('active');
                FF2.classList.add('active');

                const fileName = file.name.replace(/(\.[^.]+)$/, "");
                document.getElementById('mytitle').value = fileName;

                myFile.addEventListener('loadedmetadata', function() {
                    const duration = myFile.duration;
                    if (!isNaN(duration)) {
                        const hours = Math.floor(duration / 3600);
                        const minutes = Math.floor((duration % 3600) / 60);
                        const seconds = Math.floor(duration % 60);

                        const formattedTime = `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
                        document.getElementById('times').value = formattedTime;
                    } else {
                        alertModes("Une erreur a été détectée. Veuillez re-sélectionner la vidéo.");
                        setTimeout(() => {
                            window.location.reload();
                        }, 5000);
                    }
                });
            }, 20);
        } else {
            alertModes("Ce fichier n'est pas pris en charge.");
        }
    }
});

// Utilisation de la fonction fetchAjax sur les categorie
document.addEventListener('DOMContentLoaded', () => {
    const optionsElement = document.getElementById('option'); // Modifier avec l'ID correct
    const listElement = document.querySelector('.cathegorry'); // Modifier la classe correcte
    const url = "../async/axcategorie.php"; // Modifier avec l'URL correcte

    fetchAjax(optionsElement, listElement, url);
});

// Utilisation de la fonction fetchAjax sur la playlist
document.addEventListener('DOMContentLoaded', () => {
    const optionsElement = document.getElementById('option'); // Modifier avec l'ID correct
    const listElement = document.querySelector('.dxplaylist'); // Modifier la classe correcte
    const url = "../async/axplaylist.php"; // Modifier avec l'URL correcte

    fetchAjax(optionsElement, listElement, url);
});



// code ajax function pour la recuperation des informations
function fetchAjax(optionsElement, listElement, url) {
    optionsElement.addEventListener('change', e => {
        e.preventDefault();

        var xht = new XMLHttpRequest();
        xht.onreadystatechange = function() {     
            if (xht.readyState === 4 && xht.status === 200) {
                listElement.innerHTML = this.response;
            }
        };

        var name = encodeURIComponent(optionsElement.value);
        xht.open("POST", url, true);
        xht.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xht.send("options=" + name);
    });
}

// Vérifier si l'image de la couverture est sélectionnée
covaUp.addEventListener('change', () => {
    const contcova = covaUp.files;
    if (contcova.length !== 0) {
        const file = contcova[0];
        if (file.type.startsWith('image')) {
            imgLect.src = URL.createObjectURL(file);
            imgLect.style.display = 'block';
            covaSvg.style.display = 'none';

            const fileName = mycanvas.value;
            if (fileName) {
                // Faites une requête AJAX pour supprimer le fichier du serveur
                const xhr = new XMLHttpRequest();
                xhr.open('POST', '../async/axdeletefiles.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        // Réinitialiser la sélection de fichier
                        mycanvas.value = '';
                    }
                };
                xhr.send(`fileName=${encodeURIComponent(fileName)}`);
            }
        } else {
            alertModes("Ce fichier n'est pas pris en charge.");
        }
    } else {
        alertModes("Le fichier a été mal sélectionné.");
    }
});

// Génération de l'image
covaGr.addEventListener('click', () => {
    if (upFiles.files.length > 0) {
        processVideo(URL.createObjectURL(upFiles.files[0]));
    } else {
        alertModes("La vidéo a été mal sélectionnée, veuillez la re-sélectionner.");
    }
});

function processVideo(file) {
    const video = document.createElement("video");
    video.src = file;
    video.addEventListener("loadedmetadata", () => {
        const randomTime = Math.random() * video.duration;
        video.currentTime = randomTime;
        video.addEventListener("seeked", () => {
            processCanvas(video, video.videoWidth, video.videoHeight);
        });
    });
}

function processCanvas(media, width, height) {
    const canvas = document.createElement("canvas");
    const context = canvas.getContext("2d");
    const ratio = width / height;

    if (ratio > 16 / 9) {
        width = (height * 16) / 9;
        canvas.width = width;
        canvas.height = height;
        context.drawImage(media, (media.videoWidth - width) / 2, 0, width, height, 0, 0, width, height);
    } else if (ratio < 16 / 9) {
        height = (width * 9) / 16;
        canvas.width = width;
        canvas.height = height;
        context.drawImage(media, 0, (media.videoHeight - height) / 2, width, height, 0, 0, width, height);
    } else {
        canvas.width = width;
        canvas.height = height;
        context.drawImage(media, 0, 0);
    }

    const imageData = canvas.toDataURL('image/jpeg');
    imgLect.src = imageData;
    imgLect.style.display = 'block';
    covaSvg.style.display = 'none';

    const mycavsContent = mycanvas.value;
    canvas.toBlob(blob => {
        const xhr = new XMLHttpRequest();
        const form = new FormData();
        form.append("image", blob);
        form.append("mycavsContent", mycavsContent);

        xhr.open('POST', '../async/axcouvers.php', true);
        xhr.responseType = "json";
        xhr.send(form);

        xhr.onload = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                const response = xhr.response;
                if (response.recu) {
                    mycanvas.value = response.cavx;
                    if (covaUp.files.length > 0) {
                        covaUp.value = '';
                    }
                } else {
                    alertModes(response.cavx);
                }
            } else if (xhr.readyState == 4) {
                console.log('Erreur système');
            }
        };
    }, "image/jpeg");
}

// Dépôt final du formulaire au serveur
const xhr = new XMLHttpRequest();
allForm.addEventListener("submit", (e) => {
    e.preventDefault();
    animatedPub();

    const formData = new FormData(allForm);
    
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var respx = xhr.response;
            console.log(respx);
            if (respx.success) {
                alertModes(respx.up_echec);
                setTimeout(() => {
                    window.location.href = "../index";
                }, 4000);
            } else {
                alertModes(respx.up_echec);
                setTimeout(() => {
                    window.location.reload();
                }, 5000);
            }
        } else if (xhr.readyState == 4) {
            console.log("Une erreur s'est produite au niveau du serveur");
        }
    };

    xhr.upload.addEventListener("progress", ({ loaded, total }) => {
        const progress = Math.floor((loaded / total) * 100);
        document.querySelector('.progression').style.setProperty("--wd", `${progress}%`);
        document.querySelector('.pourcentage').innerHTML = progress === 100 ? "Terminer" : `${progress}%`;
    });

    xhr.open('POST', '../async/axupload.php', true);
    xhr.responseType = "json";
    xhr.send(formData);
});

// anulation du depot des formulaire
function annullation(){

    const fileName = mycanvas.value;
    if (fileName) {
        // Faites une requête AJAX pour supprimer le fichier du serveur
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '../async/axdeletefiles.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                
                // Réinitialiser la sélection de fichier
                mycanvas.value = '';
            }
        };
        xhr.send(`fileName=${encodeURIComponent(fileName)}`);
    }
    xhr.abort();
    allForm.reset();
    alertModes("annullation de la publication en cours ...");
    setTimeout(() => {
        window.location.href = "studios";
    }, 5000);

}


// Animation pour le formulaire
function animatedPub() {
    document.querySelector('.trInfo').style.display = "none";
    document.querySelector('.up_change.chargement').style.display = "flex";
    document.querySelector('.pub_submit').style.display = "none";
    document.querySelector('.charging_svg').style.display = "flex";
}

// Navigation dans les différentes parties du formulaire
// Déplacement dans les différentes parties du formulaire

// 1er formulaire
function next1() {
    var istimes = document.getElementById('times').value;
    if (upFiles.files.length !== 0 && upFiles.files[0].type.startsWith('video') && istimes) {
        FF1.classList.remove('active');
        FF2.classList.add('active');
    } else {
        alertModes('Veuillez sélectionner un fichier vidéo.');
    }
}

// 2e formulaire
function prew2() {
    FF2.classList.remove('active');
    FF1.classList.add('active');
    if (!myFile.paused) {
        myFile.pause();
    }
}

function next2() {
    const mainTitle = document.getElementById('mytitle').value;
    if (mainTitle) {
        FF2.classList.remove('active');
        FF3.classList.add('active');
        document.querySelector('.hd_title').textContent = "TITRE : " + mainTitle;
        if (!myFile.paused) {
            myFile.pause();
        }
    } else {
        alertModes('Veuillez remplir le champ Titre.');
    }
}

// 3e formulaire
function prew3() {
    FF3.classList.remove('active');
    FF2.classList.add('active');
}

function next3() {
    const disc = document.getElementById('disc').value;
    const tg = document.getElementById('tag').value;
    if (disc) {
        if (tg) {
            FF3.classList.remove('active');
            FF4.classList.add('active');
        } else {
            alertModes('Veuillez écrire quelques tags sur la vidéo.');
        }
    } else {
        alertModes('Veuillez écrire une description.');
    }
}

// 4e formulaire
function prew4() {
    FF4.classList.remove('active');
    FF3.classList.add('active');
}

function next4() {
    const option = document.getElementById('option').value;
    const categorie = document.getElementById('cath').value;
    if (option) {
        if (categorie) {
            FF4.classList.remove('active');
            FF5.classList.add('active');
        } else {
            alertModes('Veuillez sélectionner la catégorie de la vidéo.');
        }
    } else {
        alertModes('Veuillez sélectionner l\'option de la vidéo.');
    }
}

// 5e formulaire
function prew5() {
    FF5.classList.remove('active');
    FF4.classList.add('active');
}

function next5() {
    if (imgLect.hasAttribute('src') && imgLect.getAttribute('src').trim() !== '') {
        FF5.classList.remove('active');
        FF6.classList.add('active');
    } else {
        alertModes('Veuillez générer ou importer une couverture.');
    }
}


function prew6() {
    FF6.classList.remove('active');
    FF5.classList.add('active');
}

// Fonction pour afficher les messages d'alerte
function alertModes(alerted) {
    dsAlert.innerText = alerted;
    alertContent.classList.add('actif');
    var alertTime = setTimeout(() => {
        alertContent.classList.remove('actif');
    }, 5000);

    btnAlert.addEventListener('click', () => {
        alertContent.classList.remove('actif');
        clearTimeout(alertTime);
    });
}

// verryfier les different etape 
setInterval(() => {
    const WHITE = "white";
    const BLACK = "black";

    const timesValue = document.getElementById('times').value;
    const myTitleValue = document.getElementById('mytitle').value;
    const discValue = document.getElementById('disc').value;
    const tagValue = document.getElementById('tag').value;
    const optionValue = document.getElementById('option').value;
    const cathValue = document.getElementById('cath').value;

    const setColor = (selector, condition) => {
        document.querySelector(selector).style.backgroundColor = condition ? WHITE : BLACK;
    };

    setColor('.etats.span1', upFiles.files.length !== 0 && upFiles.files[0].type.startsWith('video') && timesValue);
    setColor('.etats.span2', myTitleValue);
    setColor('.etats.span3', discValue && tagValue);
    setColor('.etats.span4', optionValue && cathValue);
    setColor('.etats.span5', imgLect.hasAttribute('src') && imgLect.getAttribute('src').trim() !== '');

}, 2000);


// pour cree un nouveux playlist
function dPlaylist() {
    ispl.style.display="none";
    nopl.style.display="flex";
}
// playlist retour vere la selection
function xPlaylist() {
    ispl.style.display="flex";
    nopl.style.display="none";
}

function infoDefined() {
    alertModes("Suivez bien les etaps du formulaire pour evitres la supresion lors des veriffication.")
}