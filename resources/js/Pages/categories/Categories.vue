<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { Head } from "@inertiajs/vue3";
import { Inertia } from "@inertiajs/inertia";
import DangerButton from "@/Components/DangerButton.vue";


const props = defineProps({
    categories: {
        type: [Array],
        required: false,
    },
});

const createCategorie = () => {
    Inertia.visit(route("categories.create"));
};

const deleteCategory = (id) => {
    Inertia.delete(route("categories.destroy", id));
};

const editCategory = (id) => {
    Inertia.visit(route("categories.edit",id));
};
</script>

<template>
    <Head title="Categories" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Categories
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 text-right">
                        <h1 class="text-left text-4xl font-bold text-blue-950">
                            List of categories
                        </h1>

                        <PrimaryButton @click="createCategorie"
                            >Create Categorie</PrimaryButton
                        >
                    </div>

                    <div class="p-6 text-gray-900 flex justify-center">
                        <div v-if="categories.length">
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
                                            Name
                                        </th>
                                        <th
                                            class="bg-slate-800 p-3 border border-slate-600 ..."
                                        >
                                            Description
                                        </th>
                                        <th
                                            class="bg-slate-800 p-3 border border-slate-600 ..."
                                        >
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="category in categories"
                                        :key="category.id"
                                    >
                                        <td
                                            class="px-8 border border-slate-700 ..."
                                        >
                                            {{ category.id }}
                                        </td>
                                        <td
                                            class="px-8 border border-slate-700 ..."
                                        >
                                            {{ category.name }}
                                        </td>
                                        <td
                                            class="px-8 border border-slate-700 ..."
                                        >
                                            {{ category.description }}
                                        </td>
                                        <td class="px-8 border border-slate-700 ...">
                                            <DangerButton
                                                @click="
                                                    deleteCategory(category.id)
                                                "
                                            >
                                               Deleted
                                            </DangerButton>

                                            <PrimaryButton @click="
                                                    editCategory(category.id)
                                                ">
                                                Edit
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
    </AuthenticatedLayout>
</template>
