//Fonctions JS pour la navbar & couleur de l'avancement du score

// Permet de mettre en couleur dans la navigation, la page selectionnée
function onSelected() {
    for (let i = 0 ; i < $links.length ; i++ ) {
        if ( $links[i].classList.contains("selected") ) {
            $links[i].classList.remove('selected');
        }
    }
    this.classList.add('selected');
};



    // Colorisation de l'avancement suivant le score
function AvancementColorisation() {

    const $avancement = document.querySelectorAll('.avancement');

    console.log($avancement)

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
                // element.style.background = "linear-gradient(217deg, rgba(255,0,0,.8), rgba(255,0,0,0) 70.71%), linear-gradient(127deg, rgba(0,255,0,.8), rgba(0,255,0,0) 70.71%), linear-gradient(336deg, rgba(0,0,255,.8), rgba(0,0,255,0) 70.71%)";
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



document.addEventListener('DOMContentLoaded', function () {
    
    // NAVBAR 
    const $links = document.querySelectorAll('nav li');
    

    for (let i = 0; i<$links.length; i++) {
        $links[i].addEventListener('click', onSelected);
    }

    // Fin de NAVBAR




    // Colorisation de l'avancement 

    AvancementColorisation();


});

























// Faire une couleur au hasard

// function getRandomColor() {
//     var letters = '0123456789ABCDEF';
//     var color = '#';
//     for (var i = 0; i < 6; i++) {
//         color += letters[Math.floor(Math.random() * 16)];
//     }
//     return color;
// }


// function setRandomColor() {
//     Element.querySelector('h1 span').css

//     $("h1 span").css("background-color", getRandomColor());
// }