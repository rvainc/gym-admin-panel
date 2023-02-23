<template>
    <authenticated-layout title="Користувач">
        <div class="d-flex align-auto align-items-center">
            <div class="h4 me-auto">Користувач</div>
        </div>
        <div class="row w-100 mt-3">
            <div class="col-12 col-md-6">
                <table class="w-100">
                    <tr>
                        <td>
                            <div class="h6">Користувач:</div>
                        </td>
                        <td class="text-end text-md-start">
                            {{ user.data.name || '-' }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="h6">Електронна пошта:</div>
                        </td>
                        <td class="text-end text-md-start">
                            {{ user.data.email || '-' }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="h6">Роль:</div>
                        </td>
                        <td class="text-end text-md-start">
                            <div class="text-truncate">
                                {{ user.data.role_text || '-' }}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="h6">Верефікація пройдена:</div>
                        </td>
                        <td class="text-end text-md-start">
                            {{ formatDate(user.data.email_verified_at) || '-' }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="h6">Користувач створений:</div>
                        </td>
                        <td class="text-end text-md-start">
                            <div>
                                {{ formatDate(user.data.created_at) || '-' }}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="h6">Користувач оновлений:</div>
                        </td>
                        <td class="text-end text-md-start">
                            <div>
                                {{ formatDate(user.data.updated_at) || '-' }}
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-12 col-md-6 mt-2 mt-sm-0 text-md-end text-start">
                <div class="btn-group" role="group">
                    <Link
                        :href="user.links.edit_url"
                        class="btn btn-secondary"
                        :class="{ disabled: !user.meta.can.update }"
                    >
                        <i class="fa-solid fa-pen-to-square"></i>
                    </Link>
                    <button
                        @click="$inertia.delete(user.links.delete_url)"
                        class="btn btn-danger"
                        :class="{ disabled: !user.meta.can.delete }"
                    >
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    </authenticated-layout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/Admin/AuthenticatedLayout.vue';
import {Link} from "@inertiajs/inertia-vue3";
import {formatDate} from "@/Support/helpers";

const props = defineProps([
    'user',
]);
</script>
