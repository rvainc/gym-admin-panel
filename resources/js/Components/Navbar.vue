<template>
    <nav class="navbar navbar-dark navbar-expand-lg bg-primary shadow shadow-lg fixed-top"
         style="opacity: 96%">
        <div class="container">
            <Link class="navbar-brand" :href="route('admin.dashboard')">U.S.A</Link>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <Link class="nav-link active" aria-current="page" :href="route('admin.customers.index')">
                            Клієнти
                        </Link>
                    </li>
                </ul>
                <div class="d-flex">
                    <div class="input-group">
                        <input @keydown.enter="search"
                               v-model="searchInput"
                               type="text"
                               class="form-control"
                               placeholder="Search"
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
            </div>
        </div>
    </nav>
    <bar-code-reader-modal :show="showBarCodeReader" @closed="showBarCodeReader = false" @decode="onDecode"/>
</template>

<script setup>
import {Link} from "@inertiajs/inertia-vue3";
import BarCodeReaderModal from "@/Components/ModalWindows/BarCodeReaderModal.vue";
import {ref} from "vue";
import { Inertia } from '@inertiajs/inertia'

const showBarCodeReader = ref(false);
const searchInput = ref('');

function onDecode(result) {
    console.log(result);
    showBarCodeReader.value = false;
    searchInput.value = result.text;
}

function search() {
    Inertia.get(
        route('admin.customers.index'),
        {
            search: searchInput.value
        }
    );
}
</script>
