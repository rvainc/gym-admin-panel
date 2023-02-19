<template>
    <div v-bind="$attrs">
        <div class="d-flex">
            <div class="input-group">
                <input
                    v-model="searchInput"
                    type="text"
                    class="form-control"
                    placeholder="Пошук"
                    aria-label="Search"
                    @keydown.enter="search"
                >
                <button id="button-addon2" class="btn btn-secondary" type="button" @click="showBarCodeReader = true">
                    <i class="fa-solid fa-barcode"></i>
                </button>
                <button class="btn btn-secondary" type="button" @click="search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
        </div>
        <bar-code-reader-modal
            :show="showBarCodeReader"
            @closed="showBarCodeReader = false"
            @decode="onDecode"
        />
    </div>
</template>

<script setup>
import BarCodeReaderModal from "@/Components/ModalWindows/BarCodeReaderModal.vue";
import {ref} from "vue";
import { Inertia } from '@inertiajs/inertia'
import _ from "lodash";

const searchInput = ref('');
const showBarCodeReader = ref(false);

function search() {
    if (!_.isEmpty(searchInput.value)) {
        Inertia.visit(props.href, {
            method: props.method,
            data: { search: searchInput.value, page: 1 },
        });
    }
}

function onDecode(result) {
    showBarCodeReader.value = false;
    searchInput.value = result.text;
}

const props = defineProps([
   'href',
   'method',
]);
</script>
