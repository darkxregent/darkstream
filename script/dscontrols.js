const dsPlays = `<svg class="ds-svg-icone" id="pause" xmlns="http://www.w3.org/2000/svg" height="28px" viewBox="0 -960 960 960" width="28px" fill="#FFFFFF"><path d="M320-202v-560l440 280-440 280Z"/></svg>`;
const dsPause = `<svg class="ds-svg-icone" id="plays" xmlns="http://www.w3.org/2000/svg" height="28px" viewBox="0 -960 960 960" width="28px" fill="#FFFFFF"><path d="M556.67-200v-560h170v560h-170Zm-323.34 0v-560h170v560h-170Z"/></svg>`;
const dsVnull = `<svg xmlns="http://www.w3.org/2000/svg" height="28px" viewBox="0 -960 960 960" width="28px" fill="#FFFFFF"><path d="M806-56 677.67-184.33q-27 18.66-58 32.16-31 13.5-64.34 21.17v-68.67q20-6.33 38.84-13.66 18.83-7.34 35.5-19l-154.34-155V-160l-200-200h-160v-240H262L51.33-810.67 98.67-858l754.66 754L806-56Zm-26.67-232-48-48q19-33 28.17-69.67 9.17-36.66 9.17-75.33 0-100-58.34-179-58.33-79-155-102.33V-831q124 28 202 125.5t78 224.5q0 51.67-14.16 100.67-14.17 49-41.84 92.33Zm-134-134-90-90v-130q47 22 73.5 66t26.5 96q0 15-2.5 29.5t-7.5 28.5Zm-170-170-104-104 104-104v208Z"/></svg>`;
const dsVsmall = `<svg xmlns="http://www.w3.org/2000/svg" height="28px" viewBox="0 -960 960 960" width="28px" fill="#FFFFFF"><path d="M280-360v-240h160l200-200v640L440-360H280Z"/></svg>`;
const dsVcenter = `<svg xmlns="http://www.w3.org/2000/svg" height="28px" viewBox="0 -960 960 960" width="28px" fill="#FFFFFF"><path d="M200-360v-240h160l200-200v640L360-360H200Zm426.67 45.33v-332q51 18.34 82.16 64.34Q740-536.33 740-480q0 57-31.17 102-31.16 45-82.16 63.33Z"/></svg>`;
const dsVtold = `<svg xmlns="http://www.w3.org/2000/svg" height="28px" viewBox="0 -960 960 960" width="28px" fill="#FFFFFF"><path d="M560-131v-68.67q94.67-27.33 154-105 59.33-77.66 59.33-176.33 0-98.67-59-176.67-59-78-154.33-104.66V-831q124 28 202 125.5T840-481q0 127-78 224.5T560-131ZM120-360v-240h160l200-200v640L280-360H120Zm426.67 45.33v-332Q599-628 629.5-582T660-480q0 55-30.83 100.83-30.84 45.84-82.5 64.5Z"/></svg> `;
const dsVidPliene = `<svg class="ds-svg-icone" xmlns="http://www.w3.org/2000/svg" height="28px" viewBox="0 -960 960 960" width="28px" fill="#FFFFFF"><path d="M160-160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720v480q0 33-23.5 56.5T800-160H160Zm0-80h640v-480H160v480Zm80-80h480v-320H240v320Zm-80 80v-480 480Z"/></svg>`;
const dsVidReduit = `<svg class="ds-svg-icone" class="ds-svg-icone" xmlns="http://www.w3.org/2000/svg" height="28px" viewBox="0 -960 960 960" width="28px" fill="#FFFFFF"><path d="M200-400h360v-280H200v280Zm-40 240q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720v480q0 33-23.5 56.5T800-160H160Zm0-80h640v-480H160v480Zm0 0v-480 480Z"/></svg>`;

// LES DIFFERENT CONTENEURE

myDoccuments = document.querySelector("#player-video-darkstream");

function oneSelectClass(paramx) {
    const varValues =  myDoccuments.querySelector('.'+paramx);
    return varValues;
}
function allSelectClass(paramx) {
    const varValues =  myDoccuments.querySelectorAll('.'+paramx);
    return varValues;
}
function oneSelectId(paramx) {
    const varValues =  myDoccuments.querySelector('#'+paramx);
    return varValues;
}
function alleSelectId(paramx) {
    const varValues =  myDoccuments.querySelector('#'+paramx);
    return varValues;
}

const darkVideos = oneSelectClass("darkPlayer");

