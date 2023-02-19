<template>
    <header>
        <Head>
            <title>{{ title }}</title>
        </Head>
    </header>
    <main>
        <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh">
            <div class="shadow shadow-sm p-3 p-lg-4 bg-white w-100" style="max-width: 28rem">
                <div class="h5 mb-4">{{ title }}</div>
                <slot/>
            </div>
        </div>
    </main>
</template>

<script setup>
import Head from "@inertiajs/inertia-vue3/src/head";

const props = defineProps({
    title: {
        type: String,
        default: 'Universal Sports Academy',
    }
});
</script>
