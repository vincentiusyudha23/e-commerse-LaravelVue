<script setup>
import { ref } from "vue";
import { Icon } from "@iconify/vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
</script>
<template>
    <div
        class="w-full h-24 bg-white shadow-md flex flex-row justify-between items-center p-5 fixed z-10"
    >
        <div class="flex items-center">
            <Icon
                icon="material-symbols:shopping-bag"
                class="text-4xl pb-1 text-indigo-500"
            />
            <h1 class="text-2xl font-extrabold text-indigo-500">
                <span class="text-4xl">E</span>Commerce
            </h1>
        </div>
        <div class="flex">
            <div class="flex flex-col items-center">
                <Dropdown align="right" width="48">
                    <template #trigger>
                        <button
                            class="hover:scale-95 text-white bg-indigo-500 rounded-full p-2"
                        >
                            <Icon
                                icon="material-symbols:account-circle"
                                width="30"
                            />
                        </button>
                    </template>
                    <template #content v-if="$page.props.auth.user">
                        <DropdownLink
                            :href="route('dashboard')"
                            v-if="$page.props.auth.user.email_verified_at"
                            >My Store</DropdownLink
                        >
                        <DropdownLink
                            :href="route('verification.notice')"
                            v-else
                            >Create a Store</DropdownLink
                        >
                        <DropdownLink
                            :href="route('logout')"
                            method="post"
                            as="button"
                            >Log Out</DropdownLink
                        >
                    </template>
                    <template #content v-else>
                        <DropdownLink :href="route('login')"
                            >Login</DropdownLink
                        >
                        <DropdownLink :href="route('register')"
                            >Register</DropdownLink
                        >
                    </template>
                </Dropdown>
                <h1 v-if="$page.props.auth.user" class="">
                    {{ $page.props.auth.user.name }}
                </h1>
            </div>
        </div>
    </div>
    <div class="pt-28 px-20">
        <slot />
    </div>
</template>