const contentTimes = oneSelectClass("online-times");
const contentVolumes = oneSelectClass("icone-volume");
const contentPayers = oneSelectClass("play-pause");

const progressTimes = oneSelectClass("progress-bar");
const progressVolumes = oneSelectClass("volume-scroll");

const vidCadrage = oneSelectClass("cadrage");
const vidVitess = oneSelectClass("vitess")

const controls = oneSelectClass("dark_controls"); 
var controlsTrue;

// les icone utilisables lincl
var iconeVolumeNull,
iconeVolumeSmall,
iconeVolumeCenter,
iconeVolumeTold,
iconePlaysPrews,
iconePlaysRewind,
iconePlaysPause,
iconePlaysPlays,
iconePlaysForward,
iconePlaysNext,
iconePlaysQuatity;

 iconeVolumeNull = oneSelectId("null");
 iconeVolumeSmall = oneSelectId("small");
 iconeVolumeCenter = oneSelectId("center");
 iconeVolumeTold = oneSelectId("told");

 iconePlaysPrews = oneSelectId("prews");
 iconePlaysRewind = oneSelectId("rewind");

 iconePlaysPause = oneSelectId("pause");
 iconePlaysPlays = oneSelectId("plays");
 iconePlaysForward = oneSelectId("forward");
 iconePlaysNext = oneSelectId("next");
 iconePlaysQuatity = oneSelectId("quality");


//  darkVideos.addEventListener('load', function () {
//     if (!this.duration) return;
//     var findTimes = oneSelectClass("fend-times"),
//     dur = this.duration;
//     findTimes.innerHTML = formatTime(dur);
//  });
darkVideos.addEventListener('loadedmetadata', function () {
    if (!this.duration) return; // Vérifie si la durée est disponible
    var findTimes = oneSelectClass("fend-times"),
        dur = this.duration;
    findTimes.innerHTML = formatTime(dur); // Met à jour le contenu avec la durée formatée
});

    
    
// playing this videos for all 
darkVideos.addEventListener('click', darkPlayeurs);
contentPayers.addEventListener('click', darkPlayeurs);

function darkPlayeurs() {
    if (darkVideos.paused) {
        contentPayers.innerHTML= dsPause;
        darkVideos.play();
        controlsTrue = true;
        controls.classList.remove('displayed');
    }else{
        contentPayers.innerHTML = dsPlays;
        darkVideos.pause();
        controls.classList.add('displayed');
        controlsTrue = false; 
    }
}



progressVolumes.addEventListener('input', ()=>{
    var valeurVolume = progressVolumes.value;
    darkVideos.volume = valeurVolume;
    volumeIcone(valeurVolume);
});
var valVolume;
contentVolumes.addEventListener('click', volumeMuetX)
function volumeMuetX() {
    var valeurVolume = progressVolumes.value;
    if (valeurVolume != 0) {
        valVolume = progressVolumes.value;
    }
    if (valeurVolume == 0) {
        darkVideos.volume = valVolume;
        progressVolumes.value = valVolume;
        volumeIcone(valVolume);
    }else{
        valeurVolume = 0;
        progressVolumes.value = 0;
        darkVideos.volume = valeurVolume;
        volumeIcone(valeurVolume);
    }
}

function volumeIcone(valeurVolume) {
    if (valeurVolume == 0) {
        contentVolumes.innerHTML = dsVnull;
    }else if (valeurVolume == 1) {
        contentVolumes.innerHTML = dsVtold;
    }else if (valeurVolume <= 0.3) {
        contentVolumes.innerHTML = dsVsmall;
    } else {
        contentVolumes.innerHTML = dsVcenter;
    }
}

darkVideos.addEventListener('timeupdate', () => {
    if (!darkVideos.duration) return; // Assurez-vous que la vidéo a une durée
    
    const darkTimes = darkVideos.currentTime;
    const darkProgress = (darkTimes / darkVideos.duration) * 100;

    progressTimes.value = darkProgress;
    contentTimes.innerHTML = formatTime(darkTimes);
    updateProgressBar(darkProgress);
});

