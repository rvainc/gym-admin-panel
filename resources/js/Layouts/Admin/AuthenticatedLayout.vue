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
        <div style="min-height: 1vh">
            <div class="container shadow shadow-sm py-2 p-lg-4 mt-md-3 bg-white h-100">
                <slot/>
            </div>
            <footer class="text-center text-secondary container my-5" style="font-size: 12px;">
                ©Universal Sports Academy is an instrument for gyms and other corporations. You can use this in yours own
                corporation.
                Tutorials, references, and examples are constantly reviewed to avoid errors, but we
                cannot warrant full correctness of all content. While using Universal Sports Academy, you agree to have read
                and accepted
                our terms of use, cookie and privacy policy.<br><br>

                Copyright 2022-{{ moment().locale('uk').get('year') }} by Refsnes Data. All Rights Reserved.<br>
                Universal Sports Academy is Powered by USA.CSS.
            </footer>
        </div>
    </main>
</template>

<script setup>
import Navbar from "@/Components/Navbar.vue";
import Message from '@/Components/Message.vue';
import {Head} from "@inertiajs/inertia-vue3";
import _ from "lodash"
import moment from "moment/moment";

const props = defineProps({
    title: {
        type: String,
        default: 'Universal Sports Academy',
    }
});
</script>
