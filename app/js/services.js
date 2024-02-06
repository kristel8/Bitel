const URL_API_BITEL = 'backend/service';
const URL_JSON = 'app/data/ubigeos';
const URL_JSON_CARD = 'app/data/cards';

export async function getPlans() {
    try {
        const url = `${URL_JSON_CARD}/cards.json`;
        const resp = await fetch(url, { method: 'GET' });

        if (!resp.ok) {
            throw new Error('No se pudo realizar la petición');
        }

        return await resp.json();
    } catch (error) {
        console.error('Error en getPlans:', error.message);
        throw error;
    }
}

export async function sendEmail(data) {
    try {
        const url = `${URL_API_BITEL}/SaveInfoService.php`;
        const resp = await fetch(url, { method: 'POST', body: new FormData(data) });

        if (!resp.ok) {
            throw new Error('No se pudo realizar la petición');
        }

        return await resp.json();
    } catch (error) {
        console.error('Error en sendEmail:', error.message);
        throw error;
    }
}

export async function sendNumber(data) {
    try {
        const url = `${URL_API_BITEL}/SendNumberEmail.php`;
        const resp = await fetch(url, { method: 'POST', body: new FormData(data) });

        if (!resp.ok) {
            throw new Error('No se pudo realizar la petición');
        }

        return await resp.json();
    } catch (error) {
        console.error('Error en sendNumber:', error.message);
        throw error;
    }
}

export async function getDepartamentos() {
    try {
        const resp = await fetch(`${URL_JSON}/departamentos.json`);
        if (!resp.ok) {
            throw new Error('No se pudo realizar la petición');
        }

        return await resp.json();
    } catch (error) {
        console.error('Error en getDepartamentos:', error.message);
        throw error;
    }
}

export async function getDistritos() {
    try {
        const resp = await fetch(`${URL_JSON}/distritos.json`);
        if (!resp.ok) {
            throw new Error('No se pudo realizar la petición');
        }

        return await resp.json();
    } catch (error) {
        console.error('Error en getDistritos:', error.message);
        throw error;
    }
}

export async function getProvincias() {
    try {
        const resp = await fetch(`${URL_JSON}/provincias.json`);
        if (!resp.ok) {
            throw new Error('No se pudo realizar la petición');
        }

        return await resp.json();
    } catch (error) {
        console.error('Error en getProvincias:', error.message);
        throw error;
    }
}
