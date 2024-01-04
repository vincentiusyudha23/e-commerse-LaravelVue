// inital state
const state = {
    items: [],
    checkoutStatus: null
}

// getters
const getters = {
    cartProduct: (state, getters, rootState) => {
        return state.items.map(({ id, quantity }) => {
            const product = rootState.products.all.find(product => product.id === id)
            return {
                id: product.id,
                name: product.name,
                price: product.price,
                tenant: product.store_name,
                url_img: product.url_img,
                quantity
            }
        })
    },
    cartTotalPrice: (state, getters) => {
        return getters.cartProduct.reduce((total, product) => {
            return total + product.price * product.quantity
        }, 0)
    },
    cartTotalProducts: (state) => state.items.length
}

// actions
const actions = {
    addProductToCart({ state, commit }, product) {
        commit('setCheckoutStatus', null)
        if (product.stock > 0) {
            const cartItem = state.items.find(item => item.id === product.id)
            if (!cartItem) {
                commit('pushProductToCart', { id: product.id })
            } else {
                commit('incrementItemQty', cartItem)
            }

        }
    },
    removeProductFromCart({ state, commit }, product) {
        const cartItem = state.items.find(item => item.id === product.id);

        if (cartItem) {
            if (cartItem.quantity > 1) {
                commit('decrementItemQty', { id: product.id });
            } else {
                commit('removeProduct', cartItem);
            }
        }
    },
    resetCart({ commit }) {
        commit('setCheckoutStatus', null)
        commit('setCartItems', { items: [] })
    },
    addProductItem({ commit }, product) {
        commit('incrementItemQty', { id: product.id });
    }
}

// mutations
const mutations = {
    pushProductToCart(state, { id }) {
        state.items.push({
            id,
            quantity: 1
        })
    },

    incrementItemQty(state, { id }) {
        const cartItem = state.items.find(item => item.id === id)
        cartItem.quantity++;
    },
    decrementItemQty(state, { id }) {
        const cartItem = state.items.find(item => item.id === id)
        cartItem.quantity--;
    },
    removeProduct(state, cartItem) {
        const index = state.items.indexOf(cartItem);
        if (index !== -1) {
            state.items.splice(index, 1);
        }
    },
    setCartItems(state, { items }) {
        state.items = []
    },
    setCheckoutStatus(state, status) {
        state.checkoutStatus = status
    }
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}