let button = document.querySelector('button');
let champsFormulaire = document.querySelectorAll('#anime-list-search div');

function toggleForm(){

    let display = champsFormulaire[5].style.display == 'none' ? 'flex' : 'none';

    champsFormulaire[5].style.display = display;
    champsFormulaire[4].style.display = display;
    champsFormulaire[3].style.display = display;
    champsFormulaire[2].style.display = display;
}


button.addEventListener('click', toggleForm);