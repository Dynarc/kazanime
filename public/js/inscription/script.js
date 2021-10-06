let body = document.querySelector('body');
let section = document.querySelector('.login');


function changeBackground(){
    body.classList += " newBackground";
    test = document.createElement('a');
    test.innerHTML = '<small>Fond vecteur créé par brgfx - fr.freepik.com</small>';
    test.setAttribute('href','https://fr.freepik.com/vecteurs/fond')
    section.nextElementSibling.prepend(test);
}

changeBackground();