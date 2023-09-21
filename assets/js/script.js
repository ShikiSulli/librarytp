// Sélection des éléments du DOM
const menuBtn = document.querySelectorAll('.switch-row');

// Ajout de la classe row sous 769px
document.addEventListener('DOMContentLoaded', () => {
    if (window.innerWidth < 769) {
        menuBtn.forEach(btn => {
            btn.classList.add('row');
        })
    }
})
