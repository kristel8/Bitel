import { getDepartamentos, getDistritos, getProvincias } from "./services.js";

export class Ubigeos {
    constructor() {
        this.departamentos = [];
        this.provincias = [];
        this.distritos = [];
    }

    async init() {
        try {
            this.departamentos = await this.getListDepartamentos();
            this.provincias = await this.getListProvincias();
            this.distritos = await this.getListDistritos();
        } catch (error) {
            console.error('Error en la inicialización de Ubigeos:', error.message);
            throw error;
        }
    }

    async getListDepartamentos() {
        try {
            return await getDepartamentos() || [];
        } catch (error) {
            console.error('Error en getListDepartamentos:', error.message);
            throw error;
        }
    }

    async getListProvincias() {
        try {
            return await getProvincias() || [];
        } catch (error) {
            console.error('Error en getListProvincias:', error.message);
            throw error;
        }
    }

    async getListDistritos() {
        try {
            return await getDistritos() || [];
        } catch (error) {
            console.error('Error en getListDistritos:', error.message);
            throw error;
        }
    }

    async findByIdDepartamento(name) {
        try {
            const items = await this.getListDepartamentos();
            const item = items.find((element) => element.nombre_ubigeo === name);
            return item ? item.id_ubigeo : null;
        } catch (error) {
            console.error('Error en findByIdDepartamento:', error.message);
            throw error;
        }
    }

    findByIdProvinces(items, name) {
        const item = items.find((element) => element.nombre_ubigeo === name);
        return item ? item.id_ubigeo : null;
    }

    async filterProvinceById(id) {
        try {
            const items = await this.getListProvincias();
            return items[+id] || null;
        } catch (error) {
            console.error('Error en filterProvinceById:', error.message);
            throw error;
        }
    }

    async filterDistrictById(id) {
        try {
            const items = await this.getListDistritos();
            return items[+id] || null;
        } catch (error) {
            console.error('Error en filterDistrictById:', error.message);
            throw error;
        }
    }
}
