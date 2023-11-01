<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import db from '@/firebase';
import { collection, query, onSnapshot, where } from 'firebase/firestore';
import { ref } from 'vue';

const consultasM = ref(null);

const getConsultas = async () => {
    const q = query(collection(db,'consultas'), where('medico','==','2'));
    const read = onSnapshot(q, (listaConsultas) => {
        const c = [];
        listaConsultas.forEach((consulta) => {
            console.log(consulta.data());
            c.push(consulta.data());
        })
        consultasM.value = c;
    });
}

getConsultas();
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">You're logged in!</div>
                        <div class="border border-gray-400" v-for="consulta, i in consultasM" :key="consulta.id">
                            <p>{{ consulta.medico }}</p>
                            <p>{{ consulta.paciente }}</p>
                            <p>{{ consulta.data }}</p>
                            <p>{{ consulta.hora }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
