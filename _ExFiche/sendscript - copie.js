











// Sélectionner les éléments une fois
var btnAlert = document.querySelector(".btn_alert");
var alertContent = document.querySelector(".alert_content");
var dsAlert = document.querySelector('.ds_alert');

// Tous les formullaire
allForm = document.querySelector('.up_comtent');




// les differente formullaire avec leurs Element integres
var FF1 = document.querySelector('.form1');
var upFiles = document.querySelector('.ds_uploadfile');
var myFile = document.querySelector('.myfiles');

var FF2 = document.querySelector('.form2');

var FF3 = document.querySelector('.form3');
var nopl = document.querySelector('.noPlaylist');
var ispl = document.querySelector('.isPlaylist');

var FF4 = document.querySelector('.form4');

var FF5 = document.querySelector('.form5');
var imgLect = document.querySelector('.canvas_couvers');
var covaSvg = document.querySelector('.couvers_svg');
var covaUp = document.querySelector('.couvers');
var covaGr = document.querySelector('.btn_genere');
var mycanvas = document.querySelector('#mycanvas');

var FF6 = document.querySelector('.form6');
// var FF7 = document.querySelector('.form7');


// verifier si les fichier a été bien selectionner selon les consigne
nopl.style.display="none";
FF1.classList.add('active');
upFiles.addEventListener('change', () =>{
    const contFiles = upFiles.files;
    if (contFiles.length === 0) {
        alertModes('le fichiers a été mal selectionner.');
    }else{
        var files = contFiles[0];
        if (files.type.startsWith('video')) {
            // Animation du chargement 
            setTimeout(() => {
                // arret de l'Animation du chargement 

                // lecturetxt de la video choisie
                for (const file of contFiles) {
                    myFile.src = URL.createObjectURL(file);
                    myFile.controls = 'controls';
                    FF1.classList.remove('active');
                    FF2.classList.add('active')
                    var filesnam = upFiles.files[0].name;
                    var namFiles = filesnam.replace(/(\.[^.]+)$/,"");
    
                    document.getElementById('mytitle').value = namFiles;
    
                    myFile.addEventListener('loadedmetadata', function() {
                        const temps = myFile.duration;
                        if (!isNaN(temps)) {
                            const mm = Math.floor(temps / 60);
                            const s = Math.floor(temps % 60);
                            const h = Math.floor(mm / 60);
                            const remainingMinutes = mm % 60; // Minutes restantes après avoir calculé les heures
                            const H = '00';
                            
                            const lectTemps = h > 0 ?
                                `${String(h).padStart(2, '0')}:${String(remainingMinutes).padStart(2, '0')}:${String(s).padStart(2, '0')}` :
                                `${H}:${String(mm).padStart(2, '0')}:${String(s).padStart(2, '0')}`;
                    
                            document.getElementById('times').value = lectTemps;
                        } else {
                            alertErreur("Une erreur a été détectée. Veuillez re-sélectionner la vidéo.");
                            setTimeout(() => {
                                window.location.reload();
                            }, 5000);
                        }
                    });                      
                } 
            }, 20);
            
        }else{
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


// verifier si l'image de la couverture est selectionner
covaUp.addEventListener('change', () => {
    const contcova = covaUp.files;
        if (contcova.length !== 0) {
            var files = contcova[0];
            if (files.type.startsWith('image')) {
                for (const file of contcova) {
                    imgLect.src = URL.createObjectURL(file);
                    imgLect.style.display='block';
                    covaSvg.style.display='none';

                    var fileName = mycanvas.value;
                    if (fileName) {
                        // Faites une requête AJAX pour supprimer le fichier du serveur
                        const xhr = new XMLHttpRequest();
                        xhr.open('POST', '../async/axdeletefiles.php', true);
                        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                        xhr.onreadystatechange = function () {
                            if (xhr.readyState === 4 && xhr.status === 200) {
                                // Réinitialiser la sélection de fichier
                                mycanvas.value = '';
                            }
                        };
                        xhr.send(`fileName=${encodeURIComponent(fileName)}`);
                    }
                }
            }else{
                alertModes("Ce fichier n'est pas pris en charge.");
            }
        }else{
            alertModes("le fichiers a été mal selectionner.")
        }
});


//  generation de l'image
covaGr.addEventListener('click' , () => {
    var videoInput = upFiles;
            
    // Vérifier si un fichier vidéo a été sélectionné
    if (videoInput.files.length > 0) {
        var videoURL = URL.createObjectURL(videoInput.files[0]);
        processVideo(videoURL)
    }else{
        alertModes("la videos a été mal selectionner, Veuillez la reselectionner.")
    }
    
})
    function processVideo(file) {

        // Créer un élément video pour lire le fichier
        let video = document.createElement("video");
        // Définir la source de la vidéo avec l'URL temporaire du fichier
        video.src = file;
        // Définir une fonction à exécuter lorsque les métadonnées du fichier sont chargées
        video.addEventListener("loadedmetadata", () => {
          // Récupérer la durée du fichier en secondes
          var duration = video.duration;
      
          // Générer un nombre aléatoire entre 0 et la durée
          var random = Math.random() * duration;
      
          // Définir le temps actuel du fichier avec le nombre aléatoire
          video.currentTime = random;
      
          // Définir une fonction à exécuter lorsque le fichier est prêt à être capturé
          video.addEventListener("seeked", () => {
              processCanvas(video, video.videoWidth, video.videoHeight);
            
          });
        });
      
      }
      
    function processCanvas(media, width, height) {
        media_width = media.width || media.videoWidth;
        media_height = media.height || media.videoHeight;
        // Créer un élément canvas pour dessiner l'image
        var canvas = document.createElement("canvas");
      
        // Récupérer le contexte 2D du canvas
        var context = canvas.getContext("2d");
      
        // Déterminer les dimensions du canvas en fonction du format 16/9
        var ratio = width / height;
      
        if (ratio > 16 / 9) {
          // L'image est trop large, on la recadre horizontalement
          width = (height * 16) / 9;
          canvas.width = width;
          canvas.height = height;
          context.drawImage(
            media, (media_width - width) / 2,
            0, width, height, 0, 0, width, height
          );
        } else if (ratio < 16 / 9) {
          // L'image est trop haute, on la recadre verticalement
          height = (width * 9) / 16;
          canvas.width = width;
          canvas.height = height;
          context.drawImage(
            media, 0, (media_height - height) / 2, width,
            height, 0, 0,
            width, height
          );
        } else {
          // L'image est déjà au format 16/9, on la conserve telle quelle
          canvas.width = width;
          canvas.height = height;
          context.drawImage(media, 0, 0);
        }
        var imageData = canvas.toDataURL('image/jpeg');
        
        imgLect.src = imageData;
        imgLect.style.display='block';
        covaSvg.style.display='none';


        
        var mycavsContent = mycanvas.value;
        
        // Convertir l'image en webp avec une qualité de 100%
        canvas.toBlob(blob => {
            var xhrx = new XMLHttpRequest();
            // Créer un objet FormData pour envoyer le blob au serveur
            var form = new FormData();
            form.append("image", blob);
            form.append("mycavsContent", mycavsContent);

            // Ouvrir la connexion avec le fichier PHP qui va traiter l'image
            xhrx.open('POST', '../async/axcouvers.php', true);

            // Configurer la requête pour recevoir une réponse JSON
            xhrx.responseType = "json";
            
            // Envoyer la requête avec le formulaire contenant l'image
            xhrx.send(form);

            // Traitement de la réponse du serveur
            xhrx.onload = function() {
                if (xhrx.readyState == 4 && xhrx.status == 200) {
                    var repx = xhrx.response;
                    console.log(repx);
                    if (repx.recu) {
                        mycanvas.value = repx.cavx;
                        if (covaUp.files.length > 0) {
                            // Supprimer la sélection de fichier IMPORTER
                            covaUp.value = '';
                        } 
                    } else {
                        alertModes(repx.cavx);
                    }
                } else if (xhrx.readyState == 4) {
                    console.log('Erreur système');
                }
            };
        }, "image/jpeg");  // Utiliser le format jpeg


    }

// depot finale du formullaire auserveure
allForm.addEventListener("submit" , (e)=>{
    e.preventDefault(); 
    animatedPub();
    var dataForom = new FormData(allForm);
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
        if (xhr.readyState == 4 && xhr.status == 200) {
            var respx = xhr.response;
            if (respx.success) {
                alertModes(respx.senderreur);
                setTimeout(function(){
                    window.location.href = "../index";
                } , 4000);
            }else{
                alertModes(respx.senderreur);
                
                
            }
        }else if (xhr.readyState == 4) {
            console.log("Une erreur c'est produit au niveau du SERVEURE");
        }
    } 
    xhr.upload.addEventListener("progress" , ({loaded , total}) => {
        var wd = Math.floor((loaded / total) * 100);
        
        document.querySelector('.progression').style.setProperty("--wd" , `${wd}%`);
        if (wd == 100) {
            w = "Terminer";
        }else{
            w = wd + '%';
        }

        document.querySelector('.pourcentage').innerHTML = w;


        // vlt.innerHTML = formatFileSize(loaded);
        // filesize.innerHTML = formatFileSize(total);  

    });
    xhr.open('POST', '../async/axupload.php', true);
    xhr.responseType = "json";
    xhr.send(dataForom);




});



// formullaire 6 animation for the forrmulaire
function animatedPub() {
    document.querySelector('.trInfo').style.display="none";
    document.querySelector('.up_change.chargement').style.display="flex";
    document.querySelector('.pub_submit').style.display="none";
    document.querySelector('.charging_svg').style.display="flex";
}



// deplacement dans les different artie du formulaire
// 1e forom
function next1() {
    if (upFiles.files.length !== 0 && upFiles.files[0].type.startsWith('video')) {
        FF1.classList.remove('active');
        FF2.classList.add('active');
    }else{
        alertModes('veuilez selectionner un fichier videos.');
    }
}


// 2e forom
function prew2() {
    FF2.classList.remove('active');
    FF1.classList.add('active');
    if (!myFile.pause()) {
        myFile.pause();
    }
    
}
function next2() {
    var mainTitle = document.getElementById('mytitle').value
    if (mainTitle) {
        FF2.classList.remove('active');
        FF3.classList.add('active'); 
        document.querySelector('.hd_title').textContent = "TITRE : "+mainTitle;
        if (!myFile.pause()) {
            myFile.pause();
        } 

    }else{
        alertModes('veuillez remplire le chanp Titre.');
    }
}

// 3e forom
function prew3() {
    FF3.classList.remove('active');
    FF2.classList.add('active');
}
function next3() {
    var disc = document.getElementById('disc').value;
    var tg = document.getElementById('tag').value;
    if (disc) {
        if (tg) {
          FF3.classList.remove('active');
        FF4.classList.add('active');  
        }else{
            alertModes('veuillez ecrire quelque tag sur la video.');
        }       
    }else{
        alertModes('veuillez ecrire une description.');
    }
}

// 4e forom
function prew4() {
    FF4.classList.remove('active');
    FF3.classList.add('active');
}
function next4() {
    var option = document.getElementById('option').value;
    var cathegorie = document.getElementById('cath').value;
    if (option) {
        if (cathegorie) {
            FF4.classList.remove('active');
            FF5.classList.add('active');  
        }else{
            alertModes('veuillez selectionner la catégorie de la video.');
        }       
    }else{
        alertModes('veuillez selectionner l\'option de la video.');
    }
}

// 5e forom
function prew5() {
    FF5.classList.remove('active');
    FF4.classList.add('active');
}
function next5() {
    // Parcourir toutes les balises <img>
    if (imgLect.hasAttribute('src') && imgLect.getAttribute('src').trim() !== '') {
        FF5.classList.remove('active');
        FF6.classList.add('active');        
    }else{
        alertModes('veuillez générer ou importe une couvertures.');
    }
}

// 6e forom
function prew6() {
    FF6.classList.remove('active');
    FF5.classList.add('active');
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


// fonct alert
function alertModes(alerted) {
    dsAlert.innerText = alerted;
    alertContent.classList.add('actif');
    var alertTime = setTimeout(function() {
        alertContent.classList.remove('actif');
    }, 5000);

    btnAlert.addEventListener('click', function() {
        alertContent.classList.remove('actif');
        clearTimeout(alertTime);
    });
}


// fonction pour convertures les chiffres b les mega (Mb)
function formatFileSize(e) {
    let oo = parseInt(e);
    let x = oo / 1024;
    if (x < 1) {
        return oo + "o";  // Si le fichier est plus petit que 1 ko, retourner en octets
    } else if (x < 1024) {
        return x.toFixed(2) + "ko";  // Si le fichier est entre 1 ko et 1024 ko
    } else if (x < 1048576) {
        let ex = x / 1024;
        return ex.toFixed(2) + "Mo";  // Si le fichier est entre 1 Mo et 1024 Mo
    } else {
        let ex = x / 1048576;
        return ex.toFixed(2) + "Go";  // Si le fichier est plus grand que 1 Go
    }
}
    

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
