export function validateForm(form) {
for (const control of form.elements) {
    control.addEventListener("keyup", () => {
        try {
            validateControl(control);
        } catch (error) {
            console.error('Error en validateForm:', error.message);
        }
    });
}
}
//Se creo un funcion separada, para manejar la logica de validacion del control
function validateControl(control) {
    const validator = control.validity;

    if (validator.patternMismatch) {
    control.classList.add('error');
    } else {
    control.classList.remove('error');
    }
}
