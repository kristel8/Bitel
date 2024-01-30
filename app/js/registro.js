import { sendEmail } from "./services.js";
import { Ubigeos } from "./ubigeos.js";
import { validateForm } from "./utils.js";

const formRegistro = document.getElementById("form_registro");
const checkbox = document.getElementById('checkPolitic');
const title = document.getElementById('main-title');

const planes = [
    { id: 1, text: 'Plan S/ 29.90', name: 'Plan 29.90', total: 'S/ 29.90' },
    { id: 2, text: 'Plan S/ 49.90', name: 'Plan 49.90', total: 'S/ 49.90' },
    { id: 3, text: 'Plan S/ 55.90', name: 'Plan 55.90', total: 'S/ 55.90' },
    { id: 4, text: 'Plan S/ 65.90', name: 'Plan 65.90', total: 'S/ 65.90' },
    { id: 5, text: 'Plan S/ 69.90', name: 'Plan 69.90', total: 'S/ 69.90' },
    { id: 6, text: 'Plan S/ 79.90', name: 'Plan 79.90', total: 'S/ 79.90' },
    { id: 7, text: 'Plan S/ 105.90', name: 'Plan 105.90', total: 'S/ 105.90' }
]

const ubigeos = new Ubigeos();
let provincias;

formRegistro.onsubmit = async (e) => {
    console.log(formRegistro.validity)
    e.preventDefault();
    const btnSend = document.getElementById('btnSend');
    const loader = document.getElementById('loader');

    btnSend.disabled = true;
    loader.removeAttribute('hidden', '');

    const resp = await sendEmail(formRegistro);

    if (resp.sendEmail) {
        btnSend.disabled = false;
        loader.setAttribute('hidden', '');
        window.location.href = "/";
        alert('Los datos fueron enviados exitosamente.');
    }
};

async function activeBtnSend() {
    const btnSend = document.getElementById('btnSend');
    btnSend.disabled = true;
    if (checkbox.checked) btnSend.disabled = false;
}

async function listarDepartamentos() {
    const departamentos = await ubigeos.departamentos;

    createSelect('department', departamentos);
}

async function listarProvincias() {
    const selected = document.getElementById("department");
    const idDepartment = await ubigeos.findByIdDepartamento(selected.value);
    provincias = await ubigeos.filterProvinceById(idDepartment);
    createSelect('province', provincias);
}

async function listarDistrito() {
    const selected = document.getElementById("province");
    const idProvince = ubigeos.findByIdProvinces(provincias, selected.value);
    const distritos = await ubigeos.filterDistrictById(idProvince);
    createSelect('district', distritos);
}

function createSelect(selectId, items) {
    const select = document.getElementById(selectId);
    const lista = [];

    const seleccione = `<option hidden selected>Seleccione</option>`;
    lista.push(seleccione);

    for (const item of items) {
        const option = `<option value="${item.nombre_ubigeo}">${item.nombre_ubigeo}</option>`;
        lista.push(option)
    }

    select.innerHTML = lista;

    if (selectId === 'department') addEventChange(select, listarProvincias);
    if (selectId === 'province') addEventChange(select, listarDistrito);
}

function createSelectPlan(selectId, items) {
    const select = document.getElementById(selectId);
    const lista = [];

    const seleccione = `<option value='' hidden>Seleccione</option>`;
    lista.push(seleccione);

    for (const item of items) {
        const option = `<option value="${item.text}">${item.text}</option>`;
        lista.push(option)
    }

    select.innerHTML = lista;
    addEventChangePlan(select);
}

function addEventChangePlan(select) {
    select.addEventListener("change", () => {
        selectPlan(select.value);
    });
}

function addEventChange(event, action) {
    event.addEventListener("change", () => {
        action();
    });
}

function selectPlan(plan) {
    const containerOrder = document.getElementById('detailOrder');
    const item = planes.find((element) => element.text === plan || plan.includes(element.total));

    const list = `
    <div class="item col">
        <span>Producto</span>
        <input type="text" id="producto" name="producto" class="form-control" value="${item.name}" readonly />
    </div>
    <div class="item col">
        <span>Modalidad</span>
        <input type="text" id="modalidad" name="modalidad" class="form-control" value="Portabilidad" readonly />
    </div>
    <div class="item col">
        <span>Cantidad</span>
        <input type="text" id="cantidad" name="cantidad" class="form-control" value="1" readonly />
    </div>
    <div class="item col">
        <span>Total</span>
        <input type="text" id="total" name="total" class="form-control" value="${item.total}" readonly />
    </div>
`
    containerOrder.innerHTML = list;
}

function validatePlan() {
    const planSeleccionado = JSON.parse(localStorage.getItem('planSeleccionado'));

    if (planSeleccionado) {
        selectPlan(planSeleccionado.titulo);
        const containerPlan = document.getElementById('containerPlan');
        containerPlan.setAttribute('style', 'display: none');
        return;
    }

    const btnCancel = document.getElementById('btnCancel');
    btnCancel.setAttribute('style', 'display: none');
    const plan = document.getElementById('plan');
    plan.setAttribute('required', '');
}

function changeTitle() {
    title.classList.add('title-secondary');
}

changeTitle();
validatePlan();
createSelectPlan('plan', planes);
listarDepartamentos();
validateForm(formRegistro);
addEventChange(checkbox, activeBtnSend);