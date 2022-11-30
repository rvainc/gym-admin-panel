<template>
    <authenticated-layout>
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
            <table class="table table-hover mt-3 w-100">
                <thead>
                <tr>
                    <th scope="col" style="width: 1%">#</th>
                    <th scope="col">Назва</th>
                    <th scope="col" class="d-none d-md-table-cell" style="width: 20%">Тривалість</th>
                    <th scope="col" class="d-none d-md-table-cell" style="width: 20%">Ціна</th>
                    <th scope="col" style="width: 1%">Дії</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="subscription in subscriptions.data" :key="subscription.data.id">
                    <td>{{ subscription.data.id }}</td>
                    <td class="text-truncate" style="max-width: 0">
                        <div>{{ subscription.data.title }}</div>
                        <div class="d-md-none">{{ subscription.data.days }} днів</div>
                        <div class="d-md-none">{{ subscription.data.display_price }} грн</div>
                    </td>
                    <td class="d-none d-md-table-cell">{{ subscription.data.days }} днів</td>
                    <td class="d-none d-md-table-cell">{{ subscription.data.display_price }} грн</td>
                    <td class="text-nowrap text-end">
                        <i
                            v-if="subscription.data.deleted_at"
                            @click="$inertia.post(subscription.data.links.restore_url)"
                            class="fa-solid fa-reply link-secondary"
                            type="button"
                        ></i>
                        <span v-else>
                            <Link :href="subscription.data.links.edit_url" class="me-2 link-secondary">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </Link>
                            <span @click="$inertia.delete(subscription.data.links.delete_url)" type="button">
                                <i class="fa-solid fa-trash-can link-danger link-secondary"></i>
                            </span>
                        </span>
                    </td>
                </tr>
                </tbody>
            </table>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li
                        v-for="item in subscriptions.meta.links"
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
            <Link :href="route('admin.subscriptions.create')">
                Додати Підписку.
            </Link>
        </div>
    </authenticated-layout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/Admin/AuthenticatedLayout.vue';
import {Link, usePage} from "@inertiajs/inertia-vue3";
import {computed, ref} from "vue";
import {Inertia} from "@inertiajs/inertia";

const props = defineProps([
    'subscriptions',
    'showDeleted'
]);

function toggleShowDeleted() {
    Inertia.get(usePage().url.value, {
        show_deleted: props.showDeleted ? '0' : '1',
    });
}
</script>
