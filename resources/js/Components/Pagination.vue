<template>
    <div class="justify-content-center d-none d-lg-flex">
        <span
            v-for="item in model.meta.links"
            class="m-2"
        >
            <Link
                class="link-primary text-decoration-none"
                :class="{
                    'text-decoration-underline': item.active,
                    'link-disabled': _.isEmpty(item.url),
                }"
                :href="item.url"
                style="font-weight: bold"
            >
                <v-html :html="item.label"/>
            </Link>
        </span>
    </div>
    <div class="justify-content-between d-flex d-lg-none align-items-center mx-5">
        <div>
            <Link
                class="link-primary text-decoration-none me-1"
                :href="model.links.first"
            >
                <button class="btn btn-outline-primary btn-sm" style="width: 32px">
                    <i class="fa-solid fa-angles-left"></i>
                </button>
            </Link>
            <Link
                class="link-primary text-decoration-none"
                :href="model.links.prev"
            >
                <button class="btn btn-outline-primary btn-sm" style="width: 32px">
                    <i class="fa-solid fa-angle-left"></i>
                </button>
            </Link>
        </div>
        <div style="font-weight: bold">{{ model.meta.current_page }} з {{ model.meta.last_page }}</div>
        <div>
            <Link
                class="link-primary text-decoration-none me-1"
                :href="model.links.next"
            >
                <button class="btn btn-outline-primary btn-sm" style="width: 32px">
                    <i class="fa-solid fa-angle-right"></i>
                </button>
            </Link>
            <Link
                class="link-primary text-decoration-none"
                :href="model.links.last"
            >
                <button class="btn btn-outline-primary btn-sm" style="width: 32px">
                    <i class="fa-solid fa-angles-right"></i>
                </button>
            </Link>
        </div>
    </div>
</template>

<script setup>
import _ from "lodash";
import VHtml from "@/Components/VHtml.vue";
import {Link} from "@inertiajs/inertia-vue3";

const props = defineProps([
    'model',
]);
</script>
