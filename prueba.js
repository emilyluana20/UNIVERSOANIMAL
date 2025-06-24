document.addEventListener('DOMContentLoaded', function() {
    const menuHamburguesa = document.querySelector('.menu-hamburguesa');
    const menu = document.querySelector('.menu');
    
    menuHamburguesa.addEventListener('click', function() {
        this.classList.toggle('active');
        menu.classList.toggle('active');
    });
});