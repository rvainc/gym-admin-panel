<script setup>
import Navbar from "@/Components/Navbar.vue";
</script>

<template>
    <header class="mb-3">
        <navbar/>
    </header>
    <main class="container" style="margin-top: 70px">
        <slot/>
    </main>
</template>
