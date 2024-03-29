import { sendNumber } from "./services.js";
import { validateForm } from "./utils.js";

const formNumber = document.getElementById("form_number");

formNumber.onsubmit = async (e) => {
    e.preventDefault();
    const btnSendNumber = document.getElementById('btnSendNumber');
    const loader = document.getElementById('loader2');

    btnSendNumber.disabled = true;
    loader.removeAttribute('hidden', '');

    const resp = await sendNumber(formNumber);

    if (resp.sendEmail) {
        formNumber.elements["celularcontacto"].value = null;
        btnSendNumber.disabled = false;
        loader.setAttribute('hidden', '');
        alert('Se envío el correo éxitosamente!');
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