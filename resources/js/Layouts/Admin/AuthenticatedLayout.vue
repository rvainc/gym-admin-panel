<template>
    <header>
        <navbar/>
        <Head>
            <title>{{ title }}</title>
        </Head>
    </header>
    <main style="padding-top: 56px">
        <message
            class="container mt-3 alert alert-success text-truncate"
            v-if="$page.props.message"
            :message="$page.props.message"
        ></message>
        <div style="min-height: 1vh">
            <div class="container shadow shadow-sm py-2 p-lg-4 mt-md-3 bg-white h-100">
                <slot/>
            </div>
            <Footer/>
        </div>
    </main>
</template>

<script setup>
import Navbar from "@/Components/Navbar.vue";
import Message from '@/Components/Message.vue';
import {Head} from "@inertiajs/inertia-vue3";
import Footer from "@/Components/Footer.vue";

const props = defineProps({
    title: {
        type: String,
        default: 'Universal Sports Academy',
    }
});
</script>
