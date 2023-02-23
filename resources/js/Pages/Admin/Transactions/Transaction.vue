<template>
    <authenticated-layout title="Транзакція">
        <div class="d-flex align-auto align-items-center">
            <div class="h4 me-auto">Транзакція #{{transaction.data.id}}</div>
        </div>
        <div class="row w-100 mt-3">
            <div class="col-12 col-md-6">
                <table class="w-100">
                    <tr>
                        <td>
                            <div class="h6">Клієнт:</div>
                        </td>
                        <td class="text-end text-md-start">
                            <div>
                                {{ transaction.data.customer.data.full_name || '-' }}
                                <Link
                                    v-if="!transaction.data.customer.data.deleted_at"
                                    :href="transaction.data.customer.links.show_url"
                                >
                                    <i class="fa-solid fa-link"></i>
                                </Link>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="h6">Номер картки:</div>
                        </td>
                        <td class="text-end text-md-start">
                            <div>
                                {{ transaction.data.customer.data.card_number || '-' }}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="h6">Сума:</div>
                        </td>
                        <td class="text-end text-md-start">
                            <div class="text-truncate">
                                {{ transaction.data.display_amount.toFixed(2) + ' грн' || '-' }}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="h6">Дата початку:</div>
                        </td>
                        <td class="text-end text-md-start">
                            <div>
                                {{ formatDate(transaction.data.start_at.datetime) || '-' }}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="h6">Дата кінця:</div>
                        </td>
                        <td class="text-end text-md-start">
                            <div>
                                {{ formatDate(transaction.data.ends_at.datetime) || '-' }}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="h6 w-75">Дата проведення транзакції:</div>
                        </td>
                        <td class="text-end text-md-start">
                            <div>
                                {{ formatDate(transaction.data.created_at.datetime) || '-' }}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="h6">Тривалість:</div>
                        </td>
                        <td class="text-end text-md-start">
                            <div>
                                {{ transaction.data.days || '-' }}
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-12 col-md-6">
                <div class="h5 pb-2 border-bottom d-none d-md-block">Данні про підписку</div>
                <table v-if="transaction.data.subscription" class="w-100">
                    <tr>
                        <td>
                            <div class="h6 text-truncate w-100">Назва підписки:</div>
                        </td>
                        <td class="text-end text-md-start">
                            <div>
                                {{ transaction.data.subscription.data.title || '-' }}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="h6 w-75">Кількість днів в підписці зараз:</div>
                        </td>
                        <td class="text-end text-md-start">
                            <div>
                                {{ transaction.data.subscription.data.days + ' д.' || '-' }}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="h6 text-truncate w-100">Ціна підписки зараз:</div>
                        </td>
                        <td class="text-end text-md-start">
                            <div>
                                {{ transaction.data.subscription.data.display_price.toFixed(2) + ' грн' || '-' }}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="h6 text-truncate w-100">Стан підписки:</div>
                        </td>
                        <td class="text-end text-md-start">
                            <span
                                v-if="!transaction.data.subscription.data.deleted_at"
                                class="badge bg-success"
                            >існує</span>
                            <span v-else class="badge bg-danger">видалено</span>
                        </td>
                    </tr>
                </table>
                <div v-if="!transaction.data.subscription" class="h6 d-none d-md-block">Жодної підписки не застосовано в цій транзакції.</div>
            </div>
        </div>
    </authenticated-layout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/Admin/AuthenticatedLayout.vue';
import {Link} from "@inertiajs/inertia-vue3";
import {formatDate} from "@/Support/helpers";

const props = defineProps([
    'transaction',
]);
</script>
