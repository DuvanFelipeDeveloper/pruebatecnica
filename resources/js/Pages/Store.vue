<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { Head } from "@inertiajs/vue3";
import { Inertia } from "@inertiajs/inertia";
import DangerButton from "@/Components/DangerButton.vue";
import Categories from "./categories/Categories.vue";

const props = defineProps({
    products: {
        type: [Array],
        required: false,
    },
    categories: {
        type: [Array],
        required: false,
    },
});


let defaultSelect={
    name:'All',
    id:0,
};
let selectedCategory = {
    name:'All',
    id:0,
};


const filter = () => {
    Inertia.post(route("store.filter",selectedCategory));
};



</script>

<template>
    <Head title="Store" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Store
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="p-6 text-gray-800 text-right">
                            <label for="category">Select a Category: </label>
                            <select
                                v-model="selectedCategory"
                                id="category"
                                class="border p-2 rounded"
                                
                            >
                                <option :value="defaultSelect">All</option>
                                <option
                                    v-for="category in categories"
                                    :key="category.id"
                                    :value="category.name"
                                    
                                >
                                    {{ category.name }}
                                </option>
                            </select>
                        </div>
                        <div
                            class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6"
                        >
                            <div
                                v-for="product in products"
                                :key="product.id"
                                class="bg-white rounded-lg shadow-md overflow-hidden"
                            >
                                <div
                                    v-show="
                                        selectedCategory ==
                                            product.categorie_name ||
                                        selectedCategory.name == 'All'
                                    "
                                >
                                    <img
                                        :src="product.image_url"
                                        alt="Product Image"
                                        class="w-full h-48 object-cover"
                                    />
                                    <div class="p-4">
                                        <h3
                                            class="text-xl font-semibold text-gray-800"
                                        >
                                            {{ product.name }}
                                        </h3>
                                        <p class="text-gray-600 mt-2">
                                            {{
                                                product.description ||
                                                "No description available"
                                            }}
                                        </p>
                                        <p class="text-gray-800 font-bold mt-4">
                                            Price: ${{ product.price }}
                                        </p>
                                        <p class="text-gray-500">
                                            Stock: {{ product.stock }}
                                        </p>
                                        <p class="text-gray-500">
                                            Category:
                                            {{ product.categorie_name }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
