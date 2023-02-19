<template>
    <authenticated-layout>
        <div class="h5 mb-4">Редагувати користувача</div>
        <UserForm
            :url="route('admin.users.update', {user: user.data.id})"
            :model="user"
            :is-edit-mode="true"
            method="PUT"
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
