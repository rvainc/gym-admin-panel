<template>
    <GuestLayout title="Відновленя паролю">
        <form @submit.prevent="submit">
            <div class="mb-3">
                <label for="firstNameInput" class="form-label">Ваша електронна пошта</label>
                <input
                    type="email"
                    class="form-control"
                    :class="{'is-invalid': form.errors.email}"
                    id="firstNameInput"
                    v-model="form.email"
                >
                <input-error :message="form.errors.email"></input-error>
            </div>
            <div v-if="form.wasSuccessful" class="text-success my-2">Перегляньте свою поштову скриньку.</div>
            <div class="d-flex align-items-center justify-content-end">
                <button class="btn btn-primary" :class="{ disabled: form.processing }">
                    Log in
                </button>
            </div>
        </form>
    </GuestLayout>
</template>

<script setup>
import {useForm} from "@inertiajs/inertia-vue3";
import GuestLayout from '@/Layouts/Admin/GuestLayout.vue';
import InputError from '@/Components/Inputs/InputError.vue';

defineProps({
    status: String,
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>
