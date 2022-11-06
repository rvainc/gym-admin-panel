<template>
    <AuthenticatedLayout>
        <div class="d-flex align-auto align-items-center">
            <div class="h4 m-0 me-auto">Клієнти</div>
            <div>
                <Link :href="route('admin.customers.create')" class="btn btn-secondary">
                    <i class="fa-sharp fa-solid fa-plus"></i>
                </Link>
            </div>
        </div>
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
    </AuthenticatedLayout>
</template>

<script setup>
import {Link} from "@inertiajs/inertia-vue3";
import AuthenticatedLayout from '@/Layouts/Admin/AuthenticatedLayout.vue';
defineProps([
    'customers',
]);
</script>