// Fonction pour formater le temps en minutes:secondes
function formatTime(seconds) {
    const mins = Math.floor(seconds / 60);
    const secs = Math.floor(seconds % 60);
    return `${mins}:${secs < 10 ? '0' : ''}${secs}`;
}
function updateProgressBar(value) {
    const progressBar = document.querySelector('.progress-bar');

    // S'assurer que la valeur est comprise entre 0 et 100
    value = Math.max(0, Math.min(value, 100));
    progressBar.value = value;

    // Modifier les couleurs dynamiquement
    if (value < 35) {
        // Rouge pour moins de 35%
        progressBar.style.setProperty('--color-start', 'red');
        progressBar.style.setProperty('--color-mid', 'red');
        progressBar.style.setProperty('--color-end', 'red');
    } else if (value >= 35 && value <= 70) {
        // Dégradé rouge -> jaune pour 35% à 70%
        progressBar.style.setProperty('--color-start', 'red');
        progressBar.style.setProperty('--color-mid', 'yellow');
        progressBar.style.setProperty('--color-end', 'yellow');
    } else {
        // Dégradé rouge -> jaune -> vert pour plus de 70%
        progressBar.style.setProperty('--color-start', 'red');
        progressBar.style.setProperty('--color-mid', 'yellow');
        progressBar.style.setProperty('--color-end', 'green');
    }
}


progressTimes.addEventListener('click', (e) => {
    if (!darkVideos.duration) return; // Assurez-vous que la durée est disponible

    const rect = progressTimes.getBoundingClientRect();
    const clickedPosition = e.clientX - rect.left; // Position cliquée relative à la barre
    const progressWidth = rect.width;
    const clickedTimes = (clickedPosition / progressWidth) * darkVideos.duration;

    darkVideos.currentTime = clickedTimes; // Met à jour le temps de la vidéo
});

// Support pour les événements tactiles
progressTimes.addEventListener('touchstart', (e) => {
    if (!darkVideos.duration) return;

    const touchX = e.touches[0].clientX;
    const rect = progressTimes.getBoundingClientRect();
    const clickedPosition = touchX - rect.left;
    const clickedTimes = (clickedPosition / rect.width) * darkVideos.duration;

    darkVideos.currentTime = clickedTimes;
});



const target = document.querySelector('#myTarget'); // Élément cible
let isHeld = false; // Indique si le clic est maintenu
var darkProg;
// Détecter le début du clic enfoncé
progressTimes.addEventListener('mousedown', (e) => {
    isHeld = true;
    darkVideos.pause();
});

// Suivre le curseur pendant que le clic est maintenu
progressTimes.addEventListener('mousemove', (e) => {
    if (isHeld) {
        if (!darkVideos.duration) return; // Assurez-vous que la durée est disponible

        const rect = progressTimes.getBoundingClientRect();
        const clickedPosition = e.offsetX; // Position cliquée relative à la barre
        const progressWidth = rect.width;
        const clickedTimes = (clickedPosition / progressWidth) * darkVideos.duration;
        
        const darkTimes = clickedTimes;
        darkProg = (darkTimes / darkVideos.duration) * 100;

        progressTimes.value = darkProg;
            
        const progressBar = document.querySelector('.progress-bar');
        // Dégradé blanchze
        progressBar.style.setProperty('--color-start', 'white');
        progressBar.style.setProperty('--color-mid', 'white');
        progressBar.style.setProperty('--color-end', 'white');
    }
});

// Détecter la fin du clic maintenu
progressTimes.addEventListener('mouseup', () => {
    isHeld = false;
    if (!isHeld) {
        darkVideos.play();
        contentPayers.innerHTML = dsPause;
    }
    console.log('Clic maintenu terminé');
});

// Optionnel : Annuler si la souris quitte l'élément
progressTimes.addEventListener('mouseleave', () => {
    if (isHeld) {

        isHeld = false;
        console.log('Clic maintenu annulé (souris sortie)');
        contentPayers.innerHTML = dsPlays;
    }
});


iconePlaysRewind.addEventListener('click', function () {
    const newDurre = darkVideos.currentTime - 10;
    darkVideos.currentTime = newDurre;
})
iconePlaysForward.addEventListener('click', function () {
    const newDurre = darkVideos.currentTime + 10;
    darkVideos.currentTime = newDurre;
})



darkVideos.addEventListener('click', function () {
    controls.classList.add('displayed');
    if (darkVideos.paused) {
        controls.classList.add('displayed');
    }
    else {
        controls.classList.remove('displayed');
    }
})

