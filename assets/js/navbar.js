//Fonctions JS

// MARCHE PLUS ?

// 1. La fonction onSelected() permet de mettre en couleur dans la navigation, la page selectionnée

const $links = document.querySelectorAll('nav li');

console.log($links)

function onSelected() {
    for (let i = 0 ; i < $links.length ; i++ ) {
        if ( $links[i].classList.contains("selected") ) {
            $links[i].classList.remove('selected');
        }
    }
    this.classList.add('selected');
}

document.addEventListener('DOMContentLoaded', function(){
    for (let i = 0; i<$links.length; i++) {
        $links[i].addEventListener('click', onSelected);
    }
});

// fin du 1.























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