let carousel = document.querySelectorAll('.carousel-frame');
let nextButton = document.querySelector('.fa-chevron-right');
let previousButton = document.querySelector('.fa-chevron-left');
let openSearch = document.querySelector('.fa-search');
let closeSearch = document.querySelector('.fa-times');
let search = document.querySelector('.search');


function nextFrame(){
    carousel.forEach(element => {
        let right = element.style.right;
        let left = element.style.left;
        let valueRight = +right.slice(0,right.length-1);
        let valueLeft = +left.slice(0,left.length-1);

        if(valueRight-valueLeft+100 < carousel.length*50){
            valueRight += 50; 
            element.style.right = valueRight+'%'
        }
    });
}

function previousFrame(){
    carousel.forEach(element => {
        let right = element.style.right;
        let left = element.style.left;
        let valueRight = +right.slice(0,right.length-1);
        let valueLeft = +left.slice(0,left.length-1);

        if(valueRight-valueLeft > 0){
            valueRight -= 50; 
            element.style.right = valueRight+'%'
        }
    });
}

function displaySearchBar(){
    search.style.display = 'flex';
}

function hideSearchBar(){
    search.style.display = 'none';
}



// event carousel
nextButton.addEventListener('click', nextFrame);
previousButton.addEventListener('click', previousFrame);

// event nav's search bar
openSearch.addEventListener('click', displaySearchBar);
closeSearch.addEventListener('click', hideSearchBar);