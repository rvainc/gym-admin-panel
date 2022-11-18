<template>
    <div v-bind="$attrs">
        <div class="d-flex">
            <div class="input-group">
                <input
                    @keydown.enter="search"
                    v-model="searchInput"
                    type="text"
                    class="form-control"
                    placeholder="Пошук"
                    aria-label="Search"
                >
                <button @click="showBarCodeReader = true" class="btn btn-secondary" type="button"
                        id="button-addon2">
                    <i class="fa-solid fa-barcode"></i>
                </button>
                <button @click="search" class="btn btn-secondary" type="button">
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
            data: { search: searchInput.value },
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
