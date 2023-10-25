<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DangerButton from '@/Components/DangerButton.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';

const props = defineProps({
    pacientes: {type: Object}
})

const form = useForm({ id: ''})

const deletePaciente = (id, nome) =>{
    const alerta = Swal.mixin({
        buttonStyling: true
    })

    alerta.fire({
        title: 'Realmente deseja excluir o ' + nome + '?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Excluir',
        cancelButtonText: 'Cancelar',
    }).then((result)=>{
        if(result.isConfirmed){
            form.delete(route('pacientes.destroy', id));
        }
    })
}

</script>

<template>
    <Head title="Pacientes" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pacientes</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="my-4 flex justify-end">
                        <Link :href="route('pacientes.create')" :class="'px-4 py-2 bg-green-500 rounded-md font-semibold mr-1 text-white border'">
                            <i class="fa-solid fa-plus"></i>Adicionar</Link>
                    </div>
                    <table class="table-auto border w-full border-gray-400">
                        <thead class="bg-gray-100">
                            <th class="px-4 py-4">ID</th>
                            <th class="px-4 py-4">Nome</th>
                            <th class="px-4 py-4">Data Nascimento</th>
                            <th class="px-4 py-4">Foto</th>
                            <th class="px-4 py-4 w-40"></th>
                        </thead>
                        <tbody>
                            <tr v-for="paciente, i in pacientes" :key="paciente.id">
                                <td class="border border-gray-400 px-4 py-4">{{ paciente.id }}</td>
                                <td class="border border-gray-400 px-4 py-4">{{ paciente.nome }}</td>
                                <td class="border border-gray-400 px-4 py-4">{{ paciente.data_nascimento }}</td>
                                <td class="border border-gray-400 px-4 py-4">
                                    <img class="rounded-md" :src="'/' + paciente.foto" alt="user image">
                                </td>
                                <td class="border border-gray-400 px-4 py-4">
                                    <Link :href="route('pacientes.edit', paciente.id)" :class="'px-4 py-2 bg-blue-500 rounded-md font-semibold mr-1 text-white border'">
                                        <i class="fa-solid fa-edit"></i>
                                    </Link>
                                    <DangerButton @click="$event => deletePaciente(paciente.id,paciente.nome)">
                                        <i class="fa-solid fa-trash"></i>
                                    </DangerButton>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
</div>
    </AuthenticatedLayout>
</template>
