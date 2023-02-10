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
        <message
            class="container mt-3 alert alert-danger text-truncate"
            v-if="!_.isEmpty($page.props.errors)"
            :message="{ text: 'Error! ' + _.join(_.values($page.props.errors), ' ')}"
        ></message>
        <div class="container shadow shadow-sm py-2 p-lg-4 mt-md-3 bg-white">
            <slot/>
        </div>
    </main>
</template>

<script setup>
import Navbar from "@/Components/Navbar.vue";
import Message from '@/Components/Message.vue';
import {Head} from "@inertiajs/inertia-vue3";
import _ from "lodash"

const props = defineProps({
    title: {
        type: String,
        default: 'Universal Sports Academy',
    }
});
</script>
