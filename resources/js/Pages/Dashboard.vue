<script setup>
import CardView from "@/Components/CardView.vue";
import Modal from "@/Components/Modal.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import { Icon } from "@iconify/vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps({
    data: Object,
});

const showModal = ref(false);
const idProduct = ref(0);
const idxImage = ref(0);
const getImage = (urlImage) => {
    return `storage/${urlImage}`;
};
const form = useForm({
    name: "",
    price: "",
    stock: "",
    url_img: "",
});
const hanleGetProduct = (Idx, Idvalue) => {
    idProduct.value = Idvalue;
    idxImage.value = Idx;
    form.name = props.data.product[Idx].name;
    form.price = props.data.product[Idx].price;
    form.stock = props.data.product[Idx].stock;
    showModal.value = !showModal.value;
};

const submit = () => {
    form.post(route("update.product", { product: idProduct.value }), {
        onFinish: () => (showModal.value = !showModal.value),
    });
};
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div
            v-if="$page.props.flash.message"
            class="alert w-60 rounded-md bg-green-300 p-3 fixed m-2 right-0 animate-openMenu"
        >
            {{ $page.props.flash.message }}
        </div>
        <div
            class="w-full pt-5 max-h-[100%] overflow-y-scroll flex justify-center"
            v-if="data && data.product.length"
        >
            <div class="flex flex-row flex-wrap gap-2 max-w-[82%]">
                <CardView
                    v-for="(item, index) in data.product"
                    :key="index"
                    :title="item.name"
                    :tenant="$page.props.auth.user.name"
                    :price="item.price"
                    :image="item.url_img"
                    :stock="item.stock"
                    :show-modal="showModal"
                >
                    <button
                        class="bg-indigo-500 p-2 rounded-md hover:bg-indigo-300 text-white"
                        @click="hanleGetProduct(index, item.product_id)"
                    >
                        <Icon icon="material-symbols:edit-square" width="20" />
                    </button>
                </CardView>
            </div>
        </div>
        <div
            class="h-screen text-center justify-center flex items-center"
            v-else
        >
            <h1 class="text-lg font-bold capitalize">
                there are no products in your shop
            </h1>
        </div>
        <Modal :show="showModal" max-width="2xl">
            <div class="w-full p-4">
                <div class="w-full text-end">
                    <button
                        class="bg-indigo-500 text-white p-1 rounded-md hover:bg-indigo-300"
                        @click="showModal = !showModal"
                    >
                        <Icon
                            icon="material-symbols:fullscreen-exit"
                            width="20"
                        />
                    </button>
                </div>
                <div class="w-full">
                    <div class="w-full flex flex-col">
                        <h1 class="font-bold mb-2 text-lg">Edit Product</h1>
                        <form class="px-3 py-1 w-full" @submit.prevent="submit">
                            <img
                                :src="getImage(data.product[idxImage].url_img)"
                                class="w-[50%] object-cover rounded-lg mb-3"
                            />
                            <div>
                                <input
                                    id="image"
                                    type="file"
                                    @input="
                                        form.url_img = $event.target.files[0]
                                    "
                                    class="w-full p-1 border-2 rounded-md"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.url_img"
                                />
                            </div>
                            <div class="mt-2">
                                <InputLabel for="name" value="Product Name" />
                                <TextInput
                                    id="name"
                                    type="text"
                                    v-model="form.name"
                                    class="w-full"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.name"
                                />
                            </div>
                            <div class="mt-2">
                                <InputLabel for="stock" value="Stock" />
                                <TextInput
                                    id="stock"
                                    type="number"
                                    v-model="form.stock"
                                    class="w-full"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.stock"
                                />
                            </div>
                            <div class="mt-2">
                                <InputLabel for="price" value="Price" />
                                <TextInput
                                    id="price"
                                    type="number"
                                    v-model="form.price"
                                    class="w-full"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.price"
                                />
                            </div>
                            <div class="w-full pt-3 flex justify-end">
                                <PrimaryButton
                                    class="bg-indigo-500"
                                    :class="{ 'opacity-25': form.processing }"
                                    >Save</PrimaryButton
                                >
                                <Link
                                    :href="
                                        route('delete.product', {
                                            product: idProduct,
                                        })
                                    "
                                    @click="showModal = !showModal"
                                    method="delete"
                                    class="bg-red-500 p-2 rounded-md text-white mx-2 hover:bg-red-300 hover:cursor-pointer"
                                    >DELETE</Link
                                >
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </Modal>
    </AuthenticatedLayout>
</template>
