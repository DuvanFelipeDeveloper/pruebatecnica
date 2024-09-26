<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { Link, useForm } from "@inertiajs/vue3";

const props = defineProps({
    user: {
        type: Object,
        required: false,
    },

    valorretiro: {
        type: [Array],
        required: false,
    },

    fondos: {
        type: Boolean,
        required: false,
        default:true,
    },
    retiromin: {
        type: Boolean,
        required: false,
        default:true,
    },
    retiromax: {
        type: Boolean,
        required: false,
        default:true,
    },
});

const retiro = () => {
    Inertia.post(route("saldo.retiro"));
};

const form = useForm({
    retiro: 0,
    usuario: props.user,
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Cajero
            </h2>
        </template>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div>Salado = {{ user.saldo }}</div>

                        <form
                            @submit.prevent="form.post(route('cajero.retiro'))"
                            class="mt-6 space-y-6"
                        >
                            <div>
                                <label for="">retiro valor:</label>
                                <input v-model="form.retiro" type="number" />
                                <button :disabled="form.processing">
                                    retiro
                                </button>
                            </div>

                            <h1 v-show="!retiromin ">retiro denegado por valor minimo</h1>
                            <h1 v-show="!retiromax">retiro denegado por valor maximo</h1>
                            <h1 v-show="!fondos">retiro denegado por fondos insuficientes</h1>
                            <h1 v-show="fondos &&  retiromin &&  retiromax && form.retiro != 0">retiro aprobado</h1>


                            <div v-for="item in valorretiro">

                                <p>{{ item }}</p>
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
