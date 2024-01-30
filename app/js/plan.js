import { getPlans } from "./services.js"

export class Plan {
    constructor() {
        this.plans = this.getListPlans() || [];
    }

    async getListPlans() {
        return await getPlans() || [];
    }
}