let carousel = document.querySelectorAll('.carousel-frame');
let nextButton = document.querySelector('.fa-chevron-right');
let previousButton = document.querySelector('.fa-chevron-left');

function nextFrame(){
    carousel.forEach(element => {
        let right = element.style.right;
        let valueRight = +right.slice(0,right.length-1);
        
        if(valueRight+100 < carousel.length*50){
            valueRight += 50; 
            element.style.right = valueRight+'%'
        }
    });
}

function previousFrame(){
    carousel.forEach(element => {
        let right = element.style.right;
        let valueRight = +right.slice(0,right.length-1);
        
        if(valueRight > 0){
            valueRight -= 50; 
            element.style.right = valueRight+'%'
        }
    });
}

// event carousel
nextButton.addEventListener('click', nextFrame);
previousButton.addEventListener('click', previousFrame);