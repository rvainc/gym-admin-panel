<template>
    <authenticated-layout>
        <div class="d-flex align-auto align-items-center">
            <div class="h4 me-auto">Історія транзакцій</div>
        </div>
        <div v-if="transactions.data.length" class="mt-3">
            <transactions-table :transactions="transactions"/>
            <pagination :links="transactions.meta.links"/>
        </div>
        <div v-else class="text-center h5 p-5">
            Жодного запису не знайдено.
        </div>
    </authenticated-layout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/Admin/AuthenticatedLayout.vue";
import TransactionsTable from "@/Components/TransactionsTable.vue";
import Pagination from "@/Components/Pagination.vue";

const props = defineProps([
    'transactions',
]);
</script>
