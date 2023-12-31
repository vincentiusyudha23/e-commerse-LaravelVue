<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: {
        type: String,
    },
    active: {
        type: Boolean,
    },
});

const classes = computed(() =>
    props.active
        ? 'text-indigo-500 text-sm font-bold hover:bg-indigo-500/30 bg-indigo-500/30 flex items-center p-2 rounded-lg'
        : 'text-indigo-500 text-sm font-bold hover:bg-indigo-500/30 flex items-center p-2 rounded-lg'
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
