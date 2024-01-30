import { getDepartamentos, getDistritos, getProvincias } from "./services.js"

export class Ubigeos {
    constructor() {
        this.departamentos = this.getListDepartamentos() || [];
        this.provincias = this.getListProvincias() || [];
        this.distritos = this.getListDistritos() || [];
    }

    async getListDepartamentos() {
        return await getDepartamentos() || [];
    }

    async getListProvincias() {
        return await getProvincias() || [];
    }

    async getListDistritos() {
        return await getDistritos() || [];
    }

    async findByIdDepartamento(name) {
        const items = await this.getListDepartamentos();
        const item = items.find((element) => element.nombre_ubigeo == name);
        return item.id_ubigeo;
    }

    findByIdProvinces(items, name) {
        const item = items.find((element) => element.nombre_ubigeo == name);
        return item.id_ubigeo;
    }

    async filterProvinceById(id) {
        const items = await this.getListProvincias();
        const list = items[+id];
        return list;
    }

    async filterDistrictById(id) {
        const items = await this.getListDistritos();
        const list = items[+id];
        return list;
    }
}