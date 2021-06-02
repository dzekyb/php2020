

if(window.location.href.indexOf('add_invoice') != -1) {
  add_invoice();
} else if(window.location.href.indexOf('update_invoice') != -1) {
  update_invoice();
} else if(window.location.href.indexOf('add_article') != -1) {
    add_article();
} else if(window.location.href.indexOf('add_bill') != -1) {
    add_bill();
} else if(window.location.href.indexOf('add_client') != -1) {
    add_client();
} else if(window.location.href.indexOf('add_firm') != -1) {
    add_firm();
} else if(window.location.href.indexOf('articles') != -1) {
    articles();
} else if(window.location.href.indexOf('bills') != -1) {
    bills();
} else if(window.location.href.indexOf('invoices') != -1) {
    invoices(); 
} else if(window.location.href.indexOf('login') != -1) {
    login();
} else if(window.location.href.indexOf('register') != -1) {
    register();
} else if(window.location.href.indexOf('update_client') != -1) {
    update_client(); 
} else if(window.location.href.indexOf('update_firm') != -1) {
    update_firm();
}




function add_article() {
    const newArticle = document.getElementById('newArticle');

    newArticle.addEventListener('submit', e => {
        e.preventDefault();
        let formData = new FormData(newArticle);
        formData.append('submit', '');
        const url = 'include/articles.inc.php';
        let inputs = newArticle.querySelectorAll('input, select');
        let errorArray = [];
        isEmpty(inputs, errorArray);
        if(errorArray.length < 1) {
            postData(url, formData)
            .then(result => {
                if(!result) {
                    document.querySelector('.success-message').innerHTML = 'Uspješno dodano';
                    document.querySelector('.success-message').style.padding = '0.5rem 1rem';
                    removeErrorTextAndBorderColor(newArticle);
                    setTimeout(function() {
                        document.querySelector('.success-message').innerHTML = '';
                        document.querySelector('.success-message').style.padding = '0';
                        removeInputValues();
                    }, 1000);
                } else {
                    let errorMessages = document.querySelectorAll('.registration-form__error');
                    for(let errorMessage of errorMessages) {
                        errorMessage.innerHTML = '';
                    }
                    let inputs = document.querySelectorAll('input, textarea');
                    for(let input of inputs) {
                        input.style.borderColor = '#ced4da';
                    }
                    for(const [key, value] of Object.entries(result)) {
                        field =    document.querySelector(`input[name="${key}"]`) ?
                                document.querySelector(`input[name="${key}"]`) 
                                : document.querySelector(`textarea[name="${key}"]`);
                        field.style.borderColor = '#a94442';
                        field.parentElement.querySelector('.registration-form__error').innerHTML = value;
                    }
                }
            });
        }
    });


    function isEmpty(inputs, errorArray) {
        for(let input of inputs) {
            if(input.value == '') {
                input.style.borderColor = '#a94442';
                input.classList.remove('h-100');
                input.parentElement.querySelector('.registration-form__error').innerHTML = 'Polje ne smije biti prazno';
                errorArray.push('error');
            } else {
                input.style.borderColor = '#ced4da';
                input.parentElement.querySelector('.registration-form__error').innerHTML = '';
            }
        }
    }


    async function postData(url, data) {
        const response = await fetch(url, {
            method: 'POST',
            body: data
        });
        return response.json(); // parses JSON response into native JavaScript object
    }

    function removeInputValues() {
        let inputs = document.querySelectorAll('input, textarea');
        for(let input of inputs) {
            input.value = '';
        }
    }

    function removeErrorTextAndBorderColor(container) {
        let errorMessages = container.querySelectorAll('.registration-form__error');
        for(let errorMessage of errorMessages) {
            errorMessage.innerHTML = '';
        }
        let inputs = container.querySelectorAll('input, textarea, select');
        for (let input of inputs) {
            input.style.borderColor = '#ced4da'
        }
    }
}

function add_bill() {
    const fileUploads = document.querySelectorAll('.form__input-file');

    showImagePreviewOnChange(fileUploads);

    const firmForm = document.querySelector('form');

    firmForm.addEventListener('submit', e => {
        e.preventDefault();
        let formData = new FormData(firmForm);
        formData.append('submit', '');
        const url = 'include/add_bill.inc.php';
        let inputs = document.querySelectorAll('input[type="text"], select');
        let errorArray = [];
        isEmpty(inputs, errorArray);
        if(errorArray.length < 1) {
            postData(url, formData)
            .then(result => {
                if(result['success']) {
                    document.querySelector('.success-message').innerHTML = 'Uspješno dodano';
                    document.querySelector('.success-message').style.padding = '0.5rem 1rem';
                    removeInputValues();
                    setTimeout(function() {
                        window.location.href = 'bills';
                        document.querySelector('.success-message').innerHTML = '';
                        document.querySelector('.success-message').style.padding = '0';
                    }, 1000);
                } else {
                    let errorMessages = document.querySelectorAll('.registration-form__error');
                    for(let errorMessage of errorMessages) {
                        errorMessage.innerHTML = '';
                    }
                    let inputs = document.querySelectorAll('input');
                    for(let input of inputs) {
                        input.style.borderColor = '#ced4da';
                    }
                    for(const [key, value] of Object.entries(result)) {
                        field =    document.querySelector(`input[name="${key}"]`);
                        field.style.borderColor = '#a94442';
                        field.parentElement.querySelector('.registration-form__error').innerHTML = value;
                    }
                }
            });
        }
    }); 



    // ### FUNCTIONS ###

    async function postData(url, data) {
        const response = await fetch(url, {
            method: 'POST',
            body: data
        });
        return response.json(); // parses JSON response into native JavaScript object
    }

    function isEmpty(inputs, errorArray) {
        for(let input of inputs) {
            if(input.value == '' && !input.disabled) {
                input.style.borderColor = '#a94442';
                input.parentElement.querySelector('.registration-form__error').innerHTML = 'Polje ne smije biti prazno';
                errorArray.push('error');
            } else {
                input.style.borderColor = '#ced4da';
                input.parentElement.querySelector('.registration-form__error').innerHTML = '';
            }
        }
    }


    function removeInputValues() {
        let inputs = document.querySelectorAll('input, textarea');
        for(let input of inputs) {
            input.value = '';
        }
    }

    function removeImages() {
        let images = document.querySelectorAll('img');
        for(let img of images) {
            img.src = '';
        }
    }

    function removeErrorTextAndBorderColor(container) {
        let errorMessages = container.querySelectorAll('.registration-form__error');
        for(let errorMessage of errorMessages) {
            errorMessage.innerHTML = '';
        }
        let inputs = container.querySelectorAll('input, textarea, select');
        for (let input of inputs) {
            input.style.borderColor = '#ced4da'
        }
    }
}


function add_client() {
    // ### IMAGE PREVIEW ###

    const fileUploads = document.querySelectorAll('.form__input-file');

    showImagePreviewOnChange(fileUploads);

    // ### DISPLAY AND HIDE INPUT FIELD

    let radioInputs = document.querySelectorAll('input[type="radio"]');

    for(let input of radioInputs) {
        input.addEventListener('click', () => {
            let pib = document.querySelector('.pib');
            if(input.checked && input.value == '1') {
                pib.parentElement.style.display = 'block';
                pib.removeAttribute('disabled');
            } else {
                pib.parentElement.style.display = 'none';
                pib.setAttribute('disabled', 'true');
            }
        });
    }

    // ### HANDLE ADD FIRM SUBMIT ###

    const firmForm = document.querySelector('form');

    firmForm.addEventListener('submit', e => {
        e.preventDefault();
        let formData = new FormData(firmForm);
        formData.append('submit', '');
        const url = 'include/add_client.inc.php';
        let inputs = document.querySelectorAll('#ime');
        let errorArray = [];
        isEmpty(inputs, errorArray);
        if(errorArray.length < 1) {
            postData(url, formData)
            .then(result => {
                if(result['success']) {
                    document.querySelector('.success-message').innerHTML = 'Uspješno dodano';
                    document.querySelector('.success-message').style.padding = '0.5rem 1rem';
                    removeErrorTextAndBorderColor(firmForm);
                    removeInputValues();
                    removeImages(firmForm);
                    setTimeout(function() {
                        document.querySelector('.success-message').innerHTML = '';
                        document.querySelector('.success-message').style.padding = '0';
                        window.location.href = 'clients';
                    }, 1000)
                } else {
                    let errorMessages = document.querySelectorAll('.registration-form__error');
                    for(let errorMessage of errorMessages) {
                        errorMessage.innerHTML = '';
                    }
                    let inputs = document.querySelectorAll('input');
                    for(let input of inputs) {
                        input.style.borderColor = '#ced4da';
                    }
                    for(const [key, value] of Object.entries(result)) {
                        field =    document.querySelector(`input[name="${key}"]`);
                        field.style.borderColor = '#a94442';
                        field.parentElement.querySelector('.registration-form__error').innerHTML = value;
                    }
                }
            });
        }
    }); 



    // ### FUNCTIONS ### 

    async function postData(url, data) {
        const response = await fetch(url, {
            method: 'POST',
            body: data
        });
        return response.json(); // parses JSON response into native JavaScript object
    }

    function isEmpty(inputs, errorArray) {
        for(let input of inputs) {
            if(input.value == '' && !input.disabled) {
                input.style.borderColor = '#a94442';
                input.parentElement.querySelector('.registration-form__error').innerHTML = 'Polje ne smije biti prazno';
                errorArray.push('error');
            } else {
                input.style.borderColor = '#ced4da';
                input.parentElement.querySelector('.registration-form__error').innerHTML = '';
            }
        }
    }



    function removeInputValues() {
        let inputs = document.querySelectorAll('input, textarea');
        for(let input of inputs) {
            input.value = '';
        }
    }

    function removeImages(container) {
        let images = container.querySelectorAll('img');
        for(let img of images) {
            img.src = '';
        }
    }

    function removeErrorTextAndBorderColor(container) {
        let errorMessages = container.querySelectorAll('.registration-form__error');
        for(let errorMessage of errorMessages) {
            errorMessage.innerHTML = '';
        }
        let inputs = container.querySelectorAll('input, textarea, select');
        for (let input of inputs) {
            input.style.borderColor = '#ced4da'
        }
    }
}



