<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DangerButton from '@/Components/DangerButton.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';

const props = defineProps({
    medicos: {type: Object}
})

const form = useForm({ id: ''})

const deleteMedico = (id, nome) =>{
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
            form.delete(route('medicos.destroy', id));
        }
    })
}

</script>

<template>
    <Head title="Médicos" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Médicos</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <table class="table-auto border w-full border-gray-400">
                        <thead class="bg-gray-100">
                            <th class="px-4 py-4">ID</th>
                            <th class="px-4 py-4">Nome</th>
                            <th class="px-4 py-4">CRM</th>
                            <th class="px-4 py-4 w-40"></th>
                        </thead>
                        <tbody>
                            <tr v-for="med, i in medicos" :key="med.id">
                                <td class="border border-gray-400 px-4 py-4">{{ med.id }}</td>
                                <td class="border border-gray-400 px-4 py-4">{{ med.nome }}</td>
                                <td class="border border-gray-400 px-4 py-4">{{ med.crm }}</td>
                                <td class="border border-gray-400 px-4 py-4">
                                    <Link :href="route('medicos.edit', med.id)" :class="'px-4 py-2 bg-blue-500 rounded-md font-semibold mr-1 text-white border'">
                                        <i class="fa-solid fa-edit"></i>
                                    </Link>
                                    <DangerButton @click="$event => deleteMedico(med.id,med.nome)">
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
