// inital state
const state = {
    items: [],
    checkoutStatus: null
}

// getters
const getters = {
    cartProduct: (state, getters, rootState) => {
        return state.items.map(({ product_id, quantity }) => {
            const product = rootState.products.all.find(product => product.product_id === product_id)
            return {
                product_id: product.product_id,
                name: product.name,
                price: product.price,
                tenant: product.users.name,
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
            const cartItem = state.items.find(item => item.product_id === product.product_id)
            if (!cartItem) {
                commit('pushProductToCart', { product_id: product.product_id })
            } else {
                commit('incrementItemQty', cartItem)
            }

        }
    },
    removeProductFromCart({ state, commit }, product) {
        const cartItem = state.items.find(item => item.product_id === product.product_id);

        if (cartItem) {
            if (cartItem.quantity > 1) {
                commit('decrementItemQty', { product_id: product.product_id });
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
        commit('incrementItemQty', { product_id: product.product_id });
    }
}

// mutations
const mutations = {
    pushProductToCart(state, { product_id }) {
        state.items.push({
            product_id,
            quantity: 1
        })
    },

    incrementItemQty(state, { product_id }) {
        const cartItem = state.items.find(item => item.product_id === product_id)
        cartItem.quantity++;
    },
    decrementItemQty(state, { product_id }) {
        const cartItem = state.items.find(item => item.product_id === product_id)
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