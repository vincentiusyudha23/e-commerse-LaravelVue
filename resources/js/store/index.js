import { createStore } from "vuex";
import products from "./module/products";
import cart from "./module/cart";

export default createStore({
    modules: {
        cart,
        products
    }
})