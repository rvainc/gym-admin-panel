<template>
    <AuthenticatedLayout title="Користувачі">
        <div class="d-flex align-auto align-items-center">
            <div class="h4 me-auto">Користувачі</div>
            <div>
                <Link
                    :href="route('admin.users.create')"
                    class="btn btn-secondary"
                    :class="{ disabled: !can.create }"
                >
                    <i class="fa-sharp fa-solid fa-plus"></i>
                </Link>
            </div>
        </div>
        <div v-if="users.data.length">
            <table class="table table-hover mt-3 w-100 align-middle">
                <thead>
                <tr>
                    <th scope="col" style="width: 1%">#</th>
                    <th scope="col">Користувач</th>
                    <th scope="col" class="d-none d-md-table-cell">Електронна пошта</th>
                    <th scope="col" class="d-none d-md-table-cell">Роль</th>
                    <th scope="col"  style="width: 1%">Дії</th>
                </tr>
                </thead>
                <tbody>
                <tr class="table-rov" v-for="user in users.data" :key="user.data.id">
                    <td>{{ user.data.id }}</td>
                    <td style="max-width: 0">
                        <div class="text-truncate">
                            <i class="fa-solid fa-user d-md-none"></i>
                            {{ user.data.name || '-' }}
                        </div>
                        <div class="text-truncate d-md-none">
                            <i class="fa-solid fa-envelope"></i>
                            {{ user.data.email || '-' }}
                        </div>
                    </td>
                    <td class="d-none d-md-table-cell">{{ user.data.email || '-' }}</td>
                    <td class="d-none d-md-table-cell">{{ user.data.role_text || '-' }}</td>
                    <td>
                        <span class="btn-group btn-group-sm">
                            <Link
                                :href="user.links.edit_url"
                                class="btn btn-secondary"
                                :class="{ disabled: !user.meta.can.update }
                            ">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </Link>
                            <Link
                                :href="user.links.show_url"
                                class="btn btn-secondary"
                                :class="{ disabled: !user.meta.can.view }"
                            >
                                <i class="fa-solid fa-eye"></i>
                            </Link>
                            <button
                                class="btn btn-danger"
                                @click="$inertia.delete(user.links.delete_url)"
                                :class="{ disabled: !user.meta.can.delete }"
                            >
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </span>
                    </td>
                </tr>
                </tbody>
            </table>
            <pagination :model="users"/>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/Admin/AuthenticatedLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import {Link} from "@inertiajs/inertia-vue3";

const props = defineProps([
    'users',
    'can',
])
</script>
