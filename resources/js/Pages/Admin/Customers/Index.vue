<template>
    <authenticated-layout>
        <div class="mb-5">
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
                    v-model="showDeleted"
                    class="form-check-input" type="checkbox" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Показувати видалених
                </label>
            </div>
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
                    <th scope="col" style="width: 1%">Дії</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="customer in customers.data" :key="customer.data.id">
                    <td>{{ customer.data.id }}</td>
                    <td class="text-truncate" style="max-width: 0">
                        <div>{{ customer.data.full_name }}</div>
                        <div class="d-md-none">{{ customer.data.phone_number }}</div>
                        <div class="d-md-none">
                            <i v-if="customer.data.card_number" class="fa-solid fa-credit-card text-secondary me-2"></i>
                            {{ customer.data.card_number }}
                        </div>
                    </td>
                    <td class="d-none d-md-table-cell">{{ customer.data.phone_number }}</td>
                    <td class="d-none d-md-table-cell">{{ customer.data.card_number || '-' }}</td>
                    <td class="d-none d-md-table-cell">
                        <span class="badge text-bg-success" v-if="!customer.data.deleted_at">active</span>
                    </td>
                    <td class="text-nowrap text-end">
                        <i
                            v-if="customer.data.deleted_at"
                            @click="$inertia.post(customer.links.restore_url)"
                            class="fa-solid fa-reply link-secondary"
                            type="button"
                        ></i>
                        <span v-else>
                            <Link :href="customer.links.edit_url" class="me-2 link-secondary">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </Link>
                            <Link :href="customer.links.url" class="link-secondary">
                                <i class="fa-solid fa-eye"></i>
                            </Link>
                        </span>
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
        <div class="text-center h5 p-5" v-else>
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
import {computed, ref} from "vue";
import {Inertia} from "@inertiajs/inertia";

const showDeletedRef = ref(Boolean(Number(props.show_deleted)));

const showDeleted = computed({
    get() {
        return showDeletedRef.value;
    },
    set(value) {
        showDeletedRef.value = Number(value);
        Inertia.get(usePage().url.value, {
            show_deleted: showDeletedRef.value,
        });
    }
});

const props = defineProps([
    'customers',
    'labels',
    'show_deleted',
    'message',
]);
</script>
