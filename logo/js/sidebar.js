// toggle sidebar
const toggle = document.getElementById('sidebar-toggle');
const sidebar = document.getElementsByClassName('sidebar')[0];
const sidebarOverlay = document.getElementsByClassName('sidebar-overlay')[0];

toggle.addEventListener('click', () => {
    sidebar.classList.add('active');
    sidebarOverlay.classList.add('active');
})

sidebarOverlay.addEventListener('click', e => {
        sidebar.classList.remove('active');
        sidebarOverlay.classList.remove('active');
})