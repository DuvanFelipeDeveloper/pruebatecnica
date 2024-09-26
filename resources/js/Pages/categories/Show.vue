<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div>
            <h1>Categorias</h1>
            <p>Esta es la pagina de Categorias</p>
        </div>
    </AuthenticatedLayout>
</template>