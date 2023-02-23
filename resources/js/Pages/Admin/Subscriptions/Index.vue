<template>
    <authenticated-layout title="Підписки">
        <div class="d-flex align-auto align-items-center">
            <div class="h4 m-0 me-auto">Підписки</div>
            <div>
                <Link :href="route('admin.subscriptions.create')" class="btn btn-secondary">
                    <i class="fa-sharp fa-solid fa-plus"></i>
                </Link>
            </div>
        </div>
        <div class="form-check mt-2 mb-2">
            <input
                :checked="showDeleted"
                @click="toggleShowDeleted"
                class="form-check-input"
                type="checkbox"
                id="flexCheckDefault"
            >
            <label class="form-check-label" for="flexCheckDefault">
                Показувати видалених
            </label>
        </div>
        <div v-if="subscriptions.data.length">
            <table class="table table-hover mt-3 w-100 align-middle">
                <thead>
                <tr>
                    <th scope="col" style="width: 1%">#</th>
                    <th scope="col">Назва</th>
                    <th scope="col" class="d-none d-md-table-cell">Тривалість</th>
                    <th scope="col" class="d-none d-md-table-cell">Ціна</th>
                    <th scope="col" style="width: 1%">Дії</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="subscription in subscriptions.data" :key="subscription.data.id">
                    <td>{{ subscription.data.id }}</td>
                    <td class="text-truncate" style="max-width: 0">
                        <div>{{ subscription.data.title }}</div>
                        <div class="d-md-none">{{ subscription.data.days }} днів</div>
                        <div class="d-md-none">{{ subscription.data.display_price.toFixed(2) }} грн</div>
                    </td>
                    <td class="d-none d-md-table-cell">{{ subscription.data.days }} днів</td>
                    <td class="d-none d-md-table-cell">{{ subscription.data.display_price.toFixed(2) }} грн</td>
                    <td class="text-nowrap text-end">
                        <div class="btn-group btn-group-sm" v-if="subscription.data.deleted_at">
                            <button class="btn btn-secondary" @click="$inertia.post(subscription.links.restore_url)">
                                <i class="fa-solid fa-reply"></i>
                            </button>
                        </div>
                        <span v-else>
                            <span class="btn-group btn-group-sm">
                                <Link :href="subscription.links.edit_url" class="btn btn-secondary">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </Link>
                                <button
                                    @click="$inertia.delete(subscription.links.delete_url)"
                                    class="btn btn-danger"
                                >
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </span>
                        </span>
                    </td>
                </tr>
                </tbody>
            </table>
            <pagination :model="subscriptions"/>
        </div>
        <div class="text-center h5 p-5" v-else>
            Жодного запису не знайдено.
            <Link :href="route('admin.subscriptions.create')">
                Додати Підписку.
            </Link>
        </div>
    </authenticated-layout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/Admin/AuthenticatedLayout.vue';
import {Link, usePage} from "@inertiajs/inertia-vue3";
import {Inertia} from "@inertiajs/inertia";
import Pagination from "@/Components/Pagination.vue";

function toggleShowDeleted() {
    Inertia.get(usePage().url.value, {
        show_deleted: props.showDeleted ? '0' : '1',
    });
}

const props = defineProps([
    'subscriptions',
    'showDeleted'
]);
</script>
