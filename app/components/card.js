import { Plan } from "../js/plan.js";

export class Card extends HTMLElement {
    constructor() {
        super();
    }

    async connectedCallback() {
        await this.getCards();
    }

    async getCards() {
        const plan = new Plan();
        const plans = await plan.plans;

        let textHTML = '';

        for (const item of plans) {
            const listSocial = this.getSocialNetworks(item.redesSociales);
            const listDetails = this.getDetails(item.detalles);
            const promotion = this.getPromotions(item.promociones[0]);
            const cards = `
            <section id="card${item.idCard}" class="card">
                <section class="face front">
                    <h3>${item.titulo}</h3>
                    <div class="card__description">
                        <h3>${item.descripcionTitulo}</h3>
                        <span>${item.descripcionDetalleTitulo}</span>
                    </div>
            
                    <div class="card_velocity">
                        <h3>${item.megas}</h3>
                        <span>Gigas regulares en alta velocidad</span>
                    </div>
            
                    <section class="card__social">${listSocial}</section>
                
                    <section class="card__promotion">${promotion}</section>
                
                    <a id="showDetail${item.idCard}">Ver detalle</a>
                    
                    <a id="choosePlan${item.idCard}" class="button" href="./registro.html">Lo quiero</a>
                </section>
        
                <section class="face back">
                    <section>
                        <h3>${item.titulo}</h3>
                        <div class="card__detail">${listDetails}</div>
                    </section>
            
                    <button id="closeDetail${item.idCard}" type="button" class="button-outline">Cerrar</button>
                </section>
            </section>
            `;

            textHTML = textHTML.concat(cards);
            this.innerHTML = `${textHTML}`;
        }

        for (const item of plans) {
            const btnShowDetail = document.getElementById(`showDetail${item.idCard}`);
            const btnCloseDetail = document.getElementById(`closeDetail${item.idCard}`);
            const btnChoosePlan = document.getElementById(`choosePlan${item.idCard}`);
            const card = document.getElementById(`card${item.idCard}`);
            this.addEventClickDetail(btnShowDetail, btnCloseDetail, card);
            this.addEventClickPlan(btnChoosePlan, item);
        }

        this.getCarousel();
    }

    getCarousel() {
        const carousel = document.querySelector('.carousel');
        const prevBtn = document.querySelector('.prev-btn');
        const nextBtn = document.querySelector('.next-btn');

        let slideWidth = carousel.clientWidth / 2; // Muestra dos elementos por "slide"
        let currentPosition = 0;

        prevBtn.addEventListener('click', () => {
            if(carousel.clientWidth < 900) slideWidth = carousel.clientWidth / 1;
            if(carousel.clientWidth > 900) slideWidth = carousel.clientWidth / 2;

            currentPosition += slideWidth;
            if (currentPosition > 0) {
                currentPosition = -(carousel.scrollWidth - carousel.clientWidth);
            }
            carousel.style.transform = `translateX(${currentPosition}px)`;
        });

        nextBtn.addEventListener('click', () => {
            if(carousel.clientWidth < 900) slideWidth = carousel.clientWidth / 1;
            if(carousel.clientWidth > 900) slideWidth = carousel.clientWidth / 2;

            currentPosition -= slideWidth;
            if (currentPosition < -(carousel.scrollWidth - carousel.clientWidth)) {
                currentPosition = 0;
            }
            carousel.style.transform = `translateX(${currentPosition}px)`;
        });
    }

    addEventClickDetail(actionShow, actionClose, card) {
        const front = card.getElementsByClassName("front");
        const back = card.getElementsByClassName("back");

        actionShow.addEventListener("click", () => {
            front[0].style.transform = "perspective(600px) rotateY(180deg)";
            back[0].style.transform = "perspective(600px) rotateY(360deg)";
        });

        actionClose.addEventListener("click", () => {
            back[0].style.transform = "perspective(600px) rotateY(180deg)";
            front[0].style.transform = "perspective(600px) rotateY(360deg)";
        });
    }

    addEventClickPlan(action, item) {
        action.addEventListener("click", () => {
            localStorage.setItem('planSeleccionado', JSON.stringify(item));
        });
    }

    getSocialNetworks(list) {
        let textHTML = '';
        if (list) {
            for (const item of list) {
                const listNetworks = this.getNetworks(item.redes);
                const networks = `
                <div class="group">
                    <div class="images">
                        ${listNetworks}
                    </div>
                    <span>${item.titulo}</span>
                </div>
            `;

                textHTML = textHTML.concat(networks);
            }

            return textHTML;
        }

        return textHTML;

    }

    getNetworks(list) {
        let textHTML = '';

        for (const item of list) {
            if (item.imagen) {
                const networks = `
                <img src="app/assets/img/${item.imagen}" />`;
                textHTML = textHTML.concat(networks);
            }
        }

        return textHTML;
    }

    getPromotions(promo) {
        let textHTML = '';
        if (promo) {
            const promotion = `
                <span>${promo.nombrePromo}</span>
                <span>${promo.cantidadMegas}</span>
                <span>${promo.duracion}</span>`;

                textHTML = textHTML.concat(promotion);

            if (promo.imagenPromo) {
                const image = `<img src="app/assets/img/${promo.imagenPromo}"/>`;
                textHTML = textHTML.concat(image);
            }
            return textHTML;
        }
        return textHTML;

    }

    getDetails(list) {
        let textHTML = '';

        for (const item of list) {
            const details = `
            <div class="detail">
                <span>${item.titulo}</span>
                <span>${item.descripcion}</span>
            </div>
        `;

            textHTML = textHTML.concat(details);
        }

        return textHTML;
    }

    closeDetail() {

    }
}

window.customElements.define("app-card", Card);
