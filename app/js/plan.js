import { getPlans } from "./services.js";

export class Plan {
    constructor() {
        this.plans = [];
        this.initializePlans();
    }

    async initializePlans() {
        try {
            this.plans = await this.getListPlans();
        } catch (error) {
            console.error("Error al obtener la lista de planes:", error);
            // Puedes manejar el error según tus necesidades.
        }
    }

    async getListPlans() {
        return await getPlans() || [];
    }
}
