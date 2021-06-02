// modal for calculators, confirms that user wants to delete the calculator

const calculators = document.querySelectorAll('.calculator');

for(const calculator of calculators) {
    calculator.addEventListener('click', e => {
        if(e.target.classList.contains('delete')) {
            let modal = calculator.querySelector('.modal-overlay');
            modal.classList.add('active');
        }
    });
}

const aborts = document.querySelectorAll('.cancel');

for(let abort of aborts) {
    abort.addEventListener('click', () => {
        abort.parentElement.parentElement.parentElement.classList.remove('active');
    })
}