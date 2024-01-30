const URL_API_BITEL = 'backend/service'
const URL_JSON = 'app/data/ubigeos'
const URL_JSON_CARD = 'app/data/cards'

export async function getPlans() {
    const url = `${URL_JSON_CARD}/cards.json`;
    const resp = await fetch(url, {
        method: 'GET',
    });

    if (!resp.ok) return console.log('No se pudo realizar la petición');
    return await resp.json();
}

export async function sendEmail(data) {
    const url = `${URL_API_BITEL}/SaveInfoService.php`;
    const resp = await fetch(url, {
        method: 'POST',
        body: new FormData(data)
    });

    if (!resp.ok) return console.log('No se pudo realizar la petición');
    return await resp.json();
}

export async function sendNumber(data) {
    const url = `${URL_API_BITEL}/SendNumberEmail.php`;
    const resp = await fetch(url, {
        method: 'POST',
        body: new FormData(data)
    });

    if (!resp.ok) return console.log('No se pudo realizar la petición');
    return await resp.json();
}

export async function getDepartamentos() {
    const resp = await fetch(`${URL_JSON}/departamentos.json`);
    if (!resp.ok) return console.log('No se pudo realizar la petición');
    return await resp.json();
}

export async function getDistritos() {
    const resp = await fetch(`${URL_JSON}/distritos.json`);
    if (!resp.ok) return console.log('No se pudo realizar la petición');
    return await resp.json();
}

export async function getProvincias() {
    const resp = await fetch(`${URL_JSON}/provincias.json`);
    if (!resp.ok) return console.log('No se pudo realizar la petición');
    return await resp.json();
}