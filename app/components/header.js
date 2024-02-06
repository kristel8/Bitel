class Header extends HTMLElement {
    constructor() { 
        super(); 
    }

    connectedCallback() {
        this.innerHTML = `
            <img class="header__img" src="app/assets/img/anuncio110.svg" alt='Banner de promocion de Bitel' loading='lazy'>
            <br>
            <div class="header__title" id="main-title">¡Planes ilimitados!</div>
        `;
        
        //Agregue un event listener al elemento con el id 'main-title'
        const mainTitle = document.getElementById('main-title');
        if (mainTitle) {
            mainTitle.addEventListener('click', handleTitleClick);
        }

        function handleTitleClick() {
            console.log('Título clickeado');
        }
    }
}

window.customElements.define('app-header', Header);
