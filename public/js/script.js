let carousel = document.querySelectorAll('.carousel-frame');
let nextButton = document.querySelector('.fa-chevron-right');
let previousButton = document.querySelector('.fa-chevron-left');


function nextFrame(){
    // select all the elements of the carousel
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




nextButton.addEventListener('click', nextFrame);
previousButton.addEventListener('click', previousFrame);