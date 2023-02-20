<template>
    <nav class="navbar navbar-dark navbar-expand-lg bg-primary shadow shadow-lg fixed-top" style="opacity: 96%">
        <div class="container">
            <Link class="navbar-brand" :href="route('admin.home')">
                USAcademy
                <span class="badge text-bg-warning">beta</span>
            </Link>
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div id="navbarSupportedContent" class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <Link class="nav-link active" aria-current="page" :href="route('admin.customers.index')">
                            Клієнти
                        </Link>
                    </li>
                    <li class="nav-item">
                        <Link class="nav-link active" aria-current="page" :href="route('admin.transactions.index')">
                            Транзакції
                        </Link>
                    </li>
                </ul>
                <ul class="navbar-nav flex-row flex-wrap">
                    <li class="nav-item dropdown">
                        <Link
                            class="nav-link dropdown-toggle"
                            role="link"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                        >
                            Налаштування
                            <i class="fa-md fa-solid fa-gear"></i>
                        </Link>
                        <ul class="dropdown-menu">
                            <li>
                                <Link class="dropdown-item" :href="route('admin.subscriptions.index')">Підписки</Link>
                            </li>
                            <li>
                                <Link class="dropdown-item" :href="route('admin.users.index')">Користувачі</Link>
                            </li>
                            <li>
                                <Link class="dropdown-item d-flex align-items-center" method="post"  as="button" :href="route('logout')">
                                    <div class="me-3">
                                        Log out
                                    </div>
                                    <i class="fa-solid fa-right-from-bracket"></i>
                                </Link>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script setup>
import {Link} from "@inertiajs/inertia-vue3";
</script>
