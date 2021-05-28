function onSelected() {
    const $indexQuestion = document.getElementById("indexQuestion");
    const $scoreQuestion = document.getElementById("scoreQuestion");
    const $scoreTopic = document.getElementById("scoreTopic");
    const $animatedDiv = document.querySelector(".animated_div");
    const $linkNextQuestion = document.getElementById("nextQuestion");

    console.log($linkNextQuestion.href);

    let index = parseInt($indexQuestion.innerHTML);
    let score;

    if (index === 1) {
        score = 0;
        sessionStorage.removeItem("score");
    } else {
        score = sessionStorage.getItem("score");
    }

    //on enleve l'ecouteur
    this.removeEventListener("click", onSelected);

    index++;

    // si la personne a cliqué sur la BONNE REPONSE
    if (this === document.getElementById("goodAnswer")) {
        this.classList.add("goodSelected");

        // le score est incrémenté 
        score++;
        sessionStorage.setItem("score", score);

        $scoreQuestion.innerHTML = 1;
        $scoreTopic.innerHTML = score;

        $animatedDiv.classList.add("active");

        // SI ON ARRIVE A LA FIN DES QUESTIONS
        if (index == 6) {

            $linkNextQuestion.href += `&s=${score}`;
        } else {

            $linkNextQuestion.href += `&s=${score}`;
        }

        // SI LA PERSONNE A CLIQUE SUR LA MAUVAISE REPONSE
    } else {
        this.classList.add("errorSelected");

        $scoreQuestion.innerHTML = 0;
        $scoreTopic.innerHTML = score;

        // SI ON ARRIVE A LA FIN DES QUESTIONS
        if (index == 6) {
            $linkNextQuestion.href += `&s=${score}`;
        } else {

            $linkNextQuestion.href += `&s=${score}`;
        }
    }

    answerResult();
}

// Cette fonction ajoute les classes goodSelected ou errorSelected aux réponses.
function answerResult() {
    const $answers = document.querySelectorAll(".answer");

    for (let i = 0; i < $answers.length; i++) {
        $answers[i].removeEventListener("click", onSelected);

        if ($answers[i] === document.getElementById("goodAnswer")) {
            $answers[i].classList.add("goodSelected");
        } else {
            $answers[i].classList.add("errorSelected");
        }
    }
}

// code principal

document.addEventListener("DOMContentLoaded", () => {
    const $answers = document.querySelectorAll(".answer");

    for (let i = 0; i < $answers.length; i++) {
        $answers[i].addEventListener("click", onSelected);
    }
});