function add_firm() {
    // ### IMAGE PREVIEW ###

    const fileUploads = document.querySelectorAll('.form__input-file');

    showImagePreviewOnChange(fileUploads);

    // ### DISPLAY AND HIDE INPUT FIELD

    let radioInputs = document.querySelectorAll('input[type="radio"]');

    for(let input of radioInputs) {
        input.addEventListener('click', () => {
            let pib = document.querySelector('.pib');
            if(input.checked && input.value == '1') {
                pib.parentElement.style.display = 'block';
                pib.removeAttribute('disabled');
            } else {
                pib.parentElement.style.display = 'none';
                pib.setAttribute('disabled', 'true');
            }
        });
    }

    // ### HANDLE ADD FIRM SUBMIT ### 

    const firmForm = document.querySelector('form');

    firmForm.addEventListener('submit', e => {
        e.preventDefault();
        let formData = new FormData(firmForm);
        formData.append('submit', '');
        const url = 'include/add_firm.inc.php';
        let inputs = document.querySelectorAll('#ime');
        let errorArray = [];
        isEmpty(inputs, errorArray);
        if(errorArray.length < 1) {
            postData(url, formData)
            .then(result => {
                if(result['success']) {
                    document.querySelector('.success-message').innerHTML = 'Uspješno dodano';
                    document.querySelector('.success-message').style.padding = '0.5rem 1rem';
                    setTimeout(function() {
                        document.querySelector('.success-message').innerHTML = '';
                        document.querySelector('.success-message').style.padding = '0';
                        window.location.href = 'firms';
                    }, 1000)
                } else {
                    let errorMessages = document.querySelectorAll('.registration-form__error');
                    for(let errorMessage of errorMessages) {
                        errorMessage.innerHTML = '';
                    }
                    let inputs = document.querySelectorAll('input');
                    for(let input of inputs) {
                        input.style.borderColor = '#ced4da';
                    }
                    for(const [key, value] of Object.entries(result)) {
                        field =    document.querySelector(`input[name="${key}"]`);
                        field.style.borderColor = '#a94442';
                        field.parentElement.querySelector('.registration-form__error').innerHTML = value;
                    }
                }
            });
        }
    }); 



    // ### FUNCTIONS ###

    async function postData(url, data) {
        const response = await fetch(url, {
            method: 'POST',
            body: data
        });
        return response.json(); // parses JSON response into native JavaScript object
    }

    function isEmpty(inputs, errorArray) {
        for(let input of inputs) {
            if(input.value == '' && !input.disabled) {
                input.style.borderColor = '#a94442';
                input.parentElement.querySelector('.registration-form__error').innerHTML = 'Polje ne smije biti prazno';
                errorArray.push('error');
            } else {
                input.style.borderColor = '#ced4da';
                input.parentElement.querySelector('.registration-form__error').innerHTML = '';
            }
        }
    }


    function removeInputValues() {
        let inputs = document.querySelectorAll('input, textarea');
        for(let input of inputs) {
            input.value = '';
        }
    }

    function removeImages(container) {
        let images = container.querySelectorAll('img');
        for(let img of images) {
            img.src = '';
        }
    }

    function removeErrorTextAndBorderColor(container) {
        let errorMessages = container.querySelectorAll('.registration-form__error');
        for(let errorMessage of errorMessages) {
            errorMessage.innerHTML = '';
        }
        let inputs = container.querySelectorAll('input, textarea, select');
        for (let input of inputs) {
            input.style.borderColor = '#ced4da'
        }
    }
}




function articles() {
    const editButtons = document.querySelectorAll('.edit');

    for(let editButton of editButtons) {
        editButton.addEventListener('click', e => {
            let container = e.currentTarget.parentElement.parentElement;
            let inputs = container.querySelectorAll('input, textarea');
            enableInputFields(inputs);
            let inputValueArray = getInputValues(inputs);
            let editingBtns = document.querySelectorAll('.editing');
            hideFields(editingBtns);
            let saveBtn= container.querySelectorAll('.saving');
            showFields(saveBtn);
            inputs[0].focus();
            let cancel = container.querySelector('.cancel');
            cancel.addEventListener('click', () => {
                hideFields(saveBtn);
                showFields(editingBtns);
                returnInitialValueToInputFields(inputs, inputValueArray);
                removeErrorTextAndBorderColor(container);
                disableInputFields(inputs);
            });
        });
    }


    const updateArticles = document.querySelectorAll('.update-article');
    for(let updateArticle of updateArticles) {
        updateArticle.addEventListener('submit', e => {
            e.preventDefault();
            let formData = new FormData(updateArticle);
            formData.append('submit', '');
            const url = 'include/update_article.inc.php';
            let inputs = updateArticle.querySelectorAll('input');
            let errorArray = [];
            isEmptyArticle(inputs, errorArray);
            if(errorArray.length < 1) {
                postData(url, formData)
                .then(result => {
                    if(!result) {
                        location.reload();
                    } else {
                        let errorMessages = updateArticle.querySelectorAll('.registration-form__error');
                        for(let errorMessage of errorMessages) {
                            errorMessage.innerHTML = '';
                        }
                        let inputs = updateArticle.querySelectorAll('input textarea');
                        for(let input of inputs) {
                            input.style.borderColor = '#ced4da';
                        }
                        for(const [key, value] of Object.entries(result)) {
                            field =    updateArticle.querySelector(`input[name="${key}"]`) ?
                                    updateArticle.querySelector(`input[name="${key}"]`) 
                                    : updateArticle.querySelector(`textarea[name="${key}"]`);
                            field.classList.remove('h-100');
                            field.parentElement.querySelector('.registration-form__error').innerHTML = value;
                        }
                    }
                });
            }
        })
    }

    // ## FUNCTIONS ###

    function isEmptyArticle(inputs, errorArray) {
        for(let input of inputs) {
            if(input.value == '') {
                input.style.borderBottom = '1px solid #a94442';
                input.style.borderColor = '#a94442';
                input.classList.remove('h-100');
                input.parentElement.querySelector('.registration-form__error').innerHTML = 'Polje ne smije biti prazno';
                errorArray.push('error');
            } else {
                input.style.borderColor = '#ced4da';
                input.parentElement.querySelector('.registration-form__error').innerHTML = '';
            }
        }
    }



    async function postData(url, data) {
        const response = await fetch(url, {
            method: 'POST',
            body: data
        });
        return response.json(); // parses JSON response into native JavaScript object
    }


    function enableInputFields(inputFieldsArray) {
        for(let input of inputFieldsArray) {
            input.removeAttribute('disabled');
        }
    }

    function hideFields(fields) {
        for(let field of fields) {
            field.style.display = 'none';
        }
    }
    function showFields(fields) {
        for(let field of fields) {
            field.style.display = 'block';
        }
    }

    function getInputValues(inputFieldsArray) {
        let inputValuesArray = [];
        for(let input of inputFieldsArray) {
            const value = input.getAttribute('value');
            inputValuesArray.push(value);
        }
        return inputValuesArray;
    }


    function returnInitialValueToInputFields(inputFieldsArray, inputValueArray) {
        for(let i=0; i < inputFieldsArray.length; i++) {
            inputFieldsArray[i].value = inputValueArray[i];
        }
    }


    function removeErrorTextAndBorderColor(container) {
        let errorMessages = container.querySelectorAll('.registration-form__error');
        for(let errorMessage of errorMessages) {
            errorMessage.innerHTML = '';
        }
        let inputs = container.querySelectorAll('input, textarea');
        for (let input of inputs) {
            input.style.border = 'none';
            input.classList.add('h-100');
        }
    }

    function disableInputFields(inputFieldsArray) {
        for(let input of inputFieldsArray) {
            input.setAttribute('disabled', 'true');
        }
    }


}



function bills() {
    const fileUploads = document.querySelectorAll('.form__input-file');

    showImagePreviewOnChange(fileUploads);

    const editButtons = document.querySelectorAll('.edit');

    for(let editButton of editButtons) {
        editButton.addEventListener('click', e => {
            let container = e.currentTarget.parentElement.parentElement;
            let inputs = container.querySelectorAll('input, select');
            enableInputFields(inputs);
            let images = container.querySelectorAll('img');
            let imgArray = [];
            getImageValues(images, imgArray);
            let inputText = container.querySelectorAll('input[type="text"]');
            let inputValueArray = getInputValues(inputText);
            let editingBtns = document.querySelectorAll('.editing');
            hideFields(editingBtns);
            let saveBtn= container.querySelectorAll('.hide-buttons');
            showFields(saveBtn);
            let cancel = container.querySelector('.cancel');
            cancel.addEventListener('click', () => {
                hideFields(saveBtn);
                showFields(editingBtns);
                returnInitialValueToInputFields(inputText, inputValueArray);
                removeErrorTextAndBorderColor(container);
                disableInputFields(inputs);
                returnImageValues(images, imgArray);
            });
        });
    }


    const updateBills = document.querySelectorAll('form');

    for(let updateBill of updateBills) {
        updateBill.addEventListener('submit', e => {
            e.preventDefault();
            let formData = new FormData(updateBill);
            formData.append('submit', '');
            const url = 'include/update_bill.inc.php';
            let inputs = updateBill.querySelectorAll('input[type="text"]');
            let errorArray = [];
            isEmpty(inputs, errorArray);
            if(errorArray.length < 1) {
                postData(url, formData)
                .then(result => {
                    if(!result) {
                        location.reload();
                    } else {
                        let errorMessages = updateBill.querySelectorAll('.registration-form__error');
                        for(let errorMessage of errorMessages) {
                            errorMessage.innerHTML = '';
                        }
                        let inputs = updateBill.querySelectorAll('input');
                        for(let input of inputs) {
                            input.style.borderColor = '#ced4da';
                        }
                        for(const [key, value] of Object.entries(result)) {
                            field =    updateBill.querySelector(`input[name="${key}"]`);
                            field.parentElement.querySelector('.registration-form__error').innerHTML = value;
                        }
                    }
                });
            }
        })
    }

    const deleteBills = document.querySelectorAll('.delete__bill');
    const cancelButtons = document.querySelectorAll('.cancel-modal');

    for (let deleteBill of deleteBills) {
        deleteBill.addEventListener('click', e => {
            let container = e.currentTarget.parentElement.parentElement.parentElement;
            let modal = container.querySelector('.modal-overlay');
            modal.classList.add('active');
        });
    }

    for (let cancel of cancelButtons) {
        cancel.addEventListener('click', e => {
            let modal = e.currentTarget.parentElement.parentElement.parentElement;
            modal.classList.remove('active');
        });
    }

    // ## FUNCTIONS ###

    function isEmpty(inputs, errorArray) {
        for(let input of inputs) {
            if(input.value == '') {
                input.style.borderColor = '#a94442';
                input.parentElement.querySelector('.registration-form__error').innerHTML = 'Polje ne smije biti prazno';
                errorArray.push('error');
            } else {
                input.style.borderColor = '#ced4da';
                input.parentElement.querySelector('.registration-form__error').innerHTML = '';
            }
        }
    }


    async function postData(url, data) {
        const response = await fetch(url, {
            method: 'POST',
            body: data
        });
        return response.json(); // parses JSON response into native JavaScript object
    }


    function enableInputFields(inputFieldsArray) {
        for(let input of inputFieldsArray) {
            input.removeAttribute('disabled');
        }
    }

    function hideFields(fields) {
        for(let field of fields) {
            field.style.display = 'none';
        }
    }
    function showFields(fields) {
        for(let field of fields) {
            field.style.display = 'block';
        }
    }

    function getInputValues(inputFieldsArray) {
        let inputValuesArray = [];
        for(let input of inputFieldsArray) {
            const value = input.getAttribute('value');
            inputValuesArray.push(value);
        }
        return inputValuesArray;
    }


    function returnInitialValueToInputFields(inputFieldsArray, inputValueArray) {
        for(let i=0; i < inputFieldsArray.length; i++) {
            inputFieldsArray[i].value = inputValueArray[i];
        }
    }


    function removeErrorTextAndBorderColor(container) {
        let errorMessages = container.querySelectorAll('.registration-form__error');
        for(let errorMessage of errorMessages) {
            errorMessage.innerHTML = '';
        }
        let inputs = container.querySelectorAll('input, textarea');
        for (let input of inputs) {
            input.style.borderColor = '#ced4da';
        }
    }

    function disableInputFields(inputFieldsArray) {
        for(let input of inputFieldsArray) {
            input.setAttribute('disabled', 'true');
        }
    }



    function getImageValues(images, array) {
        for(let image of images) {
            array.push(image.src);
        }
        return array;
    }

    function returnImageValues(images, array) {
        for(let i = 0; i < images.length; i++) {
            if(array[i] === window.location.href) {
                images[i].src = '';
            } else {
                images[i].src = array[i];
            }
        }
    }
}

