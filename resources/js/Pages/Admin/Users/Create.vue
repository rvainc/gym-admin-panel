<template>
    <authenticated-layout>
        <div class="h5 mb-4">Створити користувача</div>
        <UserForm
            :url="route('admin.users.store')"
            :model="user"
            :is-edit-mode="true"
            :role-options="roleOptions"
        ></UserForm>
    </authenticated-layout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/Admin/AuthenticatedLayout.vue';
import UserForm from "@/Pages/Admin/Users/Parts/UserForm.vue";

const props = defineProps([
    'roleOptions',
    'user',
]);
</script>
