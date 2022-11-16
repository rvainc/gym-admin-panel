<script setup>
import Navbar from "@/Components/Navbar.vue";
</script>

<template>
    <header>
        <navbar/>
    </header>
    <main style="padding-top: 56px">
        <div class="container shadow shadow-sm p-2 p-md-3 p-xl-4 mt-md-3 bg-white">
            <slot/>
        </div>
    </main>
</template>