function invoices() {
    const deleteInvoices = document.querySelectorAll('.delete__invoice');
    const cancelButtons = document.querySelectorAll('.cancel');

    for(let deleteInvoice of deleteInvoices) {
        deleteInvoice.addEventListener('click', e => {
            let container = e.currentTarget.parentElement;
            let modal = container.querySelector('.modal-overlay');
            modal.classList.add('active');
        });
    }

    for(let cancel of cancelButtons) {
        cancel.addEventListener('click', e => {
            let modal = e.currentTarget.parentElement.parentElement.parentElement;
            modal.classList.remove('active');
        });
    }
}


function login() {
    const registrationForm = document.querySelector('form');

    registrationForm.addEventListener('submit', e => {
        e.preventDefault();
        let formData = new FormData(registrationForm);
        formData.append('submit', '');
        const url = 'include/login.inc.php';
        let inputs = document.querySelectorAll('input');
        let errorArray = [];
        isEmpty(inputs, errorArray);
        if(errorArray.length < 1) {
            postData(url, formData)
            .then(data => {
                if(!data){
                    window.location.href = 'firms';
                } else {
                    let errorMessage = document.querySelectorAll('.registration-form__error')[1];
                    errorMessage.innerHTML = data['error'];
                    let inputs = document.querySelectorAll('input');
                    for(let input of inputs) {
                        input.style.borderColor = '#a94442'
                    }
                }
            });
        }
    }); 


    async function postData(url, data) {
        const response = await fetch(url, {
            method: 'POST',
            body: data 
        });
        return response.json(); // parses JSON response into native JavaScript object
    }

    function isEmpty(inputs, errorArray) {
        for(let input of inputs) {
            if(input.value == '') {
                input.style.borderColor = '#a94442';
                input.parentElement.querySelector('.registration-form__error').innerHTML = 'Polje ne smije biti prazno';
                errorArray.push('error');
            } else {
                input.style.borderColor = '#ced4da';
                input.parentElement.querySelector('.registration-form__error').innerHTML = '';
            }
        }
    }

}



function register() {
    const registrationForm = document.querySelector('form');

    registrationForm.addEventListener('submit', e => {
        e.preventDefault();
        let formData = new FormData(registrationForm);
        formData.append('submit', '');
        const url = 'include/register.inc.php';
        let inputs = document.querySelectorAll('input');
        let errorArray = [];
        isEmpty(inputs, errorArray);
        if(errorArray.length < 1) {
            postData(url, formData)
            .then(result => {
                if(!result) {
                    window.location.href = 'login';
                } else {
                    let usernameError = document.querySelector('.registration-form__error.username');
                    let emailError = document.querySelector('.registration-form__error.email');
                    let passwordErrors = document.querySelectorAll('.registration-form__error.password');
                    usernameError.innerHTML = result['username'] ?? '';
                    usernameError.parentElement.querySelector('input').style.borderColor = result['username'] ? '#a94442' : '#ced4da';
                    emailError.innerHTML = result['email'] ?? '';
                    emailError.parentElement.querySelector('input').style.borderColor = result['email'] ? '#a94442' : '#ced4da';
                    for(let passwordError of passwordErrors) {
                        passwordError.innerHTML = result['password'] ?? '';
                        passwordError.parentElement.querySelector('input').style.borderColor = result['password'] ? '#a94442' : '#ced4da';
                    }
                }
            });
        }
    });

    async function postData(url, data) {
        const response = await fetch(url, {
            method: 'POST', // *GET, POST, PUT, DELETE, etc.
            body: data // body data type must match "Content-Type" header
        });
        return response.json(); // parses JSON response into native JavaScript object
    }

    function isEmpty(inputs, errorArray) {
        for(let input of inputs) {
            if(input.value == '') {
                input.style.borderColor = '#a94442';
                input.parentElement.querySelector('.registration-form__error').innerHTML = 'Polje ne smije biti prazno';
                errorArray.push('error');
            } else {
                input.style.borderColor = '#ced4da';
                input.parentElement.querySelector('.registration-form__error').innerHTML = '';
            }
        }
    }

}


function update_client() {
    // ### IMAGE PREVIEW ###

    const fileUploads = document.querySelectorAll('.form__input-file');

    showImagePreviewOnChange(fileUploads);

    // ### DISPLAY AND HIDE INPUT FIELD

    let radioInputs = document.querySelectorAll('input[type="radio"]');

    for(let input of radioInputs) {
        input.addEventListener('click', () => {
            let pib = document.querySelector('.pib');
            if(input.checked && input.value == '1') {
                pib.parentElement.style.display = 'block';
                pib.removeAttribute('disabled');
            } else {
                pib.parentElement.style.display = 'none';
                pib.setAttribute('disabled', 'true');
            }
        });
    }

    // ### HANDLE ADD FIRM SUBMIT ###

    const firmForm = document.querySelector('form');

    firmForm.addEventListener('submit', e => {
        e.preventDefault();
        let formData = new FormData(firmForm);
        formData.append('submit', '');
        const url = '../include/update_client.inc.php';
        let inputs = document.querySelectorAll('#ime');
        let errorArray = [];
        isEmpty(inputs, errorArray);
        if(errorArray.length < 1) {
            postData(url, formData)
            .then(result => {
                if(!result) {
                    document.querySelector('.success-message').innerHTML = 'Uspješno izmijenjeno';
                    document.querySelector('.success-message').style.padding = '0.5rem 1rem';
                    removeErrorTextAndBorderColor(firmForm);
                    setTimeout(function() {
                        window.location.href = "../clients";
                    }, 1000);
                } else {
                    let errorMessages = document.querySelectorAll('.registration-form__error');
                    for(let errorMessage of errorMessages) {
                        errorMessage.innerHTML = '';
                    }
                    let inputs = document.querySelectorAll('input');
                    for(let input of inputs) {
                        input.style.borderColor = '#ced4da';
                    }
                    for(const [key, value] of Object.entries(result)) {
                        field =    document.querySelector(`input[name="${key}"]`);
                        field.style.borderColor = '#a94442';
                        field.parentElement.querySelector('.registration-form__error').innerHTML = value;
                    }
                }
            });
        }
    }); 



    // ### FUNCTIONS ###

    async function postData(url, data) {
        const response = await fetch(url, {
            method: 'POST',
            body: data
        });
        return response.json(); // parses JSON response into native JavaScript object
    }

    function isEmpty(inputs, errorArray) {
        for(let input of inputs) {
            if(input.value == '' && !input.disabled) {
                input.style.borderColor = '#a94442';
                input.parentElement.querySelector('.registration-form__error').innerHTML = 'Polje ne smije biti prazno';
                errorArray.push('error');
            } else {
                input.style.borderColor = '#ced4da';
                input.parentElement.querySelector('.registration-form__error').innerHTML = '';
            }
        }
    }


    function removeErrorTextAndBorderColor(container) {
        let errorMessages = container.querySelectorAll('.registration-form__error');
        for(let errorMessage of errorMessages) {
            errorMessage.innerHTML = '';
        }
        let inputs = container.querySelectorAll('input, textarea, select');
        for (let input of inputs) {
            input.style.borderColor = '#ced4da'
        }
    }
}


function update_firm() {
    // ### IMAGE PREVIEW ###

    const fileUploads = document.querySelectorAll('.form__input-file');

    showImagePreviewOnChange(fileUploads);

    // ### DISPLAY AND HIDE INPUT FIELD

    let radioInputs = document.querySelectorAll('input[type="radio"]');

    for(let input of radioInputs) {
        input.addEventListener('click', () => {
            let pib = document.querySelector('.pib');
            if(input.checked && input.value == '1') {
                pib.parentElement.style.display = 'block';
                pib.removeAttribute('disabled');
            } else {
                pib.parentElement.style.display = 'none';
                pib.setAttribute('disabled', 'true');
            }
        });
    }

    // ### HANDLE ADD FIRM SUBMIT ###

    const firmForm = document.querySelector('form');

    firmForm.addEventListener('submit', e => {
        e.preventDefault();
        let formData = new FormData(firmForm);
        formData.append('submit', '');
        const url = '../include/update_firm.inc.php';
        let inputs = document.querySelectorAll('#ime');
        let errorArray = [];
        isEmpty(inputs, errorArray);
        if(errorArray.length < 1) {
            postData(url, formData)
            .then(result => {
                if(!result) {
                    document.querySelector('.success-message').innerHTML = 'Uspješno izmijenjeno';
                    document.querySelector('.success-message').style.padding = '0.5rem 1rem';
                    removeErrorTextAndBorderColor(firmForm);
                    setTimeout(function() {
                        window.location.href = '../firms';
                    }, 1000);
                } else {
                    let errorMessages = document.querySelectorAll('.registration-form__error');
                    for(let errorMessage of errorMessages) {
                        errorMessage.innerHTML = '';
                    }
                    let inputs = document.querySelectorAll('input');
                    for(let input of inputs) {
                        input.style.borderColor = '#ced4da';
                    }
                    for(const [key, value] of Object.entries(result)) {
                        field =    document.querySelector(`input[name="${key}"]`);
                        field.style.borderColor = '#a94442';
                        field.parentElement.querySelector('.registration-form__error').innerHTML = value;
                    }
                }
            });
        }
    }); 



    // ### FUNCTIONS ###

    async function postData(url, data) {
        const response = await fetch(url, {
            method: 'POST',
            body: data
        });
        return response.json(); // parses JSON response into native JavaScript object
    }

    function isEmpty(inputs, errorArray) {
        for(let input of inputs) {
            if(input.value == '' && !input.disabled) {
                input.style.borderColor = '#a94442';
                input.parentElement.querySelector('.registration-form__error').innerHTML = 'Polje ne smije biti prazno';
                errorArray.push('error');
            } else {
                input.style.borderColor = '#ced4da';
                input.parentElement.querySelector('.registration-form__error').innerHTML = '';
            }
        }
    }



    function removeErrorTextAndBorderColor(container) {
        let errorMessages = container.querySelectorAll('.registration-form__error');
        for(let errorMessage of errorMessages) {
            errorMessage.innerHTML = '';
        }
        let inputs = container.querySelectorAll('input, textarea, select');
        for (let input of inputs) {
            input.style.borderColor = '#ced4da'
        }
    }
}



