const menuButton = document.querySelector('[data-nav-toggle]');
const mobileMenu = document.getElementById('mobile-nav');

if (menuButton instanceof HTMLButtonElement && mobileMenu instanceof HTMLElement) {
    menuButton.addEventListener('click', () => {
        const expanded = menuButton.getAttribute('aria-expanded') === 'true';
        menuButton.setAttribute('aria-expanded', expanded ? 'false' : 'true');
        mobileMenu.classList.toggle('hidden', expanded);
    });

    mobileMenu.querySelectorAll('a[href^="#"]').forEach((link) => {
        link.addEventListener('click', () => {
            menuButton.setAttribute('aria-expanded', 'false');
            mobileMenu.classList.add('hidden');
        });
    });
}
