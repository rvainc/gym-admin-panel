<template>
    <authenticated-layout>
        <div class="row">
            <div class="col-12 col-md-6">
                <table style="width: 100%">
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
                            <div class="h6 text-truncate">Номер картки:</div>
                        </td>
                        <td>{{ customer.data.card_number || '-' }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-12 col-md-6 d-flex mt-2 mt-sm-0 justify-content-md-end">
                <Link :href="customer.data.edit_url" class="me-2">
                    <button class="btn btn-secondary" style="width: 40px; height: 40px">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                </Link>
                <button
                    @click="$inertia.delete(customer.data.delete_url)"
                    class="btn btn-danger"
                    style="width: 40px; height: 40px"
                >
                    <i class="fa-solid fa-trash me-2"></i>
                </button>
            </div>
        </div>
    </authenticated-layout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/Admin/AuthenticatedLayout.vue';
import {Link} from "@inertiajs/inertia-vue3";

const props = defineProps([
    'customer',
]);
</script>
