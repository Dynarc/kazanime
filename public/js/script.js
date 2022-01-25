let openSearch = document.querySelector('.fa-search');
let closeSearch = document.querySelector('.fa-times');
let search = document.querySelector('.search');
let kazanime = document.querySelector('#brand>h1');
let menu = document.querySelector('nav');
let openMenu = document.querySelector('.responsive-menu>.fa-bars');
let closeMenu = document.querySelector('.responsive-menu>.fa-times');


function displaySearchBar(){
    search.style.display = 'flex';
}

function hideSearchBar(){
    search.style.display = 'none';
}

/*
   Message d'alerte type (échec) :
 *  <div class="message echec">
 *      <div>
 !          <progress max="200" value="0"></progress>
 *          <p>Erreur 1<i class="fas fa-times"></i></p>
 *      </div>
 *      <div>
 !          <progress max="200" value="0"></progress>
 *          <p>Erreur 2<i class="fas fa-times"></i></p>
 *      </div>
 *  </div>
*/

/** 
 * Add progress bar for each alert message and start them
 * Add eventListener on icon to remove manually the message 
*/
function displayMessage() {
    let messages = document.querySelector('.message');
    if(messages) {
        for (const message of messages.children) {
            message.innerHTML = '<progress max="200" value="0"></progress>' + message.innerHTML;
            barProgression(message.firstChild, 30);
            message.lastChild.lastChild.addEventListener('click', () => message.remove());
        }
    }
}

/**
 *  Incrementing progress bar and delete it when it's finished
 *  @param element Element (progress here) to focus
 *  @param time Time between incrementing
*/  
function barProgression(element, time) {
    if(element.value < element.max) {
        element.value ++;
        setTimeout(() => barProgression(element, time),time);
    } else {
        element.parentElement.remove();
    }
}

function displayResponsiveMenu(e) {
    menu.classList.toggle("responsive-nav");
    if(e.target === openMenu) {
        openMenu.style.display = 'none';
        closeMenu.style.display = 'inline-block';
    } else if (e.target === closeMenu) {
        openMenu.style.display = 'inline-block';
        closeMenu.style.display = 'none';
    }
}

// event nav's search bar
openSearch.addEventListener('click', displaySearchBar);
closeSearch.addEventListener('click', hideSearchBar);

// Display responsive menu
openMenu.addEventListener('click', displayResponsiveMenu);
closeMenu.addEventListener('click', displayResponsiveMenu);

// Display error or succes messages
window.onload = displayMessage();