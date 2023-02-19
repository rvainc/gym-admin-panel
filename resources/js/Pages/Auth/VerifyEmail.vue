<template>
    <GuestLayout title="Верефікація електронної пошти">
        <div class="mb-4 text-secondary" style="font-size: 14px">
            Дякую за реєстрацію! Перед тим як ви почнете роботу, будь ласка, верефікуйте свою електронну пошту, просто
            перейшовши за посиланням, яке ми зараз вам надішлемо. Якщо ви не отримаєте повідомлення, ми з радістю
            надішлемо вам його повторно.
        </div>
        <div class="mb-4 text-success" v-if="verificationLinkSent">
            Нове посилання для підтвердження було надіслано на електронну адресу, яку ви вказали під час реєстрації.
        </div>

        <form @submit.prevent="submit">
            <div class="mt-4 d-flex align-items-center justify-content-between">
                <button class="btn btn-primary" :class="{ 'disabled': form.processing }">
                    Надіслати
                </button>

                <Link
                    :href="route('logout')"
                    method="post"
                    type="button"
                    class="btn btn-secondary"
                >
                    Вийти
                </Link>
            </div>
        </form>
    </GuestLayout>
</template>

<script setup>
import {computed} from 'vue';
import GuestLayout from '@/Layouts/Admin/GuestLayout.vue';
import {Link, useForm} from '@inertiajs/inertia-vue3';

const props = defineProps({
    status: String,
});

const form = useForm();

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>
