<template>
    <header>
        <navbar/>
    </header>
    <main style="padding-top: 56px">
        <message
            class="container mt-3 alert alert-success"
            v-if="$page.props.message"
            :message="$page.props.message"
        ></message>
        <div class="container shadow shadow-sm p-2 p-md-3 p-xl-4 mt-md-3 bg-white">
            <slot/>
        </div>
    </main>
</template>

<script setup>
import Navbar from "@/Components/Navbar.vue";
import Message from '@/Components/Message.vue';
</script>
