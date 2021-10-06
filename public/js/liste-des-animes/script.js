let button = document.querySelector('button');
let champsFormulaire = document.querySelectorAll('#anime-list-search div');

function toggleForm(){

    let display = champsFormulaire[4].style.display == 'flex' ? 'none' : 'flex';
    console.log(champsFormulaire);

    champsFormulaire[5].style.display =
    champsFormulaire[4].style.display = 
    champsFormulaire[3].style.display =
    champsFormulaire[2].style.display = display;
}


button.addEventListener('click', toggleForm);