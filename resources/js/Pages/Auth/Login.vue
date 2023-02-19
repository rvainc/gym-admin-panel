<template>
    <GuestLayout title="Вхід">
        <form @submit.prevent="submit">
            <div class="mb-3">
                <label for="firstNameInput" class="form-label">Електронна пошта</label>
                <input
                    type="email"
                    class="form-control"
                    :class="{'is-invalid': form.errors.email}"
                    id="firstNameInput"
                    v-model="form.email"
                >
                <input-error :message="form.errors.email"></input-error>
            </div>
            <div class="mb-3">
                <label for="lastNameInput" class="form-label">Пароль</label>
                <input
                    type="password"
                    class="form-control"
                    :class="{'is-invalid': form.errors.password}"
                    id="lastNameInput"
                    v-model="form.password"
                >
                <input-error :message="form.errors.password"></input-error>
            </div>
            <div class="form-check mt-4">
                <input class="form-check-input" type="checkbox" v-model="form.remember">
                <label class="form-check-label" for="flexCheckDefault">
                    Запам'ятати мене
                </label>
            </div>
            <div class="d-flex align-items-center justify-content-between mt-4">
                <Link v-if="canResetPassword" :href="route('password.request')"
                      class="btn btn-link">
                    Забули пароль?
                </Link>
                <button class="btn btn-primary" :class="{ disabled: form.processing }">
                    Увійти
                </button>
            </div>
        </form>
    </GuestLayout>
</template>

<script setup>
import GuestLayout from '@/Layouts/Admin/GuestLayout.vue';
import InputError from '@/Components/Inputs/InputError.vue';
import {Link, useForm} from '@inertiajs/inertia-vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
        default: true,
    },
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>