function update_invoice() {
    let articles = '';
    let pdv = '';
    let firma = document.getElementById('firma');
    let ukupnoBezPdv = document.querySelector('.ukupnoBezPdv');
    let ukupnoPDV = document.querySelector('.ukupnoPDV');
    let ukupnoSve = document.querySelector('.ukupnoSve');

    url = '../include/get_articles.inc.php';
    fetchArticlesForCurrentUser(url);
    let firmId = firma.value;
    let urlTwo = '../include/get_firm.inc.php?id=' + firmId;
    getData(urlTwo)
    .then(result => {
        pdv = result['pdv'];
        setTotalValues();
    });

    let articleContainer = document.getElementById('articles');

    articleContainer.addEventListener('click', e => {
        e.stopPropagation();
        // on input show dropdown
        if(e.target.classList.contains('imeArtikla')) {
            
            let container = e.target.parentElement.parentElement;
            let inputs = container.querySelectorAll('input');
            let input = container.querySelector('select.imeArtikla');
            input.addEventListener("change", function(ev){
                ev.stopImmediatePropagation();
                if(ev.target.value == 'noviArtikal') {
                    // if user selects noviArtikal disable select and enable input fields
                    let articleModal = document.querySelector('.modal-overlay-article');
                    articleModal.classList.add('active');
                    let articleFirm = document.getElementById('firma-artikla');
                    if(firma.value !== '' && firma.value !== 'dodajFirmu') {
                        createAndSelectNewOption(firma.value, firma.options[firma.selectedIndex].text, articleFirm);
                    }
                } else {
                    for(let item of articles) {
                        if(item['ime'] == ev.target.value) {
                            inputs[0].value = item['cijena'];
                            inputs[1].focus();
                            break;
                        }
                    }
                    setValueForRowTotal(container);
                }

            });
        }

        if(e.target.classList.contains('remove-icon')) {
            let inputFieldsContainer = e.target.parentElement;
            const deleteArticles = inputFieldsContainer.querySelectorAll('.deleteArticle');
            removeArticlesModal(inputFieldsContainer);
            for(let deleteArticle of deleteArticles) {
                deleteArticle.addEventListener('click', event => {
                    event.preventDefault();
                    let url = event.currentTarget.getAttribute('href');
                    let modal = event.currentTarget.parentElement.parentElement.parentElement;
                    getData(url)
                    .then(result => {
                        if(!result) {
                            inputFieldsContainer.remove();
                            modal.classList.remove('active');
                            setTotalValues();
                        } else {
                            modal.classList.remove('active');
                            setTotalValues();
                        }
                    });
                });
            }
            setTotalValues();
        }
    });



    // #########################
    // ADD ARTICLE FORM
    // #########################

    const newArticleForm = document.getElementById('newArticle');

    newArticleForm.addEventListener('submit', e =>{
        e.preventDefault();
        let formData = new FormData(newArticleForm);
        formData.append('submit', '');
        const url = '../include/articles.inc.php';
        let inputs = newArticle.querySelectorAll('input, select');
        let errorArray = [];
        isEmpty(inputs, errorArray);
        if(errorArray.length < 1) {
            postData(url, formData)
            .then(result => {
                if(!result) {
                    showSuccessMessage(newArticleForm);
                    const articles = document.querySelectorAll('.imeArtikla');
                    let option = document.createElement('option');
                    let optionValue = newArticleForm.querySelector('#ime-artikla').value;
                    let optionPriceValue = newArticleForm.querySelector('#cijena-artikla').value;
                    option.value = optionValue;
                    option.innerHTML = optionValue;
                    for(let article of articles) {
                        if(article.value == 'noviArtikal') {
                            article.add(option, article[0]);
                            let price = article.parentElement.parentElement.querySelector('.cijena');
                            price.value = optionPriceValue;
                            article.selectedIndex = 0;
                            break;
                        }
                    }
                    setTimeout(function() {
                        hideSuccessMessage(newArticleForm);
                        document.querySelector('.modal-overlay-article').classList.remove('active');
                    }, 1000);
                } else {
                    showErrorsFromServerOnSubmit(result, newArticleForm);
                }
            });
        }
    });




    // ##################
    // SETTING VALUE TO UKUPNO BEZ PDV, PDV, PDVUKUPNO, UKUPNOSVE
    // LISTENING FOR CHANGE EVENT IN FIELDS RABAT, KOLICINA, CIJENA
    // ##################


    articleContainer.addEventListener('input', e => {
        // change event on price, quantity
        if(e.target.classList.contains('cijena') || e.target.classList.contains('kolicina') || e.target.classList.contains('rabat')) {
            e.stopPropagation();
            let container = e.target.parentElement.parentElement; 
            setValueForRowTotal(container);
        }
    });


    let numberOfArticles = document.querySelectorAll('.articlesNumber').length;
    let addArticle = document.querySelector('.add');

    addArticle.addEventListener('click', e => {
        e.preventDefault();
        ++numberOfArticles;
        let div = createArticleDiv(numberOfArticles, pdv);
        articleContainer.append(div);
    });


    const invoiceForm = document.querySelector('form');

    invoiceForm.addEventListener('submit', e => {
        e.preventDefault();
        let formData = new FormData(invoiceForm);
        formData.append('submit', '');
        const url = '../include/update_invoice.inc.php';
        let requiredInputs = document.querySelectorAll('.required');
        let errorArray = [];
        isEmpty(requiredInputs, errorArray);
        if(errorArray.length < 1) {
            postData(url, formData)
            .then(result => {
                if(!result) {
                showSuccessMessage(invoiceForm);
                    setTimeout(function() {
                        hideSuccessMessage(invoiceForm);
                        window.location.href = '../invoices';
                    }, 1000);
                } else {
                    showErrorsFromServerOnSubmit(result, invoiceForm);
                }
            });
        }
    }); 




    firma.addEventListener('change', e => {
        if(e.currentTarget.value !== '') {
            let url = '../include/get_firm.inc.php?id=' + e.currentTarget.value;
            getData(url)
            .then(result => {
                pdv = result['pdv'];
                if(result['pdv'] === '0') {
                    disablePdvAndRemoveValue();
                    disableBezPdvAndRemoveValue()
                    hideTotalsNotUsed();
                } else {
                    showTotals();
                    setTaxesAndPriceWithoutTaxes();
                    let taxInputsAndWithoutTaxInput = document.querySelectorAll('.bezPDV, .PDV');
                    removeAttributeDisabled(taxInputsAndWithoutTaxInput);
                    ukupnoBezPdv.innerHTML = getTotalWithoutTaxes();
                    ukupnoPDV.innerHTML = getTotalTax();
                }
            });
        }
        fetchArticlesForCurrentUser('../include/get_articles.inc.php');
    });



    // ##############################
    // ADD BILL
    // ##############################

    let addNewBill = document.getElementById('fiskalni');
    let addBillForm = document.getElementById('add-bill-form');

    addNewBill.addEventListener('change', e => {
        if(addNewBill.value == 'dodajFiskalni') {
            let billModal = document.querySelector('.modal-overlay-bill');
            billModal.classList.add('active');
        }
    });


    addBillForm.addEventListener('submit', e => {
        e.preventDefault();
        const url = '../include/add_bill.inc.php';
        insertDataToDatabase(url, addBillForm, addNewBill);
    }); 

    // ################################
    // INVOICE TYPE
    // #################################
    let selectInvoiceType = document.getElementById('tip');

    selectInvoiceType.addEventListener('change', e => {
        checkType(selectInvoiceType);
    });

    checkType(selectInvoiceType);

    let cancelButtons = document.querySelectorAll('.cancel');
    const modalArticle = document.querySelector('.modal-overlay-article');
    const modalFirm = document.querySelector('.modal-overlay-firm');
    const modalClient = document.querySelector('.modal-overlay-client');
    const modalBill = document.querySelector('.modal-overlay-bill');

    for(let cancel of cancelButtons) {
        cancel.addEventListener('click', e => {
            e.preventDefault();
            if(modalBill.classList.contains('active')) {
                modalBill.classList.remove('active');
                addNewBill.selectedIndex = 0;
            } else {
                modalArticle.classList.remove('active');
                let articles = document.querySelectorAll('.imeArtikla');
                for(let article of articles) {
                    if(article.value == 'noviArtikal') {
                        article.selectedIndex = 0;
                    }
                }
            }
        });
    }

    // ### IMAGE PREVIEW ###

    const fileUploads = document.querySelectorAll('.form__input-file');
    showImagePreviewOnChange(fileUploads);



    function isEmpty(inputs, errorArray) {
        let container = document.getElementById('articles');
        let articleInputs = container.querySelectorAll('input');
        for(let articleInput of articleInputs) {
            articleInput.classList.add('h-100');
        }
        for(let input of inputs) {
            if(input.value.length == 0 && !input.disabled) {
                input.style.borderColor = '#a94442';
                input.classList.remove('h-100');
                input.parentElement.querySelector('.registration-form__error').innerHTML = 'Polje ne smije biti prazno';
                errorArray.push('error');
            } else {
                if(!input.disabled) {
                    input.style.borderColor = '#ced4da';
                    input.parentElement.querySelector('.registration-form__error').innerHTML = '';
                }
            }
        }
    }


    async function postData(url, data) {
        const response = await fetch(url, {
            method: 'POST',
            body: data
        });
        return response.json(); // parses JSON response into native JavaScript object
    }

    async function getData(url) {
        const response = await fetch(url, {
            method: 'GET',
        });
        return response.json(); // parses JSON response into native JavaScript object
    }

    function displayOptionsBetweenOneAndHundred(){
        list = '';
        for(let i = 1; i <= 100; i++) {
            list += `<option value="${i}"> ${i}% </option>
            `;
        }
        return list;
    }

    function displayArticleOptionsOnFirmChange(articles) {
        list = '<option value="noviArtikal"> dodaj novi artikal </option>';
        for(let item of articles) {
            list += `<option value="${item['ime']}"> ${item['ime']} </option>`;
        }
        return list;
    }

    function displayArticleOptions(articles) {
        list = '<option value="">Izaberite artikal</option>';
        list += '<option value="noviArtikal"> dodaj novi artikal </option>';
        for(let item of articles) {
            list += `<option value="${item['ime']}"> ${item['ime']} </option>`;
        }
        return list;
    }

    function displayArticleOptionsOnFirmChange() {
        list = '<option value="noviArtikal"> dodaj novi artikal </option>'
        for(let item of articles) {
            list += `<option value="${item['ime']}"> ${item['ime']} </option>`;
        }
        return list;
    }


    function setAttributeDisabled(inputs) {
        for(let input of inputs) {
            input.setAttribute('disabled', 'true');
        }
    }

    function removeAttributeDisabled(inputs) {
        for(let input of inputs) {
            input.removeAttribute('disabled');
        }
    }

    function hiddingTotalsNotUsed() {
        ukupnoBezPdv.parentElement.style.display = 'none';
        ukupnoPDV.parentElement.style.display = 'none';
    }

    function showTotals() {
        ukupnoBezPdv.parentElement.style.display = 'flex';
        ukupnoPDV.parentElement.style.display = 'flex';
    }

    function setTaxesAndPriceWithoutTaxes() {
        let containers = document.querySelectorAll('.articlesNumber');
        for(let container of containers) {
            let cijena = container.querySelector('.cijena');
            let kolicina = container.querySelector('.kolicina');
            let rabat = container.querySelector('.rabat');

            let ukupno = container.querySelector('.ukupno');
            let ukupnoValue = (cijena.value * kolicina.value - (cijena.value * kolicina.value * rabat.value / 100)).toFixed(2);
            if(selectInvoiceType.value == 'Storno faktura') {
                ukupno.value = ukupnoValue != 0 ? '-' + ukupnoValue + ' KM' : '';
            } else {
                ukupno.value = ukupnoValue != 0 ? ukupnoValue + ' KM' : '';
            }

            let pdv = container.querySelector('.PDV');
            let pdvValue = (ukupnoValue * 14.53 / 100).toFixed(2); 
            if (selectInvoiceType.value == 'Storno faktura') {
                pdv.value = pdvValue != 0 ? '-' + pdvValue + ' KM' : '';
            } else {
                pdv.value = pdvValue != 0 ? pdvValue + ' KM' : '';
            }

            let bezPDV = container.querySelector('.bezPDV');
            let bezPDVValue = (ukupnoValue - pdvValue).toFixed(2);
            if (selectInvoiceType.value == 'Storno faktura') {
                bezPDV.value = bezPDVValue != 0 ? '-' + bezPDVValue + ' KM' : '';
            } else {
                bezPDV.value = bezPDVValue != 0 ? bezPDVValue + ' KM' : '';
            }

        }
    }
    function getTotalValue() {
        let totalInputs = document.querySelectorAll('.ukupno');
        let total = 0;
        for(let totalInput of totalInputs) {
            let value = totalInput.value ? totalInput.value : '0KM';
            if(selectInvoiceType.value == 'Storno faktura') {
                value = value.substring(1, value.length - 2);
            } else {
                value = value.substring(0, value.length - 2);
            }
            const container = totalInput.parentElement.parentElement;
            if(container.style.display !== 'none') {
                total += parseFloat(value);
            }
        }
        total = total.toFixed(2);
        if (selectInvoiceType.value == 'Storno faktura') {
            total = '-' + total;
        }
        total += ' KM';
        return total;
    }

    function getTotalTax() {
        let totalInputs = document.querySelectorAll('.PDV');
        let total = 0;
        for(let totalInput of totalInputs) {
            let value = totalInput.value ? totalInput.value : '0KM';
            if (selectInvoiceType.value == 'Storno faktura') {
                value = value.substring(1, value.length - 2);
            } else {
                value = value.substring(0, value.length - 2);
            }
            const container = totalInput.parentElement.parentElement;
            if(container.style.display !== 'none') {
                total += parseFloat(value);
            }
        }
        total = total.toFixed(2);
        if (selectInvoiceType.value == 'Storno faktura') {
            total = '-' + total;
        }
        total += ' KM';
        return total;
    }

    function getTotalWithoutTaxes() {
        let totalInputs = document.querySelectorAll('.bezPDV');
        let total = 0;
        for(let totalInput of totalInputs) {
            let value = totalInput.value ? totalInput.value : '0KM';
            if (selectInvoiceType.value == 'Storno faktura') {
                value = value.substring(1, value.length - 2);
            } else {
                value = value.substring(0, value.length - 2);
            }
            const container = totalInput.parentElement.parentElement;
            if(container.style.display !== 'none') {
                total += parseFloat(value);
            }
        }
        total = total.toFixed(2);
        if (selectInvoiceType.value == 'Storno faktura') {
            total = '-' + total;
        }
        total += ' KM';
        return total;
    }

    function setTotalValues() {
        ukupnoSve.innerHTML = getTotalValue();
        if(pdv != '0') {
            ukupnoPDV.parentElement.style.display = 'flex';
            ukupnoPDV.innerHTML = getTotalTax();
            ukupnoBezPdv.parentElement.style.display = 'flex';
            ukupnoBezPdv.innerHTML = getTotalWithoutTaxes();
        }
    }


    function setValueForRowTotal(container) {
        let cijena = container.querySelector('.cijena');
            let kolicina = container.querySelector('.kolicina');
            let rabat = container.querySelector('.rabat');
            if(cijena.value !== '' && kolicina.value !== '') {
                let ukupno = container.querySelector('.ukupno');
                let ukupnoValue = (cijena.value * kolicina.value - (cijena.value * kolicina.value * rabat.value / 100)).toFixed(2);
                if (selectInvoiceType.value == 'Storno faktura') {
                    ukupno.value = '-' + ukupnoValue + 'KM';
                } else {
                    ukupno.value = ukupnoValue + 'KM';
                }

                if(pdv !== '0') {
                    let pdv = container.querySelector('.PDV');
                    let pdvValue = (ukupnoValue * 14.53 / 100).toFixed(2); 
                    if (selectInvoiceType.value == 'Storno faktura') {
                        pdv.value = '-' + pdvValue + 'KM';
                    } else {
                        pdv.value = pdvValue + 'KM';
                    }
                    let bezPDV = container.querySelector('.bezPDV');
                    let bezPDVValue = (ukupnoValue - pdvValue).toFixed(2);
                    if(selectInvoiceType.value == 'Storno faktura') {
                        bezPDV.value = '-' + bezPDVValue + 'KM';
                    } else {
                        bezPDV.value = bezPDVValue + 'KM';
                    }
                    setTotalValues();
                } else {
                    let bezPDV = container.querySelector('.bezPDV');
                    bezPDV.value = '';
                    let pdv = container.querySelector('.PDV');
                    pdv.value = '';
                    ukupnoSve.innerHTML = getTotalValue();
                    hiddingTotalsNotUsed();
                }
            }
    }

    function showErrorsFromServerOnSubmit(result, form) {
        let errorMessages = document.querySelectorAll('.registration-form__error');
        for(let errorMessage of errorMessages) {
            errorMessage.innerHTML = '';
        }
        let inputs = document.querySelectorAll('input, textarea');
        for(let input of inputs) {
            input.style.borderColor = '#ced4da';
        }
        for(const [key, value] of Object.entries(result)) {
            field =     form.querySelector(`input[name="${key}"]`) ?
                        form.querySelector(`input[name="${key}"]`) 
                    : form.querySelector(`select[name="${key}"]`) ?
                        form.querySelector(`select[name="${key}"]`)
                    : form.querySelector(`textarea[name="${key}"]`) ;
            field.style.borderColor = '#a94442';
            field.classList.remove('h-100');
            field.parentElement.querySelector('.registration-form__error').innerHTML = value;
        }
    }


    function checkType(selectInvoiceType) {
        if(selectInvoiceType.value !== 'Faktura') {
            addNewBill.setAttribute('disabled', 'true');
            addNewBill.parentElement.style.display = 'none';
        } else {
            addNewBill.removeAttribute('disabled');
            addNewBill.parentElement.style.display = 'block';
        }
    }

    function hideTotalsNotUsed() {
        ukupnoBezPdv.parentElement.style.display = 'none';
        ukupnoPDV.parentElement.style.display = 'none';
    }

    function fetchArticlesForCurrentUser(url) {
        formData = new FormData();
        formData.append('submit', '');
        let firmId = document.getElementById('firma').value;
        if(firmId != '') {
            formData.append('id', firmId);
        }
        postData(url, formData)
        .then(result => {
            articles = result;
            addArticleOptionsToArticleFields(result);
        });
    }

    function addArticleOptionsToArticleFields(result) {
        let articleOptions = document.querySelectorAll('.imeArtikla');
        for(let articleOption of articleOptions) {
            if(articleOption.value == '') {
                articleOption.innerHTML = displayArticleOptions(result);
            } else {
                let currentArticleOption = `<option value="${articleOption.value}" selected>${articleOption.value}</option>`;
                articleOption.innerHTML = currentArticleOption + displayArticleOptionsOnFirmChange(result) ;
            }
        }
    }


    function insertDataToDatabase(url, data, selectField) {
        let formData = new FormData(data);
        formData.append('submit', '');
        postData(url, formData)
        .then(result => {
            if(result['success']) {
                showSuccessMessage(data);
                createAndSelectNewOption(result['success'], result['ime'], selectField);
                setTimeout(function() {
                    hideSuccessMessage(data);
                    removeClassActive();
                }, 1000)
            } else {
                showErrorsFromServerOnSubmit(result, data);
            }
        });
    }
    
    
    function createAndSelectNewOption (value,innerText, select) {
        let option = document.createElement('option');
        option.value = value;
        option.innerHTML = innerText;
        select.add(option, select[0]);
        select.selectedIndex = 0;
    }




    function removeArticlesModal(inputFieldsContainer) {
        const deleteArticles = inputFieldsContainer.querySelectorAll('.removeArticle');
        const cancelButtons = inputFieldsContainer.querySelectorAll('.cancelRemoveArticle');

        let modal = inputFieldsContainer.querySelector('.modal-overlay');
        modal.classList.add('active');

        for(let cancel of cancelButtons) {
            cancel.addEventListener('click', e => {
                let modal = e.currentTarget.parentElement.parentElement.parentElement;
                modal.classList.remove('active');
            });
        }
        for(let deleteArticle of deleteArticles) {
            deleteArticle.addEventListener('click', () => {
                inputFieldsContainer.remove();
            });
        }
    }

    function disablePdvAndRemoveValue() {
        let pdvs = document.querySelectorAll('.PDV');
        for(let pdv of pdvs) {
            pdv.value = '';
        }
        setAttributeDisabled(pdvs);
    }

    function disableBezPdvAndRemoveValue() {
        let bezPDV = document.querySelectorAll('.bezPDV');
        for(let bez of bezPDV) {
            bez.value = '';
        }
        setAttributeDisabled(bezPDV);
    }

    function removeClassActive() {
        document.querySelector('.modal-overlay-bill').classList.remove('active');
        document.querySelector('.modal-overlay-article').classList.remove('active');
    }
        
    function createArticleDiv(numberOfArticles, pdv) {
        let div = document.createElement('div');
        div.classList.add('d-flex');
        div.classList.add('articlesNumber');
        div.classList.add('m-w-100');
        div.classList.add('m-flex-column');
        div.classList.add('m-mb-m');
        
        div.innerHTML = `
            <div class="w-30 border relative m-d-flex m-w-100 m-mb-xs m-border-none">
                <span class="w-30 p-x d-none m-d-block">Naziv</span>
                <select id="${numberOfArticles}-artikli" name="${numberOfArticles}-imeArtikla" class="dropdown w-100 p-xs m-border-input form__input border-none h-100 imeArtikla">
                ${displayArticleOptions(articles)}
                </select>
                <span class="registration-form__error"></span>
            </div>
            <div class="w-10 border m-d-flex m-w-100 m-mb-xs m-border-none">
                <span class="w-30 d-none p-x d-none m-d-block">Cijena</span>
                <input type="number" name="${numberOfArticles}-cijena" step="0.01" class="w-100 p-xs m-border-input form__input border-none h-100 cijena">
                <span class="registration-form__error"></span>
            </div>
            <div class="w-10 border m-d-flex m-w-100 m-mb-xs m-border-none">
                <span class="w-30 p-x d-none  m-d-block">Količina</span>
                <input type="number" name="${numberOfArticles}-kolicina" step="0.01" class="w-100 p-xs m-border-input form__input border-none h-100 kolicina" >
                <span class="registration-form__error"></span>
            </div>
            <div class="w-10 border m-d-flex m-w-100 m-mb-xs m-border-none">
                <span class="w-30 p-x d-none m-d-block">Rabat</span>
                <select name="${numberOfArticles}-rabat" class="w-100 p-xs m-border-input form__input border-none h-100 rabat">
                <option value="0" selected>0%</option>
                ${displayOptionsBetweenOneAndHundred()}
                </select>
                <span class="registration-form__error"></span>
            </div>
            <div class="w-15 border m-d-flex m-w-100 m-mb-xs m-border-none">
                <span class="w-30 p-x d-none m-d-block">Cijena bez PDV</span>
                <input type="text" name="${numberOfArticles}-bezPdv" ${pdv == '1' ? '' : "disabled='true'"} class="w-100 p-xs m-border-input form__input border-none h-100 bezPDV" >
                <span class="registration-form__error"></span>
            </div>
            <div class="w-10 border m-d-flex m-w-100 m-mb-xs m-border-none">
                <span class="w-30 p-x d-none m-d-block">PDV</span>
                <input type="text" name="${numberOfArticles}-pdv" ${pdv == '1' ? '' : "disabled='true'"} class="w-100 p-xs m-border-input border-none form__input h-100 PDV" >
                <span class="registration-form__error"></span>
            </div>
            <div class="w-10 border m-d-flex m-w-100 m-mb-xs m-border-none">
                <span class="w-30 p-x d-none m-d-block">Ukupno</span>
                <input type="text" name="${numberOfArticles}-ukupno" class="w-100 p-xs m-border-input border-none form__input h-100 ukupno" >
                <span class="registration-form__error"></span>
            </div>
            <i class="fas fa-times remove-icon w-5 border d-flex jc-c ai-c m-d-flex pointer m-p-xs m-w-100"></i>
            <div class="modal-overlay">
                <div class="modal">
                    <div class="modal__heading">
                        <h3>POTVRDA O BRISANJU</h3>
                    </div>
                    <div class="modal__warning">
                        <p>Da li ste sigurni da želite da izbrišete artiakl?</p>
                    </div>
                    <div class="modal__button mt-s text-right p-xs">
                        <span class="btn btn-danger removeArticle">Izbriši</span>
                        <span class="btn btn-secondary cancelRemoveArticle">Odustani</span>
                    </div>
                </div>
            </div>
        `;
        return div;
        }
}


