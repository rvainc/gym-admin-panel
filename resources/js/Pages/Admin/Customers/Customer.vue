<template>
    <authenticated-layout :title=" 'Клієнт - ' + customer.data.full_name ">
        <div class="d-flex align-auto align-items-center">
            <div class="h4 me-auto">{{customer.data.full_name}}</div>
        </div>
        <div class="row w-100 mt-3">
            <div class="col-12 col-md-6">
                <table class="w-100">
                    <tr>
                        <th style="width: 30%"></th>
                        <th style=""></th>
                    </tr>
                    <tr>
                        <td>
                            <div class="h6">Ім'я:</div>
                        </td>
                        <td>{{ customer.data.first_name || '-' }}</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="h6">Прізвище:</div>
                        </td>
                        <td>{{ customer.data.last_name || '-' }}</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="h6">Номер телефона:</div>
                        </td>
                        <td>{{ customer.data.phone_number || '-' }}</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="h6">Номер картки:</div>
                        </td>
                        <td>
                            <div class="text-truncate">{{ customer.data.card_number || '-' }}</div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="h6">Статус:</div>
                        </td>
                        <td>
                            <span
                                class="badge text-bg-primary"
                                v-if="customer.data.active_transactions_exists"
                            >
                                Проплачено
                            </span>
                            <span class="badge text-bg-secondary" v-else>Не проплачено</span>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-12 col-md-6 mt-2 mt-sm-0 text-md-end text-sm-center">
                <div class="btn-group" role="group">
                    <Link :href="customer.links.edit_url" class="btn btn-secondary">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </Link>
                    <button
                        @click="$inertia.delete(customer.links.delete_url)"
                        class="btn btn-danger"
                    >
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="p-md-2 mt-4">
            <div class="d-flex align-auto align-items-center">
                <div class="h5 me-auto">Історія транзакцій цього клієнту</div>
                <div class="me-1 ms-1 ms-md-0">
                    <Link :href="route('admin.transactions.create', {customer: customer.data.id})" class="btn btn-secondary">
                        <i class="fa-solid fa-credit-card"></i>
                    </Link>
                </div>
            </div>
            <div v-if="transactions.data.length">
                <transactions-table :transactions="transactions"/>
                <pagination :links="transactions.meta.links"/>
            </div>
            <div v-else class="text-center h6 p-3">
                Жодного запису в цього клієнта не знайдено.
            </div>
        </div>
    </authenticated-layout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/Admin/AuthenticatedLayout.vue';
import {Link} from "@inertiajs/inertia-vue3";
import TransactionsTable from "@/Components/TransactionsTable.vue";
import Pagination from "@/Components/Pagination.vue";

const props = defineProps([
    'customer',
    'transactions',
]);
</script>
