// Colorisation de l'avancement suivant le score
function AvancementColorisation() {
    const $avancement = document.querySelectorAll('.avancement');
    $avancement.forEach(element => {
        let $score = parseInt(element.innerHTML.substr(0, 3));
        switch (true) {
            case ($score < 10):
                element.style.backgroundColor = "grey";
                break;
            case ($score < 20):
                element.style.backgroundColor = "gold";
                break;
            case ($score < 30):
                element.style.backgroundColor = "orange";
                break;
            case ($score < 40):
                element.style.backgroundColor = "green";
                break;
            case ($score < 50):
                element.style.backgroundColor = "green";
                break;
            case ($score < 60):
                element.style.backgroundColor = "blue";
                break;
            case ($score < 70):
                element.style.backgroundColor = "#632800";
                break;
            case ($score < 80):
                element.style.backgroundColor = "#632800"; // brun (marron)
                break;
            case ($score < 90):
                element.style.backgroundColor = "black";
                break;
            case ($score < 100):
                element.style.backgroundColor = "black";
                break;
            case ($score == 100):
                element.style.background = "linear-gradient(217deg, rgba(255,0,0,.8), rgba(255,0,0,0) 70.71%), linear-gradient(127deg, rgba(0,255,0,.8), rgba(0,255,0,0) 70.71%), linear-gradient(336deg, rgba(0,0,255,.8), rgba(0,0,255,0) 70.71%)";
                break;
            default:
                element.style.backgroundColor = "grey";
                break;
        };
    });
};

//Code principal
document.addEventListener('DOMContentLoaded', function() {
    
    AvancementColorisation();

});
