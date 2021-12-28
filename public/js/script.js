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

// event nav's search bar
openSearch.addEventListener('click', displaySearchBar);
closeSearch.addEventListener('click', hideSearchBar);