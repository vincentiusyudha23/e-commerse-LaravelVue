<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";

const form = useForm({
    name: "",
    price: "",
    stock: "",
    url_img: "",
});
const submit = () => {
    form.post(route("add.productadd"), {
        onFinish: () => form.reset(["name", "price", "stock", "url_img"]),
    });
};
</script>
<template>
    <AuthenticatedLayout>
        <Head title="Add Product" />
        <div
            v-if="$page.props.flash.message"
            class="w-60 rounded-md bg-green-300 p-3 fixed m-2 right-0 animate-openMenu"
        >
            {{ $page.props.flash.message }}
        </div>
        <div class="w-full h-screen p-5 flex justify-center items-center">
            <div class="max-w-max bg-white rounded-lg shadow-md p-10">
                <form class="w-[100%]" @submit.prevent="submit">
                    <div>
                        <h1 class="pl-2">Name Product</h1>
                        <TextInput
                            id="nameProduct"
                            type="text"
                            v-model="form.name"
                            required
                            autofocus
                            class="w-full"
                        />
                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>
                    <div>
                        <h1 class="pl-2">Stock</h1>
                        <TextInput
                            id="stock"
                            type="number"
                            v-model="form.stock"
                            required
                            autofocus
                            class="w-full"
                        />
                        <InputError class="mt-2" :message="form.errors.stock" />
                    </div>
                    <div class="mt-4">
                        <h1 class="pl-2">Price</h1>
                        <TextInput
                            id="price"
                            type="number"
                            v-model="form.price"
                            required
                            autofocus
                            class="w-full"
                        />
                        <InputError class="mt-2" :message="form.errors.price" />
                    </div>
                    <div class="mt-4">
                        <h1 class="pl-2">Image</h1>
                        <input
                            id="image"
                            type="file"
                            @input="form.url_img = $event.target.files[0]"
                            required
                            class="w-full p-1 border-2 rounded-md"
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors.url_img"
                        />
                    </div>
                    <div class="w-full mt-4 flex justify-end">
                        <PrimaryButton
                            class="bg-indigo-500"
                            :class="{ 'opacity-25': form.processing }"
                            >Save</PrimaryButton
                        >
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
