<template>
    <authenticated-layout title="Cтворити клієнта">
        <div class="h5 mb-4">Створити клієнта</div>
        <form @submit.prevent="form.post(route('admin.customers.store'))">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="firstNameInput" class="form-label">Ім'я</label>
                        <input
                            type="text"
                            class="form-control"
                            :class="{'is-invalid': form.errors.first_name}"
                            id="firstNameInput"
                            v-model="form.first_name"
                        >
                        <input-error :message="form.errors.first_name"></input-error>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="lastNameInput" class="form-label">Прізвище</label>
                        <input
                            type="text"
                            class="form-control"
                            :class="{'is-invalid': form.errors.last_name}"
                            id="lastNameInput"
                            v-model="form.last_name"
                        >
                        <input-error :message="form.errors.last_name"></input-error>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="phoneNumberInput" class="form-label">Номер телефона</label>
                        <input
                            type="tel"
                            class="form-control"
                            :class="{'is-invalid': form.errors.phone_number}"
                            id="phoneNumberInput"
                            v-model="form.phone_number"
                        >
                        <input-error :message="form.errors.phone_number"></input-error>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Номер карти</label>
                        <div class="input-group">
                            <input
                                type="text"
                                class="form-control"
                                :class="{'is-invalid': form.errors.card_number}"
                                id="cardNumberInput"
                                v-model="form.card_number"
                            >
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
    <bar-code-reader-modal
        :show="showBarCodeReader"
        @closed="showBarCodeReader = false"
        @decode="onDecode"
    />
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/Admin/AuthenticatedLayout.vue';
import BarCodeReaderModal from '@/Components/ModalWindows/BarCodeReaderModal.vue'
import InputError from "@/Components/Inputs/InputError.vue";
import {useForm} from '@inertiajs/inertia-vue3'
import {ref} from "vue";

const showBarCodeReader = ref(false);

function onDecode(result) {
    showBarCodeReader.value = false;
    form.card_number = result.text;
}

const form = useForm({
    first_name: null,
    last_name: null,
    phone_number: null,
    card_number: null,
});
</script>
