<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { Head } from "@inertiajs/vue3";
import { Inertia } from "@inertiajs/inertia";
import DangerButton from "@/Components/DangerButton.vue";


const props = defineProps({
    products: {
        type: [Array],
        required: false,
    },
});

const prueba = () => {
    console.log(props.products);
};

const createCategorie = () => {
    Inertia.visit(route("products.create"));
};

const deleteProduct = (id) => {
    Inertia.delete(route("products.destroy", id));
};

const editProduct = (id) => {
    Inertia.visit(route("products.edit",id));
};
</script>

<template>
    <Head title="Categories" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Products
            </h2>
        </template>


        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 text-right">
                        <h1 class="text-left text-4xl font-bold text-blue-950">
                            List of products
                        </h1>

                        <PrimaryButton @click="createCategorie"
                            >Create product</PrimaryButton
                        >
                    </div>

                    <div class="p-6 text-gray-900 flex justify-center">
                        <div v-if="products.length">
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
                                            Price
                                        </th>
                                        <th
                                            class="bg-slate-800 p-3 border border-slate-600 ..."
                                        >
                                            Stock
                                        </th>
                                        <th
                                            class="bg-slate-800 p-3 border border-slate-600 ..."
                                        >
                                            Category
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
                                        v-for="product in products"
                                        :key="product.id"
                                    >
                                        <td
                                            class="px-8 border border-slate-700 ..."
                                        >
                                            {{ product.id }}
                                        </td>
                                        <td
                                            class="px-8 border border-slate-700 ..."
                                        >
                                            {{ product.name }}
                                        </td>
                                        <td
                                            class="px-8 border border-slate-700 ..."
                                        >
                                            {{ product.description }}
                                        </td>

                                        <td
                                            class="px-8 border border-slate-700 ..."
                                        >
                                            {{ product.price }}
                                        </td>
                                        <td
                                            class="px-8 border border-slate-700 ..."
                                        >
                                            {{ product.stock }}
                                        </td>
                                        <td
                                            class="px-8 border border-slate-700 ..."
                                        >
                                            {{ product.categorie_name }}
                                        </td>

                                        <td class="px-8 border border-slate-700 ...">
                                            <DangerButton
                                                @click="
                                                    deleteProduct(product.id)
                                                "
                                            >
                                               Deleted
                                            </DangerButton>

                                            <PrimaryButton @click="
                                                    editProduct(product.id)
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
