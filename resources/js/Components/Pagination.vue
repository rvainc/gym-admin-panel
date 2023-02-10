<template>
    <div class="d-flex justify-content-center">
        <span
            v-for="item in links"
            class="m-2"
        >
            <Link
                v-if="!_.isEmpty(item.url)"
                class="link-primary text-decoration-none"
                :class="{'text-decoration-underline': item.active}"
                :href="item.url"
                style="font-weight: bold"
                v-html="item.label"
            />
            <span v-else class="text-secondary" style="font-weight: bold" v-html="item.label"/>
        </span>
    </div>
</template>

<script setup>
import {Link} from "@inertiajs/inertia-vue3";
import _ from "lodash";

const props = defineProps([
    'links',
]);
</script>
