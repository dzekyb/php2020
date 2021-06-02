// add new option to question on edit page
// when user selects option or question field to update hide edit and delete icons from other fields
// so the user can update only one field at a time
// selected field shows save and cancel button, so user can save the change
// check if user updated image in file input and change the label and span text

const editbtns = document.querySelectorAll('.form .edit-icon');
const calcelBtns = document.querySelectorAll('.cancel');
const options = document.querySelectorAll('.edit-form__option');
const questions = document.querySelectorAll('.edit-form__question-container');
const calculator = document.querySelector('.calculator-form');

 

for(let edit of editbtns) {
    edit.addEventListener('click', e => {
        disableInput();
        currentOption = e.currentTarget.parentElement.parentElement;
        currentOption.classList.remove('disabled');
        currentOption.classList.add('active');
        const inputs = currentOption.querySelectorAll('input');
        const textarea = currentOption.querySelectorAll('textarea');
        let img = currentOption.querySelector('img');
        let value = img.getAttribute('src');
        let inputValues = [];
        for(let input of inputs) {
            input.removeAttribute('disabled');
            inputValues.push(input.value);
        }
        if(textarea) {
            for(let text of textarea) {
                text.removeAttribute('disabled');
            }
        }
        const cancel = currentOption.querySelector('.cancel');

        cancel.addEventListener('click', e => {
            e.preventDefault();
            removeClasses();
            for(let i = 0; i < inputs.length; i++) {
                inputs[i].value = inputValues[i];
                inputs[i].setAttribute('disabled', 'true');
            }
            if(textarea) {
                for(let text of textarea) {
                    text.setAttribute('disabled', 'true');
                }
            }
            if(img) {
                if(value) {
                    img.src = value;
                } else {
                    img.src = "";
                }
            }
        })
    })
}

// for(const cancel of calcelBtns) {
//     cancel.addEventListener('click', e => {
//         e.preventDefault();
//         removeClasses();
//         const currentOption = e.currentTarget.parentElement;
//         const inputs = currentOption.querySelectorAll('input');
//         const textarea = currentOption.querySelectorAll('textarey');
//         for(let input of inputs) {
//             input.setAttribute('disabled', 'true');
//         }
//         if(textarea) {
//             for(let text of textarea) {
//                 text.setAttribute('disabled', 'true');
//             }
//         }
//     })
// }

const addOptions = document.querySelectorAll('.add-option');

for(const addOption of addOptions) {
    addOption.addEventListener('click', e => {
            e.preventDefault();
            const questionContainer = e.currentTarget.parentElement;
            const optionContainer = questionContainer.querySelector('.calculator-option');
            const optionCount = optionContainer.querySelectorAll('.edit-form__option').length + 1;   
            const optionDiv = document.createElement('div');
            optionDiv.classList.add('edit-form__option');
            optionDiv.classList.add('active');
            const id = questionContainer.getAttribute('data-id');
            optionDiv.innerHTML = `
                    <h3>Option ${optionCount}</h3>
                    <div>
                            <label for="name-${optionCount}">Answer</label>
                            <input type="text" name="${id}-name" id="name-${optionCount}" placeholder="Answer">
                    </div>
                    <div>
                            <label for="price-${optionCount}">Price</label>
                            <input type="number" name="${id}-price" id="price-${optionCount}" placeholder="Price">
                    </div>
                    <div>
                            <label for="url-${optionCount}" class="file__label">Upload Image</label>
                            <input type="file" name="${id}-url" id="url-${optionCount}" class="new-option">
                            <img src="" class="option__image">
                    </div>
                    <div class="edit-buttons">
                        <button name="submit" class="save"> Save </button>
                        <button class="cancel addCancel"> Cancel </button>
                    </div>
            `
            optionContainer.appendChild(optionDiv);
            disableInput();
    })
}

const calculatorOptions = document.querySelectorAll('.calculator-option');

for(let calculatorOption of calculatorOptions) {
    calculatorOption.addEventListener('click', e =>{
        if(e.target.classList.contains('addCancel')) {
            e.currentTarget.removeChild(e.currentTarget.lastElementChild);
            removeClasses();
        }
        if(e.target.classList.contains('new-option')) {
            e.target.addEventListener('change', event => {
                const container = event.target.parentElement;
                const img = container.querySelector('img');
                const label = container.querySelector('label');
                if(event.target.files.length > 0) {
                    img.src = URL.createObjectURL(event.target.files[0]);
                    img.onload = function() {
                        URL.revokeObjectURL(img.src);
                    }
                }
            });
        };
    });
}   

function disableInput() {
    for(let option of options) {
        option.classList.add('disabled');
    }
    for(let question of questions) {
        question.classList.add('disabled');
    }
}

function removeClasses() {
    for(let option of options) {
        option.classList.remove('active');
        option.classList.remove('disabled');
    }
    for(let question of questions) {
        question.classList.remove('active');
        question.classList.remove('disabled');
    }
    calculator.classList.remove('active');
    calculator.classList.remove('disabled');
}

const files = document.querySelectorAll('input[type="file"]');
const fileLabels = document.querySelectorAll('.file__label');
for(const file of files) {
        const container = file.parentElement;
        const value = file.getAttribute('value');
        const label = container.querySelector('label');
        if(value) {
            label.innerHTML = 'Image uploaded';
        }
}
for(const file of files) {
    file.addEventListener('change', () => {
        const container = file.parentElement;
        const img = container.querySelector('img');
        const label = container.querySelector('label');
        if(file.files.length > 0) {
            img.src = URL.createObjectURL(file.files[0]);
            img.onload = function() {
                URL.revokeObjectURL(img.src);
            }
        }
    });
}


const saveBtns = document.querySelectorAll('.save__option');
for(const save of saveBtns) {
    save.addEventListener('click', e => {
        const currentOption = e.currentTarget.parentElement.parentElement;
        const inputs = currentOption.querySelectorAll('input[type="text"], input[type="number"]');
        for(let input of inputs) {   
            if(input.value.length < 1) {
                e.preventDefault();
                let error = currentOption.querySelector('.error-message');
                error.style.display = "block";
                error.innerHTML = 'Option and price field can\'t be empty';
                setTimeout(function hide() {error.style.display = "none"}, 1500);
            }
        }
    });
}

const calcBtns = document.querySelectorAll('.save__calc');
for(const calc of calcBtns) {
    calc.addEventListener('click', e => {
        const container = e.currentTarget.parentElement;
        const inputs = currentOption.querySelectorAll('input[type="text"], input[type="number"], textarea');
        for(let input of inputs) {
            if(input.value.length < 1) {
                e.preventDefault();
                let error = container.querySelector('.error-message');
                error.style.display = "block";
                error.scrollIntoView();
                error.innerHTML = 'Fields can\'t be empty';
                setTimeout(function hide() {error.style.display = "none"}, 2000);
            }
        }
    });
}