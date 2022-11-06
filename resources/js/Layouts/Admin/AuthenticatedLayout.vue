<script setup>
import Navbar from "@/Components/Navbar.vue";
</script>

<template>
    <header class="mb-3">
        <navbar/>
    </header>
    <main class="container">
        <slot/>
    </main>
</template>
