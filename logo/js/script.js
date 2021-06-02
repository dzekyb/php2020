// displaying new question from calculator and scrolling to it
const divs = document.querySelectorAll('.input-wrapper');
const inputs = document.querySelectorAll('input[type="radio"]');
const startBtn = document.querySelector('.intro .intro__button');
const intro = document.querySelector('.intro');
let count = 0;

startBtn.addEventListener('click', e => {
    e.preventDefault();
    intro.style.display = "none";
    show();
})

for( let input of inputs) {
    input.addEventListener('click', () => {
        show();
    })
}

function show() {
    if(count < divs.length) {
    divs[count].classList.add('active');
    divs[count].scrollIntoView();
    count++;
    }
}
