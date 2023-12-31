<script setup>
import { ref } from "vue";
import NavLink from "@/Components/NavLink.vue";
import { Link } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";

const showListMenuDashboard = ref(false);
const showListMenuAccount = ref(false);
const showNavbar = ref(false);

const handleOpenMenuDashboard = () => {
    showListMenuDashboard.value = !showListMenuDashboard.value;
    showListMenuAccount.value = false;
};
const handleOpenMenuAccount = () => {
    showListMenuAccount.value = !showListMenuAccount.value;
    showListMenuDashboard.value = false;
};
</script>

<template>
    <div>
        <button
            @click="showNavbar = !showNavbar"
            class="md:hidden fixed transform rotate-90 -left-5 top-20 px-3 py-1 rounded-t-md text-white bg-indigo-500"
        >
            Menu
        </button>
        <div class="min-h-screen bg-gray-100 flex flex-row">
            <nav
                class="bg-white min-w-60 h-screen shadow-md hidden md:block fixed"
                :class="{ openNav: showNavbar, hiddennavbar: !showNavbar }"
            >
                <button
                    class="w-full flex justify-end px-5 pt-2 text-2xl text-indigo-500 md:hidden"
                    @click="showNavbar = !showNavbar"
                >
                    <Icon
                        icon="material-symbols:expand-circle-down"
                        class="transform rotate-90"
                    />
                </button>
                <!-- Title Web -->
                <div
                    class="w-full h-28 flex items-center justify-center text-indigo-500"
                >
                    <Icon
                        icon="material-symbols:shopping-bag"
                        class="text-4xl pb-1"
                    />
                    <h1 class="text-indigo-500 font-extrabold text-2xl">
                        <span class="text-4xl">E</span>Commerce
                    </h1>
                </div>
                <!-- Primary Navigation Menu -->
                <div class="h-[80%] md:h-[82%]">
                    <div class="flex flex-col justify-between h-full">
                        <div class="flex px-2 flex-col gap-1">
                            <!-- Navigation Links -->
                            <button
                                class="text-indigo-500 text-md font-bold hover:bg-indigo-500/30 flex items-center p-2 rounded-lg"
                                @click="handleOpenMenuDashboard"
                            >
                                <Icon
                                    icon="material-symbols:dashboard"
                                    class="mr-1"
                                    width="20"
                                />
                                Dashboard
                            </button>
                            <div
                                class="pl-5 flex flex-col gap-1 animate-openMenu"
                                :class="{
                                    block: showListMenuDashboard,
                                    hidden: !showListMenuDashboard,
                                }"
                            >
                                <NavLink
                                    :href="route('dashboard')"
                                    :active="route().current('dashboard')"
                                >
                                    <Icon
                                        icon="material-symbols:shopping-bag"
                                        width="20"
                                        class="mr-1"
                                    />
                                    Product
                                </NavLink>
                                <NavLink
                                    :href="route('productadd')"
                                    :active="route().current('productadd')"
                                >
                                    <Icon
                                        icon="material-symbols:add-box"
                                        width="20"
                                        class="mr-1"
                                    />
                                    Add Product
                                </NavLink>
                            </div>
                            <button
                                class="text-indigo-500 text-md font-bold hover:bg-indigo-500/30 flex items-center p-2 rounded-lg"
                                @click="handleOpenMenuAccount"
                            >
                                <Icon
                                    icon="material-symbols:person"
                                    class="mr-1"
                                    width="20"
                                />
                                Account Settings
                            </button>
                            <div
                                class="pl-5 flex flex-col gap-1 animate-openMenu"
                                :class="{
                                    block: showListMenuAccount,
                                    hidden: !showListMenuAccount,
                                }"
                            >
                                <NavLink
                                    :href="route('profile.edit')"
                                    :active="route().current('profile.edit')"
                                >
                                    <Icon
                                        icon="material-symbols:person"
                                        class="mr-1"
                                        width="20"
                                    />
                                    Profile
                                </NavLink>
                                <NavLink
                                    :href="route('logout')"
                                    method="post"
                                    as="button"
                                >
                                    <Icon
                                        icon="solar:logout-2-bold"
                                        class="mr-1"
                                        width="20"
                                    />
                                    Log Out
                                </NavLink>
                            </div>
                        </div>
                        <div class="w-full flex items-center justify-end px-5">
                            <Link
                                class="text-white bg-indigo-500 p-2 rounded-lg shadow-md hover:scale-95"
                                :href="route('home')"
                            >
                                <Icon icon="solar:logout-2-bold" width="25" />
                            </Link>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <!-- <header class="bg-white shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header> -->

            <!-- Page Content -->
            <main class="w-full h-screen pl-0 md:pl-60">
                <slot />
            </main>
        </div>
    </div>
</template>
<style>
.openNav {
    display: block;
    animation: animation_navbar 0.5s ease-in-out;
}
@keyframes animation_navbar {
    from {
        transform: translateX(-100%);
    }
    to {
        transform: translateX(0%);
    }
}
</style>
