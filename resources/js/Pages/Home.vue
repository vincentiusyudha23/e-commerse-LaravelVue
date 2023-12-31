<script setup>
import GlobalLayout from "@/Layouts/GlobalLayout.vue";
import { Head } from "@inertiajs/vue3";
import { ref, computed } from "vue";
import CardView from "@/Components/CardView.vue";
import { useStore } from "vuex";
import ShoppingCart from "@/Components/ShoppingCart.vue";
import { Icon } from "@iconify/vue";

// defineProps({
//     data: Object,
// });

const showModal = ref(false);
const showNotif = ref(false);

const store = useStore();
const products = computed(() => store.state.products.all);
const cartProducts = computed(() => store.getters["cart/cartProduct"]);
const cartTotalProducts = computed(
    () => store.getters["cart/cartTotalProducts"]
);

const addToCart = (product) => {
    store.dispatch("cart/addProductToCart", product);
    showNotif.value = !showNotif.value;

    setTimeout(() => {
        showNotif.value = false;
    }, 1500);
};

const updateShowModal = (value) => {
    showModal.value = value;
};

store.dispatch("products/getAllProducts");
</script>

<template>
    <Head title="Home" />
    <GlobalLayout>
        <div
            class="w-72 p-2 bg-green-300 rounded-lg fixed right-5 animate-openMenu"
            v-show="showNotif"
        >
            <h1>success add to cart</h1>
        </div>
        <div
            class="w-72 p-2 bg-green-300 rounded-lg fixed right-5 animate-openMenu"
            v-show="$page.props.flash.message"
        >
            <h1>{{ $page.props.flash.message }}</h1>
        </div>
        <div class="w-full h-screen flex flex-wrap gap-3">
            <CardView
                v-for="product in products"
                :key="product.product_id"
                :title="product.name"
                :tenant="product.users.name"
                :price="product.price"
                :image="product.url_img"
                :stock="product.stock"
            >
                <button
                    v-show="$page.props.auth.user"
                    :disabled="product.stock <= 0"
                    @click="addToCart(product)"
                    class="bg-indigo-500 p-2 rounded-md hover:bg-indigo-300 text-white flex"
                >
                    +
                    <Icon icon="entypo:shopping-cart" width="20" />
                </button>
            </CardView>
            <div class="fixed right-5 bottom-5" v-if="$page.props.auth.user">
                <button
                    @click="showModal = !showModal"
                    class="bg-indigo-500 p-3 rounded-full text-white hover:scale-95 hover:bg-indigo-300 shadow-md"
                >
                    <div
                        class="w-6 h-6 bg-red-500 absolute right-0 -top-2 rounded-full text-white"
                        v-show="cartProducts.length > 0"
                    >
                        {{ cartTotalProducts }}
                    </div>
                    <Icon icon="entypo:shopping-cart" width="35" />
                </button>
            </div>
        </div>
        <ShoppingCart
            :show-modal="showModal"
            @update:showModal="updateShowModal"
        />
    </GlobalLayout>
</template>