function add_invoice() {
    let articles = '';
    let pdv = '1';
    let ukupnoBezPdv = document.querySelector('.ukupnoBezPdv');
    let ukupnoPDV = document.querySelector('.ukupnoPDV');
    let ukupnoSve = document.querySelector('.ukupnoSve');
    let selectInvoiceType = document.getElementById('tip');
    let firma = document.getElementById('firma');



    window.addEventListener('DOMContentLoaded', () => {
        let url = 'include/get_articles.inc.php';
        fetchArticlesForCurrentUser(url);
    });


    // ###########################################
    // HANDLING FORM SUBMIT FOR ADDING INVOICE 
    // ###########################################

    const invoiceForm = document.querySelector('form');

    invoiceForm.addEventListener('submit', e => {
        e.preventDefault();
        let formData = new FormData(invoiceForm);
        formData.append('submit', '');
        const url = 'include/add_invoice.inc.php';
        let requiredInputs = document.querySelectorAll('.required');
        let errorArray = [];
        isEmpty(requiredInputs, errorArray);
        if(errorArray.length < 1) {
            postData(url, formData)
            .then(result => {
                if(result['success']) {
                    window.location.href = "pdf_preview/" + result['success'];
                } else {
                    addClassHeight100ToArticleFields();
                    showErrorsFromServerOnSubmit(result, invoiceForm);
                }
            });
        }
    }); 


    // #####################
    // END OF FORM SUBMIT 
    // #####################

    // ############################
    // GETTING FIRM
    // ############################



    firma.addEventListener('change', e => {

        if(e.currentTarget.value !== 'dodajFirmu' && e.currentTarget.value !== '') {
            let url = 'include/get_firm.inc.php?id=' + e.currentTarget.value;
            getData(url)
            .then(result => {
                pdv = result['pdv'];
                if(result['pdv'] === '0') {
                    disablePdvAndRemoveValue();
                    disableBezPdvAndRemoveValue()
                    hideTotalsNotUsed();
                } else {
                    showTotals();
                    setTaxesAndPriceWithoutTaxes();
                    let taxInputsAndWithoutTaxInput = document.querySelectorAll('.bezPDV, .PDV');
                    removeAttributeDisabled(taxInputsAndWithoutTaxInput);
                }
            });
            fetchArticlesForCurrentUser('include/get_articles.inc.php');
            getFirmBills('include/get_bills.inc.php');
        }

        if(e.currentTarget.value == 'dodajFirmu') {
            let modal = document.querySelector('.modal-overlay-firm');
            modal.classList.add('active');
        }
    });

    // ####################
    // ADD NEW FIRM TO DATABASE
    // ####################

    let addFirmForm = document.getElementById('addFirm');

    addFirmForm.addEventListener('submit', e => {
        e.preventDefault();
        const url = 'include/add_firm.inc.php';
        insertDataToDatabase(url, addFirmForm, firma);
    }); 



    // ##################
    // END OF ADD FIRM
    // ##################



    // #####################################
    // MODAL FOR ADD CLIENT
    // ####################################

    let client = document.getElementById('kupac');

    client.addEventListener('change', e => {
        if(e.currentTarget.value == 'dodajKlijenta') {
            let modal = document.querySelector('.modal-overlay-client');
            modal.classList.add('active');
        }
    })

    // #####################################
    // FORM ADD CLIENT
    // ####################################

    let addClient = document.getElementById('addClient');

    addClient.addEventListener('submit', e => {
        e.preventDefault();
        const url = 'include/add_client.inc.php';
        insertDataToDatabase(url, addClient, client);
    });


    // ##############################
    // ADD BILL
    // ##############################

    let addNewBill = document.getElementById('fiskalni');
    let addBillForm = document.getElementById('add-bill-form');

    addNewBill.addEventListener('change', e => {
        if(addNewBill.value == 'dodajFiskalni') {
            let firmaId = addBillForm.querySelector('#firmaId');
            createAndSelectNewOption(firma.value, firma.options[firma.selectedIndex].text, firmaId);
            let billModal = document.querySelector('.modal-overlay-bill');
            billModal.classList.add('active');
        }
    });


    addBillForm.addEventListener('submit', e => {
        e.preventDefault();
        const url = 'include/add_bill.inc.php';
        insertDataToDatabase(url, addBillForm, addNewBill);
    }); 

    // ################################
    // INVOICE TYPE
    // #################################

    selectInvoiceType.addEventListener('change', e => {
        if(selectInvoiceType.value !== 'Faktura') {
            addNewBill.setAttribute('disabled', 'true');
            addNewBill.parentElement.style.display = 'none';
        } else {
            addNewBill.removeAttribute('disabled');
            addNewBill.parentElement.style.display = 'block';
        }
    });




    let articleContainer = document.getElementById('articles');

    articleContainer.addEventListener('click', e => {

        if(e.target.classList.contains('imeArtikla')) {
            let container = e.target.parentElement.parentElement;
            let inputs = container.querySelectorAll('input');
            let input = container.querySelector('select.imeArtikla');

            input.addEventListener("change", function(ev){
                ev.stopImmediatePropagation();
                if(ev.target.value == 'noviArtikal') {

                    let articleModal = document.querySelector('.modal-overlay-article');
                    articleModal.classList.add('active');
                    let articleFirm = document.getElementById('firma-artikla');
                    if(firma.value !== '' && firma.value !== 'dodajFirmu') {
                        createAndSelectNewOption(firma.value, firma.options[firma.selectedIndex].text, articleFirm);
                    }
                } else {
                    for(let item of articles) {
                        if(item['ime'] == ev.target.value) {
                            inputs[0].value = item['cijena'];
                            inputs[1].focus();
                            break;
                        }
                    }
                    setValueForRowTotal(container);
                }

            });
        }

        if(e.target.classList.contains('remove-icon')) {
            let inputFieldsContainer = e.target.parentElement;
            removeArticlesModal(inputFieldsContainer);
            setTotalValues();
        }
    });

    // ##################
    // SETTING VALUE TO UKUPNO BEZ PDV, PDV, PDVUKUPNO, UKUPNOSVE
    // LISTENING FOR CHANGE EVENT IN FIELDS RABAT, KOLICINA, CIJENA
    // ##################


    articleContainer.addEventListener('input', e => {
        if(e.target.classList.contains('cijena') || e.target.classList.contains('kolicina') || e.target.classList.contains('rabat')) {
            e.stopPropagation();
            let articleRowContainer = e.target.parentElement.parentElement; 
            setValueForRowTotal(articleRowContainer);
        }
    });

    // ############################################
    // ADDING NEW ARTICLE
    // ############################################

    let numberOfArticles = 1;
    let addArticlesField = document.querySelector('.add');

    addArticlesField.addEventListener('click', e => {
        e.preventDefault();
        ++numberOfArticles;
        let div = createArticleDiv(numberOfArticles);
        articleContainer.append(div);
    });

    // #####################
    // END OF ADDING ARTICLE
    // #####################






    // #########################
    // ADD ARTICLE FORM
    // #########################

    const newArticleForm = document.getElementById('newArticle');

    newArticleForm.addEventListener('submit', e =>{
        e.preventDefault();
        let formData = new FormData(newArticleForm);
        formData.append('submit', '');
        const url = 'include/articles.inc.php';
        let inputs = newArticle.querySelectorAll('input, select');
        let errorArray = [];
        isEmpty(inputs, errorArray);
        if(errorArray.length < 1) {
            postData(url, formData)
            .then(result => {
                if(!result) {
                    showSuccessMessage(newArticleForm);
                    const articles = document.querySelectorAll('.imeArtikla');
                    let option = document.createElement('option');
                    let optionValue = newArticleForm.querySelector('#ime-artikla').value;
                    let optionPriceValue = newArticleForm.querySelector('#cijena-artikla').value;
                    option.value = optionValue;
                    option.innerHTML = optionValue;
                    for(let article of articles) {
                        if(article.value == 'noviArtikal') {
                            article.add(option, article[0]);
                            let price = article.parentElement.parentElement.querySelector('.cijena');
                            price.value = optionPriceValue;
                            article.selectedIndex = 0;
                            break;
                        }
                    }
                    setTimeout(function() {
                        hideSuccessMessage(newArticleForm);
                        removeClassActive();
                    }, 1000);
                } else {
                    showErrorsFromServerOnSubmit(result, newArticleForm);
                }
            });
        }
    });





    let cancelButtons = document.querySelectorAll('.cancel');
    const modalArticle = document.querySelector('.modal-overlay-article');
    const modalFirm = document.querySelector('.modal-overlay-firm');
    const modalClient = document.querySelector('.modal-overlay-client');
    const modalBill = document.querySelector('.modal-overlay-bill');

    for(let cancel of cancelButtons) {
        cancel.addEventListener('click', e => {
            e.preventDefault();
            if(modalFirm.classList.contains('active')) {
                modalFirm.classList.remove('active');
                firma.selectedIndex = 0;
            } else if(modalClient.classList.contains('active')) {
                modalClient.classList.remove('active');
                client.selectedIndex = 0;
            } else if(modalBill.classList.contains('active')) {
                modalBill.classList.remove('active');
                addNewBill.selectedIndex = 0;
            } else {
                modalArticle.classList.remove('active');
                let articles = document.querySelectorAll('.imeArtikla');
                for(let article of articles) {
                    if(article.value == 'noviArtikal') {
                        article.selectedIndex = 0;
                    }
                }
            }
        });
    }


    // ### IMAGE PREVIEW ###

    const fileUploads = document.querySelectorAll('.form__input-file');
    showImagePreviewOnChange(fileUploads);

    // ### DISPLAY AND HIDE INPUT FIELD

    let radioFirm = document.querySelectorAll('.modal-overlay-firm input[type="radio"]');

    for(let input of radioFirm) {
        input.addEventListener('click', () => {
            let pib = document.querySelector('.modal-overlay-firm .pib');
            if(input.checked && input.value == '1') {
                pib.parentElement.style.display = 'block';
                pib.removeAttribute('disabled');
                showTotals();
                setTaxesAndPriceWithoutTaxes();
                let taxInputsAndWithoutTaxInput = document.querySelectorAll('.bezPDV, .PDV');
                removeAttributeDisabled(taxInputsAndWithoutTaxInput);
            } else {
                pib.parentElement.style.display = 'none';
                pib.setAttribute('disabled', 'true');
                disablePdvAndRemoveValue();
                disableBezPdvAndRemoveValue()
                hideTotalsNotUsed();

            }
        });
    }

    let radioClient = document.querySelectorAll('.modal-overlay-client input[type="radio"]');

    for(let input of radioClient) {
        input.addEventListener('click', () => {
            let pib = document.querySelector('.modal-overlay-client .pib');
            if(input.checked && input.value == '1') {
                pib.parentElement.style.display = 'block';
                pib.removeAttribute('disabled');
            } else {
                pib.parentElement.style.display = 'none';
                pib.setAttribute('disabled', 'true');
            }
        });
    }


    // ####################
    // FUNCTIONS
    // ####################

    function isEmpty(inputs, errorArray) {
        let container = document.getElementById('articles');
        let articleInputs = container.querySelectorAll('input, select');
        for(let articleInput of articleInputs) {
            articleInput.classList.add('h-100');
        }
        for(let input of inputs) {
            if(input.value.length == 0 && input.disabled !== 'true') {
                input.style.borderColor = '#a94442';
                input.classList.remove('h-100');
                input.parentElement.querySelector('.registration-form__error').innerHTML = 'Polje ne smije biti prazno';
                errorArray.push('error');
            } else {
                if(!input.disabled) {
                    input.style.borderColor = '#ced4da';
                    input.parentElement.querySelector('.registration-form__error').innerHTML = '';
                }
            }
        }
    }


    async function postData(url, data) {
        const response = await fetch(url, {
            method: 'POST',
            body: data
        });
        return response.json(); // parses JSON response into native JavaScript object
    }

    async function getData(url) {
        const response = await fetch(url, {
            method: 'GET'
        });
        return response.json(); // parses JSON response into native JavaScript object
    }


    function displayArticleOptions (articles) {
        list = '<option value="">Izaberite artikal</option>';
        list += '<option value="noviArtikal"> dodaj novi artikal </option>'
        for(let item of articles) {
            list += `<option value="${item['ime']}"> ${item['ime']} </option>`;
        }
        return list;
    }

    function displayArticleOptionsOnFirmChange() {
        list = '<option value="noviArtikal"> dodaj novi artikal </option>'
        for(let item of articles) {
            list += `<option value="${item['ime']}"> ${item['ime']} </option>`;
        }
        return list;
    }

    function displayOptionsBetweenOneAndHundred(){
        list = '';
        for(let i = 1; i <= 100; i++) {
            list += `<option value="${i}"> ${i}% </option>
            `;
        }
        return list;
    }

    function getTotalValue() {
        let totalInputs = document.querySelectorAll('.ukupno');
        let total = 0;
        for(let totalInput of totalInputs) {
            let value = totalInput.value ? totalInput.value : '0KM';
            if(selectInvoiceType.value == 'Storno faktura') {
                value = value.substring(1, value.length - 2);
            } else {
                value = value.substring(0, value.length - 2);
            }
            const container = totalInput.parentElement.parentElement;
            total += parseFloat(value);
        }
        total = total.toFixed(2);
        if (selectInvoiceType.value == 'Storno faktura') {
            total = '-' + total;
        }
        total += ' KM';
        return total;
    }

    function getTotalTax() {
        let totalInputs = document.querySelectorAll('.PDV');
        let total = 0;
        for(let totalInput of totalInputs) {
            let value = totalInput.value ? totalInput.value : '0KM';
            if (selectInvoiceType.value == 'Storno faktura') {
                value = value.substring(1, value.length - 2);
            } else {
                value = value.substring(0, value.length - 2);
            }
            const container = totalInput.parentElement.parentElement;
            total += parseFloat(value);
        }
        total = total.toFixed(2);
        if(selectInvoiceType.value == 'Storno faktura') {
            total = '-' + total;
        }
        total += ' KM';
        return total;
    }

    function getTotalWithoutTaxes() {
        let totalInputs = document.querySelectorAll('.bezPDV');
        let total = 0;
        for(let totalInput of totalInputs) {
            let value = totalInput.value ? totalInput.value : '0KM';
            if (selectInvoiceType.value == 'Storno faktura') {
                value = value.substring(1, value.length - 2);
            } else {
                value = value.substring(0, value.length - 2);
            }
            const container = totalInput.parentElement.parentElement;
            total += parseFloat(value);    
        }
        total = total.toFixed(2);
        if(selectInvoiceType.value == 'Storno faktura') {
            total = '-' + total;
        }
        total += ' KM';
        return total;
    }

    function setTotalValues() {
        ukupnoSve.innerHTML = getTotalValue();
        if(pdv != '0') {
            ukupnoPDV.parentElement.style.display = 'flex';
            ukupnoPDV.innerHTML = getTotalTax();
            ukupnoBezPdv.parentElement.style.display = 'flex';
            ukupnoBezPdv.innerHTML = getTotalWithoutTaxes();
        }
    }

    function hideTotalsNotUsed() {
        ukupnoBezPdv.parentElement.style.display = 'none';
        ukupnoPDV.parentElement.style.display = 'none';
    }

    function showTotals() {
        ukupnoBezPdv.parentElement.style.display = 'flex';
        ukupnoPDV.parentElement.style.display = 'flex';
    }

    function setTaxesAndPriceWithoutTaxes() {
        let containers = document.querySelectorAll('.articlesNumber');
        for(let container of containers) {
            let cijena = container.querySelector('.cijena');
            let kolicina = container.querySelector('.kolicina');
            let rabat = container.querySelector('.rabat');

            let ukupno = container.querySelector('.ukupno');
            let ukupnoValue = (cijena.value * kolicina.value - (cijena.value * kolicina.value * rabat.value / 100)).toFixed(2);
            if(selectInvoiceType.value == 'Storno faktura') {
                ukupno.value = ukupnoValue != 0 ? '-' + ukupnoValue + 'KM' : '';
            } else {
                ukupno.value = ukupnoValue != 0 ? ukupnoValue + 'KM' : '';
            }

            let pdv = container.querySelector('.PDV');
            let pdvValue = (ukupnoValue * 14.53 / 100).toFixed(2); 
            if (selectInvoiceType.value == 'Storno faktura') {
                pdv.value = pdvValue != 0 ? '-' + pdvValue + 'KM' : '';
            } else {
                pdv.value = pdvValue != 0 ? pdvValue + 'KM' : '';
            }

            let bezPDV = container.querySelector('.bezPDV');
            let bezPDVValue = (ukupnoValue - pdvValue).toFixed(2);
            if (selectInvoiceType.value == 'Storno faktura') {
                bezPDV.value = bezPDVValue != 0 ? '-' + bezPDVValue + 'KM' : '';
            } else {
                bezPDV.value = bezPDVValue != 0 ? bezPDVValue + 'KM' : '';
            }

        }
    }

    function setAttributeDisabled(inputs) {
        for(let input of inputs) {
            input.setAttribute('disabled', 'true');
        }
    }

    function removeAttributeDisabled(inputs) {
        for(let input of inputs) {
            input.removeAttribute('disabled');
        }
    }


    function setValueForRowTotal(container) {
        let cijena = container.querySelector('.cijena');
        let kolicina = container.querySelector('.kolicina');
        let rabat = container.querySelector('.rabat');
        if(cijena.value !== '' && kolicina.value !== '') {
            let ukupno = container.querySelector('.ukupno');
            let ukupnoValue = (cijena.value * kolicina.value - (cijena.value * kolicina.value * rabat.value / 100)).toFixed(2);
            if (selectInvoiceType.value == 'Storno faktura') {
                ukupno.value = '-' + ukupnoValue + 'KM';
            } else {
                ukupno.value = ukupnoValue + 'KM';
            }
            if(pdv !== '0') {
                let pdv = container.querySelector('.PDV');
                let pdvValue = (ukupnoValue * 14.53 / 100).toFixed(2); 
                if(selectInvoiceType.value == 'Storno faktura') {
                    pdv.value = '-' + pdvValue + 'KM';
                } else {
                    pdv.value = pdvValue + 'KM';
                }
                let bezPDV = container.querySelector('.bezPDV');
                let bezPDVValue = (ukupnoValue - pdvValue).toFixed(2);
                if(selectInvoiceType.value == 'Storno faktura') {
                    bezPDV.value = '-' + bezPDVValue + 'KM';
                } else {
                    bezPDV.value = bezPDVValue + 'KM';
                }
                setTotalValues();
            } else {
                let bezPDV = container.querySelector('.bezPDV');
                bezPDV.value = '';
                let pdv = container.querySelector('.PDV');
                pdv.value = '';
                ukupnoSve.innerHTML = getTotalValue();
                hideTotalsNotUsed();
            }
        }
    }

    function removeClassActive() {
        document.querySelector('.modal-overlay-firm').classList.remove('active');
        document.querySelector('.modal-overlay-client').classList.remove('active');
        document.querySelector('.modal-overlay-article').classList.remove('active');
        document.querySelector('.modal-overlay-bill').classList.remove('active');
    }

    function disablePdvAndRemoveValue() {
        let pdvs = document.querySelectorAll('.PDV');
        for(let pdv of pdvs) {
            pdv.value = '';
        }
        setAttributeDisabled(pdvs);
    }

    function disableBezPdvAndRemoveValue() {
        let bezPDV = document.querySelectorAll('.bezPDV');
        for(let bez of bezPDV) {
            bez.value = '';
        }
        setAttributeDisabled(bezPDV);
    }

    function showErrorsFromServerOnSubmit(result, form) {
        let errorMessages = document.querySelectorAll('.registration-form__error');
        for(let errorMessage of errorMessages) {
            errorMessage.innerHTML = '';
        }
        let inputs = document.querySelectorAll('input, textarea');
        for(let input of inputs) {
            input.style.borderColor = '#ced4da';
        }
        for(const [key, value] of Object.entries(result)) {
            field =     form.querySelector(`input[name="${key}"]`) ?
                        form.querySelector(`input[name="${key}"]`) 
                    : form.querySelector(`select[name="${key}"]`) ?
                        form.querySelector(`select[name="${key}"]`)
                    : form.querySelector(`textarea[name="${key}"]`) ;
            field.style.borderColor = '#a94442';
            field.classList.remove('h-100');
            field.parentElement.querySelector('.registration-form__error').innerHTML = value;
        }
    }

    function addClassHeight100ToArticleFields() {
        let container = document.getElementById('articles');
        let articleInputs = container.querySelectorAll('input');
        for(let articleInput of articleInputs) {
            articleInput.classList.add('h-100');
        }
    }

    function showSuccessMessage(container) {
        container.querySelector('.success-message').innerHTML = 'Uspješno sačuvano';
        container.querySelector('.success-message').style.padding = '0.5rem 1rem';
    }

    function hideSuccessMessage(container) {
        container.querySelector('.success-message').innerHTML = '';
        container.querySelector('.success-message').style.padding = '0';
    }

    function removeArticlesModal(inputFieldsContainer) {
        const deleteArticles = inputFieldsContainer.querySelectorAll('.removeArticle');
        const cancelButtons = inputFieldsContainer.querySelectorAll('.cancelRemoveArticle');

        let modal = inputFieldsContainer.querySelector('.modal-overlay');
        modal.classList.add('active');

        for(let cancel of cancelButtons) {
            cancel.addEventListener('click', e => {
                let modal = e.currentTarget.parentElement.parentElement.parentElement;
                modal.classList.remove('active');
            });
        }
        for(let deleteArticle of deleteArticles) {
            deleteArticle.addEventListener('click', () => {
                inputFieldsContainer.remove();
            });
        }
    }


    function fetchArticlesForCurrentUser(url) {
        formData = new FormData();
        formData.append('submit', '');
        let firmId = document.getElementById('firma').value;
        if(firmId != '') {
            formData.append('id', firmId);
        }
        postData(url, formData)
        .then(result => {
            articles = result;
            addArticleOptionsToArticleFields(result);
        });
    }

    function getFirmBills(url) {
        let formData = new FormData();
        formData.append('submit', '');
        let firmId = document.getElementById('firma').value;
        formData.append('id', firmId);
        postData(url, formData)
        .then(result => {
            addBillOptionsToBillField(result);
        });
    }

    function addBillOptionsToBillField(result) {
        let currentBill = document.getElementById('fiskalni');
        if (currentBill.value == '') {
            currentBill.innerHTML = '<option value=""> Izaberite fiskalni račun </option>' + displayBillOptions(result);
        } else {
            let option = `<option value="${currentBill.value}" selected>${currentBill.options[currentBill.selectedIndex].text}</option>`;
            currentBill.innerHTML = option + displayBillOptions(result);
        }
    }

    function addArticleOptionsToArticleFields(result) {
        let articleOptions = document.querySelectorAll('.imeArtikla');
        for(let articleOption of articleOptions) {
            if(articleOption.value == '') {
                articleOption.innerHTML = displayArticleOptions(result);
            } else {
                let currentArticleOption = `<option value="${articleOption.value}" selected>${articleOption.value}</option>`;
                articleOption.innerHTML = currentArticleOption + displayArticleOptionsOnFirmChange(result) ;
            }
        }
    }

    function displayBillOptions(result) {
        let list = '<option value="dodajFiskalni">Dodaj novi fiskalni račun</option>'
        for (let item of result) {
            list += `<option value="${item['id']}"> ${item['broj']} </option>`;
        }
        return list;
    }


    function insertDataToDatabase(url, data, selectField) {
        let formData = new FormData(data);
        formData.append('submit', '');
        postData(url, formData)
        .then(result => {
            if(result['success']) {
                showSuccessMessage(data);
                createAndSelectNewOption(result['success'], result['ime'], selectField);
                if(url.indexOf('add_inovice') != -1 ) {
                    pdv = result['success'];
                }
                setTimeout(function() {
                    hideSuccessMessage(data);
                    removeClassActive();
                }, 1000)
            } else {
                showErrorsFromServerOnSubmit(result, data);
            }
        });
    }
    
    
    function createAndSelectNewOption (value,innerText, select) {
        let option = document.createElement('option');
        option.value = value;
        option.innerHTML = innerText;
        select.add(option, select[0]);
        select.selectedIndex = 0;
    }

    function createArticleDiv(numberOfArticles) {
        let div = document.createElement('div');
        div.classList.add('d-flex');
        div.classList.add('articlesNumber');
        div.classList.add('m-w-100');
        div.classList.add('m-flex-column');
        div.classList.add('m-card');
        div.classList.add('m-mb-m');
        
        div.innerHTML = `
            <div class="w-30 border relative m-d-flex m-w-100 m-mb-xs m-border-none">
                <span class="w-100 p-x d-none m-w-30 m-d-block">Naziv</span>
                <select id="${numberOfArticles}-artikli" name="${numberOfArticles}-imeArtikla" class="dropdown w-100 p-xs m-border-input form__input border-none h-100 imeArtikla">
                ${displayArticleOptions(articles)}
                </select>
                <span class="registration-form__error"></span>
            </div>
            <div class="w-10 border m-d-flex m-w-100 m-mb-xs m-border-none">
                <span class="w-100 d-none p-x d-none m-w-30 m-d-block">Cijena</span>
                <input type="number" name="${numberOfArticles}-cijena" step="0.01" class="w-100 p-xs m-border-input form__input border-none h-100 cijena">
                <span class="registration-form__error"></span>
            </div>
            <div class="w-10 border m-d-flex m-w-100 m-mb-xs m-border-none">
                <span class="w-100 p-x d-none m-w-30 m-d-block">Količina</span>
                <input type="number" name="${numberOfArticles}-kolicina" step="0.01" class="w-100 p-xs m-border-input form__input border-none h-100 kolicina" >
                <span class="registration-form__error"></span>
            </div>
            <div class="w-10 border m-d-flex m-w-100 m-mb-xs m-border-none">
                <span class="w-100 p-x d-none m-w-30 m-d-block">Rabat</span>
                <select name="${numberOfArticles}-rabat" class="w-100 p-xs m-border-input form__input border-none h-100 rabat">
                <option value="0" selected>0%</option>
                ${displayOptionsBetweenOneAndHundred()}
                </select>
                <span class="registration-form__error"></span>
            </div>
            <div class="w-15 border m-d-flex m-w-100 m-mb-xs m-border-none">
                <span class="w-100 p-x d-none m-w-30 m-d-block">Cijena bez PDV</span>
                <input type="text" name="${numberOfArticles}-bezPdv" ${pdv == '1' ? '' : "disabled='true'"} class="w-100 p-xs m-border-input form__input border-none h-100 bezPDV" >
                <span class="registration-form__error"></span>
            </div>
            <div class="w-10 border m-d-flex m-w-100 m-mb-xs m-border-none">
                <span class="w-100 p-x d-none m-w-30 m-d-block">PDV</span>
                <input type="text" name="${numberOfArticles}-pdv" ${pdv == '1' ? '' : "disabled='true'"} class="w-100 p-xs m-border-input border-none form__input h-100 PDV" >
                <span class="registration-form__error"></span>
            </div>
            <div class="w-10 border m-d-flex m-w-100 m-mb-xs m-border-none">
                <span class="w-100 d-none m-w-30 m-d-block">Ukupno</span>
                <input type="text" name="${numberOfArticles}-ukupno" class="w-100 p-xs m-border-input border-none form__input h-100 ukupno" >
                <span class="registration-form__error"></span>
            </div>
            <i class="fas fa-times remove-icon w-5 border d-flex jc-c ai-c m-d-flex pointer m-p-xs m-w-100"></i>
            <div class="modal-overlay">
                <div class="modal">
                    <div class="modal__heading">
                        <h3>POTVRDA O BRISANJU</h3>
                    </div>
                    <div class="modal__warning">
                        <p>Da li ste sigurni da želite da izbrišete artiakl?</p>
                    </div>
                    <div class="modal__button mt-s text-right p-xs">
                        <span class="btn btn-danger removeArticle">Izbriši</span>
                        <span class="btn btn-secondary cancelRemoveArticle">Odustani</span>
                    </div>
                </div>
            </div>
        `;
        return div;
    }
}


