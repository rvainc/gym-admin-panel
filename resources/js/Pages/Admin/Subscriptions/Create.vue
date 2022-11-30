<template>
    <authenticated-layout>
        <div class="h5 mb-4">Створити підписку</div>
        <form @submit.prevent="form.post(route('admin.subscriptions.store'))">
            <div class="row">
                <div class="col-12">
                    <div class="mb-3">
                        <label for="firstNameInput" class="form-label">Назва</label>
                        <input type="text" class="form-control" id="firstNameInput" v-model="form.title">
                        <input-error :message="form.errors.title"></input-error>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="lastNameInput" class="form-label">Кількість днів</label>
                        <input type="number" min="1" class="form-control" id="lastNameInput" v-model="form.days">
                        <input-error :message="form.errors.days"></input-error>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="phoneNumberInput" class="form-label">Ціна в гривнях</label>
                        <input
                            min="0"
                            step="0.01"
                            type="number"
                            class="form-control hide-arrows"
                            id="phoneNumberInput"
                            v-model="form.price"
                        >
                        <input-error :message="form.errors.price"></input-error>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary" :disabled="form.processing">Зберегти</button>
        </form>
    </authenticated-layout>
    <bar-code-reader-modal :show="showBarCodeReader" @closed="showBarCodeReader = false" @decode="onDecode"/>
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
    title: null,
    days: 1,
    price: null,
});
</script>

<style scoped>
.hide-arrows::-webkit-outer-spin-button,
.hide-arrows::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

.hide-arrows[type=number] {
    -moz-appearance: textfield;
}
</style>
