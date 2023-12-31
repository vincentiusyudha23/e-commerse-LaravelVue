<script setup>
const props = defineProps({
    title: {
        type: String,
        required: true,
    },
    tenant: {
        type: String,
        required: true,
    },
    price: {
        type: String,
        required: true,
    },
    stock: {
        type: Number,
        required: true,
    },
    image: {
        type: String,
        required: true,
    },
});

const getImagePath = (urlImage) => {
    return `storage/${urlImage}`;
};
</script>

<template>
    <div class="w-64 h-96 rounded-xl shadow-lg border p-2 bg-white">
        <img
            :src="getImagePath(image)"
            class="w-full h-48 object-cover rounded-md"
        />
        <div class="w-full h-44 p-2 flex flex-col justify-between">
            <div class="w-full">
                <h1 class="font-bold text-xl">{{ title }}</h1>
                <h1 class="italic">Tenant {{ tenant }}</h1>
            </div>
            <div class="w-full">
                <h1 class="text-sm">Stock {{ stock }}</h1>
                <div class="w-full flex flex-row justify-between items-center">
                    <h1 class="text-lg font-bold">$ {{ price }}</h1>
                    <div class="flex gap-1">
                        <slot />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
