document.addEventListener('DOMContentLoaded', autoplaysvidx);


function autoplaysvidx() {
    const outplay = document.querySelectorAll('#videoExtra');


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