<script setup>
import Navbar from "@/Components/Navbar.vue";
</script>

<template>
    <header class="mb-3">
        <navbar/>
    </header>
    <main class="container shadow shadow-sm" style="margin-top: 70px; background-color: #ffffff; padding: 30px; border-radius: 10px; hid">
        <slot/>
    </main>
</template>
