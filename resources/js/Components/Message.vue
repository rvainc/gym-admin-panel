<template>
    <div v-bind="$attrs" role="alert">
        {{ message.text }}
    </div>
</template>

<script setup>
console.log(props)
const props = defineProps([
    'message',
])
</script>
