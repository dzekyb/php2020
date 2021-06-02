 const file = document.getElementById('calculator-logo');

 file.addEventListener('change', e => {
    const container = e.currentTarget.parentElement;
    const img = container.querySelector('img');
    const label = container.querySelector('label');
    if(e.target.files.length > 0) {
        img.src = URL.createObjectURL(file.files[0]);
            img.onload = function() {
                URL.revokeObjectURL(img.src);
            }
        label.innerHTML = 'Logo uploaded';
    }
});
 