// copying iframe text, to include in another page

const copyButtons = document.querySelectorAll('.iframe__copy');

for(let copyButton of copyButtons) {
    copyButton.addEventListener('click', e => {
        e.preventDefault();
        const container = e.currentTarget.parentElement;
        let copyText = container.querySelector('.iframe__text');
        copyText.select();
        copyText.setSelectionRange(0, 99999); /* For mobile devices */

        /* Copy the text inside the text field */
        document.execCommand("copy");
        copyText.setSelectionRange(0, 0);
    });
}