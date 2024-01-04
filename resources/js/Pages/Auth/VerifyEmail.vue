<script setup>
import { computed } from "vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";

const props = defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    store_name: "",
});

const submit = () => {
    form.post(route("verification.send"));
};

const verificationLinkSent = computed(
    () => props.status === "verification-link-sent"
);
</script>

<template>
    <GuestLayout>
        <Head title="Email Verification" />

        <div class="mb-4 text-sm text-gray-600">
            To create a shop, you must verify your email!
        </div>

        <div
            class="mb-4 font-medium text-sm text-green-600"
            v-if="verificationLinkSent"
        >
            A new verification link has been sent to the email address you
            provided during registration.
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="storeName" value="Store Name" />
                <TextInput
                    id="storename"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.store_name"
                    required
                />
                <InputError class="mt-2" :message="form.errors.store_name" />
            </div>
            <div class="mt-4 flex items-center justify-between">
                <PrimaryButton
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Resend Verification Email
                </PrimaryButton>

                <Link
                    :href="route('home')"
                    as="button"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >Back to Home</Link
                >
            </div>
        </form>
    </GuestLayout>
</template>
