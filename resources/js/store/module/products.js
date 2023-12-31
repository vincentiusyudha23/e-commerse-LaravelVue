import axios from "axios";

const state = {
    all: []
}

const getters = {}

const actions = {
    async getAllProducts({ commit }) {
        try {
            const response = await axios.get('http://127.0.0.1:8000/api/product');
            commit('setProducts', response.data)
        } catch (error) {
            console.error('Error fetching product data:', error);
        }
    }
}

const mutations = {
    setProducts(state, products) { state.all = products }
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}