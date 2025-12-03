document.addEventListener("DOMContentLoaded", function () {
    const menuBtn = document.querySelector('.menu-toggle-new');
    const closeBtn = document.querySelector('.menu-close-new');
    const menuOverlay = document.querySelector('.menu-overlay-new');

    if (menuBtn && closeBtn && menuOverlay) {
        menuBtn.addEventListener('click', () => {
            menuOverlay.classList.add('active');
            document.body.classList.add('menu-open');
        });

        closeBtn.addEventListener('click', () => {
            menuOverlay.classList.remove('active');
            document.body.classList.remove('menu-open');
        });
    }
});
