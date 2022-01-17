let openSearch = document.querySelector('.fa-search');
let closeSearch = document.querySelector('.fa-times');
let search = document.querySelector('.search');
let kazanime = document.querySelector('#brand>h1');


function displaySearchBar(){
    search.style.display = 'flex';
}

function hideSearchBar(){
    search.style.display = 'none';
}



function displayMessage() {
    let messages = document.querySelector('.message');
    if(messages) {
        for (let i = 0; i < messages.children.length; i++) {
            let message = messages.children[i];
            message.innerHTML = '<progress max="200" value="0"></progress>' + message.innerHTML;
            barProgression(message.firstChild, 30);
            message.lastChild.lastChild.addEventListener('click', () => message.remove());
        }
    }
}

function barProgression(element, time) {
    if(element.value < 200) {
        element.value += 1;
        setTimeout(() => barProgression(element, time),time);
    } else {
        clearTimeout(barProgression);
        element.parentElement.remove();
    }
}

// event nav's search bar
openSearch.addEventListener('click', displaySearchBar);
closeSearch.addEventListener('click', hideSearchBar);

// Display error or succes messages
displayMessage();