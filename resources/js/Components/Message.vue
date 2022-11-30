<template>
    <div v-bind="$attrs" role="alert">
        {{ message.text }}
    </div>
</template>

<script setup>
const props = defineProps([
    'message',
])
</script>
