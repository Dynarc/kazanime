let submit = document.querySelector('section input[type="submit"]');
let searchAnime = document.querySelector('section input');

let formSuite = document.querySelector('.proposition-suite-form');
let titleSuite = document.querySelector('.proposition-suite-titre');
let hidden = document.querySelector('.proposition-suite-form input[type="hidden"]')

let errorMessage = document.createElement('small');
errorMessage.style.color = 'red';

function request(e){
    e.preventDefault();
    getApi();
}

function getApi(){
    let data = new FormData(document.querySelector('section form'));
    // hard link
    fetch("http://localhost/Kazanime/search", {
	    method: "POST",
        body: data
    })
    .then(response => response.text())
    .then(response => {
        if (response == "error"){
            errorMessage.innerHTML = "Veuillez mettre le titre de l'anime que vous voulez rajouter"
        } else if (response == ''){
            formSuite.style.display = titleSuite.style.display = "block";
            submit.style.display = "none";
            hidden.value = searchAnime.value;
            errorMessage.innerHTML = '';
        } else {
            errorMessage.innerHTML = "L'anime est déjà dans notre base de données";
        }
        submit.parentElement.append(errorMessage);
    })
    .catch(err => {
        console.error(err);
    });
}

submit.addEventListener('click', request)