var isContrils,textTime,inContrils;
// entre dans le videos
darkVideos.addEventListener('mouseover', function () {
    if (controlsTrue) {
        clearTimeout(textTime);
        clearTimeout(isContrils);
        clearTimeout(inContrils);
    }
})
// a linterieur du linterieur
darkVideos.addEventListener('mousemove', function () {
    clearTimeout(isContrils);
    if (controlsTrue) {
        isContrils = setTimeout(() => {
            controls.classList.remove('displayed');
        }, 5000);
        controls.classList.add('displayed');
    }
})
// sortie de controls
darkVideos.addEventListener('mouseout', function () {
    if (controlsTrue) {
        textTime = setTimeout(() => {
            controls.classList.remove('displayed');
        }, 3000);
    }
})





// entre dans le controls
controls.addEventListener('mouseover', function () {
    clearTimeout(textTime);
    clearTimeout(isContrils);
    clearTimeout(inContrils);
})
// a linterieur du controls
controls.addEventListener('mousemove', function () {
    controls.classList.add('displayed');
})
// sortie du controls
controls.addEventListener('mouseout', function () {
    if (controlsTrue) {
        inContrils = setTimeout(() => {
            controls.classList.remove('displayed');
        }, 3000);
    }
})

var textFullScrean = false;
vidCadrage.addEventListener('click', fullScreanAll);
function fullScreanAll() {
    if (textFullScrean) {
        myDoccuments.classList.remove('superFullScreen');
        vidCadrage.innerHTML = dsVidPliene;
        textFullScrean = false;
    } else {
        myDoccuments.classList.add('superFullScreen');
        vidCadrage.innerHTML = dsVidReduit;
        textFullScrean = true;
    }
}


// gestion de la vitess
vidVitess.addEventListener('click', function () {
    oneSelectId('parametre-vitess').classList.toggle("overvitss");
})


oneSelectClass("vitss3x").style.backgroundColor='red';
var itVitss = 1;
function setVitssX(para1,para2) {
    if (itVitss != para1) {
        
        darkVideos.playbackRate = 1;
     // Fonction pour augmenter la vitesse de lecture
        darkVideos.playbackRate *= para1; // Augmente la vitesse de lecture par paliers de 0.25
        let vitssCollAll = allSelectClass("vitss");
        vitssCollAll.forEach(element => {
            element.style.backgroundColor='rgba(63, 50, 121, 0.703)';
        });
    }

        let vitssCollIt = oneSelectClass(para2);
        vitssCollIt.style.backgroundColor='red';
        itVitss = para1;
        oneSelectId('parametre-vitess').classList.toggle("overvitss");
        
}



let isCursorOnVideo = false;

// Gérer la souris sur la vidéo
myDoccuments.addEventListener('mouseenter', () => {
    isCursorOnVideo = true;
});

myDoccuments.addEventListener('mouseleave', () => {
    isCursorOnVideo = false;
});


// Gérer les touches
var valeurVolumex;
document.addEventListener('keydown', (event) => {
    if (!isCursorOnVideo) return;

    switch (event.key) {
        case ' ':
            darkPlayeurs();
            break;

        case 'k':
            // Lecture/Pause (même que espace)
            darkPlayeurs();
            break;

        case 'l':
            // Avancer de 10 secondes
            darkVideos.currentTime += 10;
            break;
        case 'j':
            // Avancer de 10 secondes
            darkVideos.currentTime -= 10;
            break;
        case 'm':
            // Activer/Désactiver le son
            volumeMuetX();
            break;
        case 'f':
            // plien ecrean
            fullScreanAll();
            break;

        // case 'echap':
        //     // ecrean reduit
        //     darkVideos.currentTime -= 5;
        //     break;
        // case 'ArrowUp':
        //     // Augmenter le volume
        //     var xxvol = progressVolumes.value;
        //     valeurVolumex = parseInt(xxvol,10);
        //     if (valeurVolumex <= 1) {
        //         valeurVolumex += 0,1;
        //         progressVolumes.value = valeurVolumex;
        //         console.log(valeurVolumex);
        //     }
        //     break;

        // case 'ArrowDown':
        //     // Diminuer le volume
        //     var xxvol = progressVolumes.value;
        //     valeurVolumex = parseInt(xxvol,10);
        //     if (valeurVolumex >= 0.00) {
        //         valeurVolumex -= 0.1;
        //         progressVolumes.value = valeurVolumex;
        //         console.log(valeurVolumex);
        //     }
        //     break;

        case 'ArrowRight':
            // Avancer de 5 secondes
            darkVideos.currentTime += 5;
            break;

        case 'ArrowLeft':
            // Reculer de 5 secondes
            darkVideos.currentTime -= 5;
            break;
        

        default:
            break;
    }
});
