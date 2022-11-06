<script setup>
defineProps(['message']);
</script>

<template>
    <div v-show="message">
        <p class="text-danger">
            <small>{{ message }}</small>
        </p>
    </div>
</template>
