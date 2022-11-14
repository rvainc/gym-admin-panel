<template>
    <authenticated-layout>
        <div v-if="labels.length" class="mb-3">
            <Link v-for="label in labels" :href="label.url">
                <span class="badge bg-secondary">
                    {{ label.title }}
                    <i class="ms-1 fa-solid fa-circle-xmark"></i>
                </span>
            </Link>
        </div>
        <div class="d-flex align-auto align-items-center">
            <div class="h4 m-0 me-auto">Клієнти</div>
            <div>
                <Link :href="route('admin.customers.create')" class="btn btn-secondary">
                    <i class="fa-sharp fa-solid fa-plus"></i>
                </Link>
            </div>
        </div>
        <div v-if="customers.data.length">
            <table class="table table-striped mt-3">
                <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Повне ім'я</th>
                    <th scope="col">Телефон</th>
                    <th scope="col">Номер картки</th>
                    <th scope="col">Статус</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="customer in customers.data" :key="customer.data.id">
                    <td>{{ customer.data.id }}</td>
                    <td>{{ customer.data.full_name }}</td>
                    <td>{{ customer.data.phone_number }}</td>
                    <td>{{ customer.data.card_number || '-' }}</td>
                    <td><span class="badge text-bg-success">active</span></td>
                </tr>
                </tbody>
            </table>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li
                        v-for="item in customers.meta.links"
                        class="page-item"
                        :class="{disabled: item.active}"
                    >
                        <Link class="page-link" :href="item.url" v-html="item.label"/>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="text-center h5 mt-5" v-else>
            Жодного запису не знайдено.
            <Link :href="route('admin.customers.create')">
                Додати Клієнта.
            </Link>
        </div>
    </authenticated-layout>
</template>

<script setup>
import {Link} from "@inertiajs/inertia-vue3";
import AuthenticatedLayout from '@/Layouts/Admin/AuthenticatedLayout.vue';

const props = defineProps([
    'customers',
    'labels'
]);
</script>
