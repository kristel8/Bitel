class Footer extends HTMLElement {
    constructor() {
        super();
    }

    connectedCallback() {
        this.innerHTML = `
            <section class="footer__section col-2">
                <div class="grid">
                    <h2>Contáctanos</h2>
                    <div class="footer__item">
                        <img src="app/assets/icons/telefono.svg" alt="">
                        <span>916931315</span>
                    </div>
                    <div class="footer__item">
                        <img src="app/assets/icons/sim.svg" alt="">
                        <a id="btnAdquirirChip" href="./registro.html">Adquirir chip</a>
                    </div>
                </div>
                <div class="grid">
                    <h2>Escríbenos</h2>
                    <div class="footer__item">
                        <img src="app/assets/icons/whatsapp.svg" alt="">
                        <span><a href="https://wa.me/+51916931315">916931315</a></span>
                    </div>
                </div>
            </section>

            <section class="footer__section grid">
                <h2>Te contactamos</h2>
                <form id="form_number">
                    <div class="footer__item">
                        <input id="phoneNumber" type="text" name="celularcontacto" placeholder="Celular" class="input" onKeyPress="if(this.value.length==9) return false" autocomplete="off">
                        <button type="submit" id="btnSendNumber" class="button">Enviar</button>
                        <div id="loader2" class="loader" hidden></div>
                    </div>
                </form>
            </section>
        `;

        const btnAdquirirChip = document.getElementById('btnAdquirirChip');
        btnAdquirirChip.addEventListener("click", () => {
            localStorage.removeItem('planSeleccionado');
        });
    }
}

window.customElements.define("app-footer", Footer);

