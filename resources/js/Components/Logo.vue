<template>
    <Link :href="route('admin.index')">
        <img src="../../images/usa-logo.png" style="object-fit: contain; height: 75px" alt="logo">
    </Link>
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

<style scoped>

</style>