// ####  FUNCTIONS  #####

function showSuccessMessage(container) {
    container.querySelector('.success-message').innerHTML = 'Uspješno sačuvano';
    container.querySelector('.success-message').style.padding = '0.5rem 1rem';
}

function hideSuccessMessage(container) {
    container.querySelector('.success-message').innerHTML = '';
    container.querySelector('.success-message').style.padding = '0';
}

const toggle = document.getElementById('sidebar-toggle');
let sidebar = document.querySelector('.sidebar');
let main = document.querySelector('main');
let navigation = document.querySelector('.navigation');
let sidebarOverlay = document.querySelector('.sidebar-overlay');
let sidebarMenuDropdowns = document.querySelectorAll('.sidebar__dropdown-toggle');

let widthScreen = window.innerWidth
    || document.documentElement.clientWidth
    || document.body.clientWidth;

if(widthScreen > 992) {
    toggleActiveClass();
}

toggle.addEventListener('click', () => {
    toggleActiveClass();
});

sidebarOverlay.addEventListener('click', () => {
    toggleActiveClass();
});

for(let sidebarMenuDropdown of sidebarMenuDropdowns) {
    sidebarMenuDropdown.addEventListener('click', e => {
        sidebarMenuDropdown.classList.toggle('sidebar__dropdown-active');
    });
}

