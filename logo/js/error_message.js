// hiding error messages after 3s
const message = document.querySelector('.message');

setTimeout(hide, 3000 );

function hide() {
        message.style.display= 'none';
}