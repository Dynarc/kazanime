let carousel = document.querySelectorAll('.carousel-frame');
let nextButton = document.querySelector('.fa-chevron-right');
let previousButton = document.querySelector('.fa-chevron-left');

function nextFrame(){
    if(window.visualViewport.width > 500) {
        carousel.forEach(element => {
            let right = element.style.right;
            let valueRight = +right.slice(0,right.length-1);
            
            if(valueRight+100 < carousel.length*50){
                valueRight += 50; 
                element.style.right = valueRight+'%';
            }
        });
    } else {
        carousel.forEach(element => {
            let right = element.style.right;
            let valueRight = +right.slice(0,right.length-1);
            
            if(valueRight+100 < carousel.length*100){
                valueRight += 100; 
                element.style.right = valueRight+'%';
            }
        });
    }
    
}

function previousFrame(){
    if(window.visualViewport.width > 500) {
        carousel.forEach(element => {
            let right = element.style.right;
            let valueRight = +right.slice(0,right.length-1);
            
            if(valueRight > 0){
                valueRight -= 50; 
                element.style.right = valueRight+'%';
            }
        });
    } else {
        carousel.forEach(element => {
            let right = element.style.right;
            let valueRight = +right.slice(0,right.length-1);
            
            if(valueRight > 0){
                valueRight -= 100; 
                element.style.right = valueRight+'%';
            }
        });
    }
}

// event carousel
nextButton.addEventListener('click', nextFrame);
previousButton.addEventListener('click', previousFrame);


// Prevent carousel to glitch due to width and position changes
carousel[0].addEventListener('transitionrun', (e)=>{
    if(e.propertyName === "min-width") {
        carousel.forEach(element => {
            element.style.right = '0%';
        });
    }
});