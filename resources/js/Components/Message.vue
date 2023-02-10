<template>
    <div v-bind="$attrs" role="alert" :title="message.text">
        {{ message.text }}
    </div>
</template>

<script setup>
const props = defineProps([
    'message',
])
</script>