function toggleActiveClass() {
    sidebar.classList.toggle('active');
    main.classList.toggle('active');
    navigation.classList.toggle('active');
    toggle.classList.toggle('active');
    sidebarOverlay.classList.toggle('active');
}


function removeImageAndFileValue() {
    let removeImageIcons = document.querySelectorAll('.remove-image');
    if(removeImageIcons) {
        for(let removeImageIcon of removeImageIcons) {
            removeImageIcon.addEventListener('click', e => {
                let container = e.currentTarget.parentElement;
                let img = container.querySelector('img');
                let file = container.querySelector('input');
                img.src = '';
                file.value = '';
                removeImageIcon.style.display = 'none';
            });
        }
    }
}
removeImageAndFileValue();

function setImage(inputField, img) {
    img.src = URL.createObjectURL(inputField.files[0]);
    img.onload = function () {
        URL.revokeObjectURL(img.src);
    }
}


function showImagePreviewOnChange(fileUploads) {
    for (let fileUpload of fileUploads) {
        fileUpload.addEventListener('change', e => {
            const container = e.target.parentElement;
            let img = container.querySelector('img');
            let  removeImageIcon = container.querySelector('.remove-image');
            if(removeImageIcon) {
                removeImageIcon.style.display = 'block';
            }
            setImage(fileUpload, img);
        });
    }
}

let checkbox = document.getElementById('theme-toggle');
let userImage = document.getElementById('theme-image');
let logoImage = document.getElementById('theme-logo');

checkbox.addEventListener('click', function () {
   let getUrl = window.location;
    let baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1] + '/include/theme.inc.php';
    getData(baseUrl)
    .then(result => {
        if (!result) {
            trans();
            document.documentElement.setAttribute('data-theme', 'dark');
            logoImage.src = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1] + '/images/logo-2.png';
            userImage.src = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1] + '/images/default2.png';
        } else {
            trans();
            document.documentElement.setAttribute('data-theme', 'light');
            logoImage.src = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1] + '/images/logo.png';
            userImage.src = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1] + '/images/default.png';
        }
    });
});

let trans = () => {
    document.documentElement.classList.add('transition');
    window.setTimeout(() => {
        document.documentElement.classList.remove('transition');
    }, 1000);
}

async function getData(url) {
    const response = await fetch(url, {
        method: 'GET',
    });
    return response.json(); // parses JSON response into native JavaScript object
}