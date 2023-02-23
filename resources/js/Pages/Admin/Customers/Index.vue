<template>
    <authenticated-layout title="Клієнти">
        <div class="mb-3 mb-md-5">
            <search-bar
                :href="$page.url"
                method="get"
                class="mb-2"
            ></search-bar>
            <div v-if="labels.length">
                <Link v-for="label in labels" :href="label.url">
                    <span class="badge bg-secondary">
                        {{ label.title }}
                        <i class="ms-1 fa-solid fa-circle-xmark"></i>
                    </span>
                </Link>
            </div>
            <div class="form-check mt-4">
                <input
                    id="flexCheckDefault"
                    :checked="showDeleted"
                    class="form-check-input"
                    type="checkbox"
                    @click="toggleShowDeleted"
                >
                <label class="form-check-label" for="flexCheckDefault">
                    Показувати видалених
                </label>
            </div>
        </div>
        <div class="d-flex align-auto align-items-center">
            <div class="h4 me-auto">Клієнти</div>
            <div>
                <Link :href="route('admin.customers.create')" class="btn btn-secondary">
                    <i class="fa-sharp fa-solid fa-plus"></i>
                </Link>
            </div>
        </div>
        <div v-if="customers.data.length">
            <table class="table table-hover mt-3 w-100 align-middle">
                <thead>
                    <tr>
                        <th scope="col" style="width: 1%">#</th>
                        <th scope="col">
                            <div>Клієнт</div>
                        </th>
                        <th scope="col" class="d-none d-md-table-cell" style="width: 20%">Телефон</th>
                        <th scope="col" class="d-none d-md-table-cell" style="width: 20%">Номер картки</th>
                        <th scope="col" class="d-none d-md-table-cell text-center" style="width: 20%">Проплачено</th>
                        <th scope="col" style="width: 1%">Дії</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="table-rov" v-for="customer in customers.data" :key="customer.data.id">
                        <td>{{ customer.data.id }}</td>
                        <td style="max-width: 0">
                            <div class="d-flex align-items-center">
                                <i
                                    class="fa-solid fa-circle fa-2xs d-md-none me-2"
                                    :class="{
                                    'text-success': customer.data.active_transactions_exists,
                                    'text-danger': !customer.data.active_transactions_exists,
                                }"
                                ></i>
                                <div class="text-truncate">{{ customer.data.full_name }}</div>
                            </div>
                            <div class="d-md-none d-flex align-items-center">
                                <i class="fa-solid fa-phone me-2 text-secondary"></i>
                                <div class="w-100 text-truncate">{{ customer.data.phone_number }}</div>
                            </div>
                            <div class="d-md-none d-flex align-items-center">
                                <i
                                    v-if="customer.data.card_number"
                                    class="fa-solid fa-credit-card text-secondary me-2"
                                ></i>
                                <div class="w-100 text-truncate">{{ customer.data.card_number }}</div>
                            </div>
                        </td>
                        <td class="d-none d-md-table-cell">{{ customer.data.phone_number }}</td>
                        <td class="d-none d-md-table-cell">{{ customer.data.card_number || '-' }}</td>
                        <td class="d-none d-md-table-cell text-center">
                            <i v-if="customer.data.active_transactions_exists" class="fa-solid fa-check check"></i>
                            <i v-else class="fa-solid fa-xmark xmark"></i>
                        </td>
                        <td class="text-nowrap text-end">
                            <div v-if="customer.data.deleted_at" class="btn-group btn-group-sm">
                                <button class="btn btn-secondary" @click="$inertia.post(customer.links.restore_url)">
                                    <i class="fa-solid fa-reply"></i>
                                </button>
                            </div>
                            <span v-else>
                                <span class="btn-group btn-group-sm">
                                    <Link :href="customer.links.edit_url" class="btn btn-secondary">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </Link>
                                    <Link :href="customer.links.show_url" class="btn btn-secondary">
                                       <i class="fa-solid fa-eye"></i>
                                    </Link>
                                    <button
                                        class="btn btn-danger"
                                        @click="$inertia.delete(customer.links.delete_url)"
                                    >
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </span>
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
            <pagination :model="customers"/>
        </div>
        <div v-else class="text-center h5 p-5">
            Жодного запису не знайдено.
            <Link :href="route('admin.customers.create')">
                Додати Клієнта.
            </Link>
        </div>
    </authenticated-layout>
</template>

<script setup>
import {Link, usePage} from "@inertiajs/inertia-vue3";
import AuthenticatedLayout from '@/Layouts/Admin/AuthenticatedLayout.vue';
import SearchBar from '@/Components/SearchBar.vue';
import {Inertia} from "@inertiajs/inertia";
import Pagination from "@/Components/Pagination.vue";

function toggleShowDeleted() {
    Inertia.get(usePage().url.value, {
        show_deleted: props.showDeleted ? '0' : '1',
    });
}

const props = defineProps([
    'customers',
    'labels',
    'showDeleted',
    'message',
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
