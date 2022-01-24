let carousel = document.querySelectorAll('.carousel-frame');
let nextButton = document.querySelector('.fa-chevron-right');
let previousButton = document.querySelector('.fa-chevron-left');

function nextFrame(size){
    carousel.forEach(element => {
        let right = element.style.right;
        let valueRight = +right.slice(0,right.length-1);
        
        if(valueRight+100 < carousel.length*size){
            valueRight += size; 
            element.style.right = valueRight+'%';
        }
    });
}

function previousFrame(size){
    carousel.forEach(element => {
        let right = element.style.right;
        let valueRight = +right.slice(0,right.length-1);
        
        if(valueRight > 0){
            valueRight -= size; 
            element.style.right = valueRight+'%';
        }
    });
}

/**
 * eventListener for carousel
 *! When window.visualViewport.width > 500, only one frame is displayed on the carousel
 *! else, two are displayed
 *? So we move by 50% if two frames are displayed, 100% if only one
 */
nextButton.addEventListener('click', () => nextFrame(window.visualViewport.width > 500 ? 50 : 100));
previousButton.addEventListener('click', () => previousFrame(window.visualViewport.width > 500 ? 50 : 100));


// Prevent carousel from glitching because of responsive width and position changes => position reset
carousel[0].addEventListener('transitionrun', (e)=>{
    if(e.propertyName === "min-width") {
        carousel.forEach(element => {
            element.style.right = '0%';
        });
    }
});