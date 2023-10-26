<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DangerButton from '@/Components/DangerButton.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import { onMounted } from 'vue';
import {useToast} from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';

const props = defineProps({
    consultas: {type: Object},
    msg: {type: String}
})

const form = useForm({ id: ''})

const $toast = useToast({
    position: 'top-right',
    duration : 2000,
    dismissible: true
});

onMounted(() =>{
    console.log(props.msg);
    if(props.msg){
        $toast.success(props.msg);
    }
});

const deleteConsulta = (id, nome) =>{
    const alerta = Swal.mixin({
        buttonStyling: true
    })

    alerta.fire({
        title: 'Realmente deseja excluir a consulta?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Excluir',
        cancelButtonText: 'Cancelar',
    }).then((result)=>{
        if(result.isConfirmed){
            form.delete(route('consultas.destroy', id));
        }
    })
}

</script>

<template>
    <Head title="Consultas" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Consultas</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="my-4 flex justify-end">
                        <Link :href="route('consultas.create')" :class="'px-4 py-2 bg-green-500 rounded-md font-semibold mr-1 text-white border'">
                            <i class="fa-solid fa-plus"></i>Adicionar</Link>
                    </div>
                    <table class="table-auto border w-full border-gray-400">
                        <thead class="bg-gray-100">
                            <th class="px-4 py-4">ID</th>
                            <th class="px-4 py-4">Paciente</th>
                            <th class="px-4 py-4">Médico</th>
                            <th class="px-4 py-4">Data</th>
                            <th class="px-4 py-4">Hora Início</th>
                            <th class="px-4 py-4">Hora Fim</th>
                            <th class="px-4 py-4">Valor</th>
                            <th class="px-4 py-4 w-40"></th>
                        </thead>
                        <tbody>
                            <tr v-for="consulta, i in consultas" :key="consulta.id">
                                <td class="border border-gray-400 px-4 py-4">{{ consulta.id }}</td>
                                <td class="border border-gray-400 px-4 py-4">{{ consulta.paciente ? consulta.paciente.nome : '' }}</td>
                                <td class="border border-gray-400 px-4 py-4">{{ consulta.medico ? consulta.medico.nome : ''}}</td>
                                <td class="border border-gray-400 px-4 py-4">{{ consulta.data }}</td>
                                <td class="border border-gray-400 px-4 py-4">{{ consulta.hora_inicio }}</td>
                                <td class="border border-gray-400 px-4 py-4">{{ consulta.hora_fim }}</td>
                                <td class="border border-gray-400 px-4 py-4">{{ consulta.valor }}</td>
                                <td class="border border-gray-400 px-4 py-4">
                                    <Link :href="route('consultas.edit', consulta.id)" :class="'px-4 py-2 bg-blue-500 rounded-md font-semibold mr-1 text-white border'">
                                        <i class="fa-solid fa-edit"></i>
                                    </Link>
                                    <DangerButton @click="$event => deleteConsulta(consulta.id)">
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
