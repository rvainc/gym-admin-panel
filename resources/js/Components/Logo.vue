<template>
    <img src="../../../public/usa-logo.jpg" style="object-fit: contain;" v-bind="$attrs" alt="logo">
</template>

<script>
import {Link} from "@inertiajs/inertia-vue3";

export default {
    name: "Logo",
    components: {
        Link,
    }
}
</script>
