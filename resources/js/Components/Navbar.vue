<template>
    <nav class="navbar navbar-dark navbar-expand-lg bg-primary shadow shadow-lg fixed-top"
         style="opacity: 96%">
        <div class="container">
            <Link class="navbar-brand" :href="route('admin.home')">Universal Sports Academy</Link>
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
            </div>
        </div>
    </nav>
</template>

<script setup>
import {Link} from "@inertiajs/inertia-vue3";
</script>
