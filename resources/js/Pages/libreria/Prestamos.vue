<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Inertia } from "@inertiajs/inertia";
import { ref, computed } from 'vue';
import { Head } from "@inertiajs/vue3";

const props = defineProps({
    libros: {
        type: Array,
        required: false,
    },
    mensaje: {
        type: String,
        required: false,
        default: "",
    },
});

const prestamo = (id) => {
    Inertia.post(route("prestamo.solicitar", { id: id }));
};
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Prestamos
            </h2>
        </template>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        {{ mensaje }}

                        <div class="p-6 text-gray-900 flex justify-center">
                            <div v-if="libros.length">

                                <table
                                    class="shadow-2xl border-collapse border border-slate-500 ..."
                                >
                                    <thead>
                                        <tr class="text-slate-100">
                                            <th
                                                class="bg-slate-800 p-3 border border-slate-600 ..."
                                            >
                                                ID
                                            </th>
                                            <th
                                                class="bg-slate-800 p-3 border border-slate-600 ..."
                                            >
                                                nombre
                                            </th>
                                            <th
                                                class="bg-slate-800 p-3 border border-slate-600 ..."
                                            >
                                                codigo
                                            </th>
                                            <th
                                                class="bg-slate-800 p-3 border border-slate-600 ..."
                                            >
                                                estado
                                            </th>
                                            <th
                                                class="bg-slate-800 p-3 border border-slate-600 ..."
                                            >
                                                genero
                                            </th>
                                            <th
                                                class="bg-slate-800 p-3 border border-slate-600 ..."
                                            >
                                                accion
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            v-for="libro in libros"
                                            :key="libro.id"
                                        >
                                            <td
                                                class="px-8 border border-slate-700 ..."
                                            >
                                                {{ libro.id }}
                                            </td>
                                            <td
                                                class="px-8 border border-slate-700 ..."
                                            >
                                                {{ libro.nombre }}
                                            </td>
                                            <td
                                                class="px-8 border border-slate-700 ..."
                                            >
                                                {{ libro.codigo }}
                                            </td>

                                            <td
                                                class="px-8 border border-slate-700 ..."
                                            >
                                                {{ libro.estado }}
                                            </td>
                                            <td
                                                class="px-8 border border-slate-700 ..."
                                            >
                                                {{ libro.genero }}
                                            </td>

                                            <td
                                                class="px-8 border border-slate-700 ..."
                                            >
                                                <PrimaryButton
                                                    @click="prestamo(libro.id)"
                                                >
                                                    Solicitar
                                                </PrimaryButton>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
