<script setup>
import { Icon } from "@iconify/vue";
import Modal from "./Modal.vue";
import { computed, defineEmits, defineProps } from "vue";
import { useStore } from "vuex";
import { router } from "@inertiajs/vue3";
const { showModal } = defineProps({
    showModal: {
        type: Boolean,
        default: false,
    },
});
const emit = defineEmits();
const store = useStore();
const checkoutStatus = computed(() => store.state.cart.checkoutStatus);
const cartProducts = computed(() => store.getters["cart/cartProduct"]);
const total = computed(() => store.getters["cart/cartTotalPrice"]);

const removeFromCart = (product) => {
    store.dispatch("cart/removeProductFromCart", product);
};
const resetCart = () => {
    store.dispatch("cart/resetCart");
};
const addItem = (product) => {
    store.dispatch("cart/addProductItem", product);
};

const getImage = (url) => {
    return `storage/${url}`;
};

const closeModal = () => {
    emit("update:showModal", false);
};

const handleGetItems = (product, total) => {
    router.visit(route("add.transaction"), {
        method: "post",
        data: {
            product: product,
            totalPrice: total,
        },
        onSuccess: () => {
            closeModal();
            resetCart();
        },
        onFinish: (visit) => {
            visit.reload();
        },
    });
};
</script>

<template>
    <Modal :show="showModal">
        <div class="p-5">
            <div class="w-full text-end">
                <button
                    class="bg-indigo-500 text-white p-1 rounded-md hover:bg-indigo-300"
                    @click="showModal = !showModal"
                >
                    <Icon icon="material-symbols:fullscreen-exit" width="20" />
                </button>
            </div>
            <h1 class="text-xl">Your Cart</h1>
            <h1
                class="w-full text-center my-5"
                v-show="cartProducts.length <= 0"
            >
                Your Cart Is Empty
            </h1>
            <div
                class="w-full flex p-2 border-b-2"
                v-for="product in cartProducts"
                :key="product.product_id"
            >
                <img :src="getImage(product.url_img)" class="w-36 rounded-md" />
                <div class="ml-2 w-1/2">
                    <h1 class="text-lg font-bold">{{ product.name }}</h1>
                    <h1 class="text-sm italic">{{ product.tenant }}</h1>
                    <h1 class="mt-5">
                        Price
                        <span class="font-bold">$ {{ product.price }}</span>
                    </h1>
                </div>
                <div class="flex flex-row items-end justify-end w-full">
                    <button
                        @click="removeFromCart(product)"
                        class="w-8 h-8 bg-indigo-500 flex items-center justify-center rounded-l-lg text-white hover:scale-95 text-2xl"
                    >
                        -
                    </button>
                    <h1
                        class="min-h-8 min-w-10 px-2 text-center flex justify-center items-center bg-slate-300"
                    >
                        x{{ product.quantity }}
                    </h1>
                    <button
                        @click="addItem(product)"
                        class="w-8 h-8 bg-indigo-500 flex items-center justify-center rounded-r-lg text-white hover:scale-95 text-2xl"
                    >
                        +
                    </button>
                </div>
            </div>
            <div class="w-full text-end text-xl font-bold">
                Total Price: $ {{ total }}
            </div>
            <div class="w-full flex justify-end">
                <button
                    @click="handleGetItems(cartProducts, total)"
                    class="bg-yellow-500 text-white p-2 rounded-lg hover:bg-yellow-300 hover:scale-95"
                    v-show="cartProducts.length"
                >
                    CheckOut
                </button>
            </div>
        </div>
    </Modal>
</template>
