import { sendNumber } from "./services.js";
import { validateForm } from "./utils.js";

const formNumber = document.getElementById("form_number");

formNumber.onsubmit = async (e) => {
    e.preventDefault();
    const btnSendNumber = document.getElementById('btnSendNumber');
    const loader = document.getElementById('loader2');

    btnSendNumber.disabled = true;
    loader.removeAttribute('hidden', '');

    try {
        const resp = await sendNumber(formNumber);

        if (resp.sendEmail) {
            formNumber.elements["celularcontacto"].value = null;
            alert('Se envió el correo exitosamente!');
        }
    } catch (error) {
        console.error("Error al enviar el número:", error);
        // Agrega aquí manejo de errores adicional según sea necesario.
    } finally {
        btnSendNumber.disabled = false;
        loader.setAttribute('hidden', '');
    }
};

function actionComprar() {
    const btnComprar = document.getElementById('btnComprar');
    btnComprar.classList.add('option-buy');
    btnComprar.addEventListener("click", () => {
        localStorage.removeItem('planSeleccionado');
        window.location.href = "./registro.html";
    });
}

actionComprar();
validateForm(formNumber);


// WHATSAPP MODAL FUNCITONALITY

const whatsappModal = document.querySelector('.whatsapp-modal');
const whatsappBtnOpen = document.querySelector('.whatsapp__btnOpen');
const whatsappBtnClose = document.querySelector('.whatsapp-modal__btnClose');

whatsappBtnOpen.addEventListener("click", () => whatsappModal.classList.add('whatsapp-modal--show'));
whatsappBtnClose.addEventListener("click", () => whatsappModal.classList.remove('whatsapp-modal--show'));
