// add new option to question on add_question page
// check if user uploaded image and change label and span text
const addOption = document.querySelector('.add-option');

addOption.addEventListener('click', e => {
        e.preventDefault();
        let optionContainer = document.querySelector('.calculator-option');
        let optionCount = optionContainer.querySelectorAll('.edit-form__option').length + 1;   

        const optionDiv = document.createElement('div');
        optionDiv.classList.add('edit-form__option');
        optionDiv.innerHTML = `
                <h3>Option ${optionCount}</h3>
                <div>
                        <label for="name-${optionCount}">Answer</label>
                        <input type="text" name="${optionCount}name" id="name-${optionCount}" placeholder="Answer">
                </div>
                <div>
                        <label for="price-${optionCount}">Price</label>
                        <input type="number" name="${optionCount}price" id="price-${optionCount}" placeholder="Price">
                </div>
                <div>
                        <label for="url-${optionCount}" class="file__label">Upload Image</label>
                        <input type="file" name="${optionCount}url" id="url-${optionCount}" class="new-option">
                        <img src="" class="option__image">
                </div>
        
        `
        optionContainer.appendChild(optionDiv);
})

const files = document.querySelectorAll('input[type="file"]');

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

document.querySelector('.calculator-option').addEventListener('click', e => {
        if(e.target.classList.contains('new-option')) {
            let input = e.target;
            input.addEventListener('change', () => {
                const container = input.parentElement;
                const img = container.querySelector('img');
                if(input.files.length > 0) {
                    img.src = URL.createObjectURL(input.files[0]);
                    img.onload = function() {
                        URL.revokeObjectURL(img.src);
                    }
            }
            });
        }
});