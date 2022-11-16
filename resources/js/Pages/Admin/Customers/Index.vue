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
            <table class="table table-hover mt-3 w-100">
                <thead>
                <tr>
                    <th scope="col" style="width: 1%">#</th>
                    <th scope="col">
                        <div>Клієнт</div>
                    </th>
                    <th scope="col" class="d-none d-md-table-cell" style="width: 20%">Телефон</th>
                    <th scope="col" class="d-none d-md-table-cell" style="width: 20%">Номер картки</th>
                    <th scope="col" class="d-none d-md-table-cell" style="width: 1%">Статус</th>
                    <th scope="col" style="width: 1%"/>
                </tr>
                </thead>
                <tbody>
                <tr v-for="customer in customers.data" :key="customer.data.id">
                    <td>{{ customer.data.id }}</td>
                    <td class="text-truncate" style="max-width: 0">
                        <div>{{ customer.data.full_name }}</div>
                        <div class="d-md-none">{{ customer.data.phone_number}}</div>
                        <div class="d-md-none">
                            <i v-if="customer.data.card_number" class="fa-solid fa-credit-card text-secondary me-2"></i>
                            {{ customer.data.card_number}}
                        </div>
                    </td>
                    <td class="d-none d-md-table-cell">{{ customer.data.phone_number }}</td>
                    <td class="d-none d-md-table-cell">{{ customer.data.card_number || '-' }}</td>
                    <td class="d-none d-md-table-cell"><span class="badge text-bg-success">active</span></td>
                    <td class="text-nowrap">
                        <Link :href="customer.data.edit_url" class="me-2">
                            <i class="fa-solid fa-pen-to-square text-secondary"></i>
                        </Link>
                        <Link :href="customer.data.url">
                            <i class="fa-solid fa-eye text-secondary"></i>
                        </Link>
                    </td>
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
