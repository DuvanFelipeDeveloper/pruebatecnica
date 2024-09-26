<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import { Link, useForm } from "@inertiajs/vue3";
import { Head } from "@inertiajs/vue3";
import Multiselect from "vue-multiselect";

const props = defineProps({
    categories: {
        type: [Array],
        required: false,
    },
});



const form = useForm({
    name: "",
    description: "",
    price: 0,
    stock: 0,
    imageUrl: "",
    categorie:''
});
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
                    <div class="p-6 text-gray-900">
                        <form
                            @submit.prevent="
                                form.post(route('products.creating'))
                            "
                            class="mt-6 space-y-6"
                        >
                            <div>
                                <InputLabel for="name" value="Name" />

                                <TextInput
                                    id="name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.name"
                                    required
                                    autofocus
                                    autocomplete="name"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.name"
                                />
                            </div>
                            <div>
                                <InputLabel
                                    for="description"
                                    value="Description"
                                />

                                <TextInput
                                    id="description"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.description"
                                    required
                                />

                                <InputError
                                    class="mt-2"
                                    :message="form.errors.description"
                                />
                            </div>
                            <div>
                                <InputLabel for="price" value="Price" />

                                <TextInput
                                    id="price"
                                    type="number"
                                    class="mt-1 block w-full"
                                    v-model="form.price"
                                    required
                                />

                                <InputError
                                    class="mt-2"
                                    :message="form.errors.price"
                                />
                            </div>

                            <div>
                                <InputLabel for="stock" value="Stock" />

                                <TextInput
                                    id="stock"
                                    type="number"
                                    class="mt-1 block w-full"
                                    v-model="form.stock"
                                    required
                                />

                                <InputError
                                    class="mt-2"
                                    :message="form.errors.stock"
                                />
                            </div>

                            <div>
                                <multiselect
                                    v-model="form.categorie"
                                    deselect-label="Can't remove this value"
                                    track-by="name"
                                    label="name"
                                    placeholder="Select one"
                                    :options="categories"
                                    :searchable="false"
                                    :allow-empty="false"
                                >
                                    <template
                                        slot="singleLabel"
                                        slot-scope="{ option }"
                                        ><strong>{{ option.name }}</strong> is
                                        written in<strong>
                                            {{ option.language }}</strong
                                        ></template
                                    >
                                </multiselect>
                            </div>

                            <div>
                                <InputLabel for="imageUrl" value="ImageUrl" />

                                <TextInput
                                    id="imageUrl"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.imageUrl"
                                    required
                                />

                                <InputError
                                    class="mt-2"
                                    :message="form.errors.imageUrl"
                                />
                            </div>

                            <div class="flex items-center gap-4">
                                <PrimaryButton :disabled="form.processing"
                                    >Save</PrimaryButton
                                >
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
