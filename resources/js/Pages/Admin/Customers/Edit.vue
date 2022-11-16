<template>
    <authenticated-layout>
        <div class="h5 mb-4">Редагувати клієнта</div>
        <form @submit.prevent="form.patch(route('admin.customers.update', customer.data.id))">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="firstNameInput" class="form-label">Ім'я</label>
                        <input type="text" class="form-control" id="firstNameInput" v-model="form.first_name">
                        <input-error :message="form.errors.first_name"></input-error>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="lastNameInput" class="form-label">Прізвище</label>
                        <input type="text" class="form-control" id="lastNameInput" v-model="form.last_name">
                        <input-error :message="form.errors.last_name"></input-error>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="phoneNumberInput" class="form-label">Номер телефона</label>
                        <input type="tel" class="form-control" id="phoneNumberInput" v-model="form.phone_number">
                        <input-error :message="form.errors.phone_number"></input-error>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Номер карти</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="cardNumberInput" v-model="form.card_number">
                            <button class="btn btn-outline-secondary" @click.prevent="showBarCodeReader = true">
                                <i class="fa-solid fa-barcode"></i>
                            </button>
                        </div>
                        <input-error :message="form.errors.card_number"></input-error>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary" :disabled="form.processing">Зберегти</button>
        </form>
    </authenticated-layout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/Admin/AuthenticatedLayout.vue';
import InputError from "@/Components/Inputs/InputError.vue";
import {useForm} from "@inertiajs/inertia-vue3";

const props = defineProps([
    'customer',
]);

const form = useForm({
    first_name: props.customer.data.first_name,
    last_name: props.customer.data.last_name,
    phone_number: props.customer.data.phone_number,
    card_number: props.customer.data.card_number,
});
</script>
