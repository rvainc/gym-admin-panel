<template>
    <nav class="navbar navbar-dark navbar-expand-lg bg-primary container-fluid shadow shadow-lg sticky-top"
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
                        <Link class="nav-link active" aria-current="page" :href="route('admin.customers.index')">Клієнти</Link>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search" aria-label="Search"
                               aria-describedby="button-addon2">
                        <button class="btn btn-secondary" type="button" id="button-addon2">
                            <i class="fa-solid fa-barcode"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </nav>
</template>

<script>
import {Link} from "@inertiajs/inertia-vue3";

export default {
    name: 'Navbar',
    components: {
        Link,
    }
}
</script>

<style scoped>

</style>
