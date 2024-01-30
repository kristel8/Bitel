class Header extends HTMLElement {
    constructor() { super(); }

    connectedCallback() {
        this.innerHTML = `
            <img class="header__img" src="app/assets/img/anuncio110.svg">
            <br>
            <div class="header__title" id="main-title">¡Planes ilimitados!</div>
        `
    }
}

window.customElements.define('app-header', Header);