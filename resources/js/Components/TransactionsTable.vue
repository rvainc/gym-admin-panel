<template>
    <table class="table table-hover w-100 align-middle">
        <thead>
        <tr>
            <th scope="col" style="width: 1%">#</th>
            <th scope="col" class="d-none d-md-table-cell">Клієнт</th>
            <th scope="col" class="d-none d-md-table-cell">Дата</th>
            <th scope="col" class="d-none d-md-table-cell" style="width: 20%">Тривалість</th>
            <th scope="col" class="d-none d-md-table-cell" style="width: 15%">Сума</th>
            <th scope="col" class="d-table-cell d-md-none">Данні</th>
            <th scope="col" class="text-center" style="width: 15%">Статус</th>
            <th scope="col" style="width: 1%">Дії</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="transaction in transactions.data" :key="transaction.data.id">
            <td>{{ transaction.data.id }}</td>
            <td class="d-md-none" style="max-width: 0">
                <div>{{ transaction.data.customer.data.full_name }}</div>
                <div>Від: {{ formatDate(transaction.data.start_at.datetime) }}</div>
                <div>До: {{ formatDate(transaction.data.ends_at.datetime) }}</div>
            </td>
            <td class="d-none d-md-table-cell">{{ transaction.data.customer.data.full_name }}</td>
            <td class="d-none d-md-table-cell">
                {{
                    formatDate(transaction.data.start_at.datetime)
                    + ' - ' +
                    formatDate(transaction.data.ends_at.datetime)
                }}
            </td>
            <td class="d-none d-md-table-cell">{{ transaction.data.days }}</td>
            <td class="d-none d-md-table-cell">{{ transaction.data.display_amount.toFixed(2) }} грн</td>
            <td class="text-center">
                <i v-if="transaction.data.status" class="fa-solid fa-check check"></i>
                <i v-else class="fa-solid fa-xmark xmark"></i>
            </td>
            <td class="text-nowrap text-end">
                <span class="btn-group btn-group-sm">
                    <Link :href="transaction.links.show_url" class="btn btn-secondary">
                        <i class="fa-solid fa-eye"></i>
                    </Link>
                </span>
            </td>
        </tr>
        </tbody>
    </table>
</template>

<script setup>
import {Link} from "@inertiajs/inertia-vue3";
import {formatDate} from '@/Support/helpers';

const props = defineProps([
    'transactions',
]);
</script>

<style scoped>
.xmark {
    transition: 0.7s;
}
.check {
    transition: 0.7s;
}

tr:hover .xmark {
    transition: 0.2s;
    color: #c40000;
}

tr:hover .check {
    transition: 0.2s;
    color: #0ea10e;
}
</style>
