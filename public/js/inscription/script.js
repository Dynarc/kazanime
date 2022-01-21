let body = document.querySelector('body');
let footer = document.querySelector('footer');


function changeBackground(){
    body.classList.add("newBackground");
    link = document.createElement('a');
    link.innerHTML = '<small>Fond vecteur créé par brgfx - fr.freepik.com</small>';
    link.setAttribute('href','https://fr.freepik.com/vecteurs/fond')
    link.setAttribute('target','_blank')
    footer.prepend(link);
}

changeBackground();