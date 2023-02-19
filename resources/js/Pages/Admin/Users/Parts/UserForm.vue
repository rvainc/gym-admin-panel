<template>
    <form @submit.prevent="submit">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label for="firstNameInput" class="form-label">Ім'я</label>
                    <input
                        type="text"
                        class="form-control"
                        :class="{'is-invalid': form.errors.name}"
                        id="firstNameInput"
                        v-model="form.name"
                    >
                    <input-error :message="form.errors.name"></input-error>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label for="lastNameInput" class="form-label">Електронна пошта</label>
                    <input
                        type="email"
                        class="form-control"
                        :class="{'is-invalid': form.errors.email}"
                        id="lastNameInput"
                        v-model="form.email"
                    >
                    <input-error :message="form.errors.email"></input-error>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label for="phoneNumberInput" class="form-label">Пароль</label>
                    <input
                        type="password"
                        class="form-control"
                        :class="{'is-invalid': form.errors.password}"
                        id="phoneNumberInput"
                        v-model="form.password"
                    >
                    <input-error :message="form.errors.password"></input-error>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="form-label">Підтвердження паролю</label>
                    <input
                        type="password"
                        class="form-control"
                        :class="{'is-invalid': form.errors.password_confirmation}"
                        id="cardNumberInput"
                        v-model="form.password_confirmation"
                    >
                    <input-error :message="form.errors.password_confirmation"></input-error>
                </div>
            </div>
        </div>
        <div v-if="model.meta.can.changeRole" class="row">
            <div class="col-12 col-md-3">
                <div class="mb-3">
                    <label for="lastNameInput" class="form-label">Роль</label>
                    <VueSelect v-model="form.role" :options="roleOptions" :reduce="role => role.value"></VueSelect>
                    <input-error :message="form.errors.role"></input-error>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary" :disabled="form.processing">Зберегти</button>
    </form>
</template>

<script setup>
import InputError from "@/Components/Inputs/InputError.vue";
import {useForm} from "@inertiajs/inertia-vue3";
import VueSelect from "vue-select";

const props = defineProps({
    url: String,
    model: Object,
    method: {
        type: String,
        default: 'POST',
    },
    isEditMode: {
        type: Boolean,
        default: false,
    },
    roleOptions: {
        type: Array,
    },
});

function submit() {
    form.transform(data => ({
        ...data,
        _method: props.method,
    }))
        .post(props.url);
}

const form = useForm({
    name: _.get(props.model.data, 'name', null),
    email: _.get(props.model.data, 'email', null),
    role: _.get(props.model.data, 'role', null),
    password: null,
    password_confirmation: null,
});
</script>
