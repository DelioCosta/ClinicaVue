<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import axios from 'axios';
import {useToast} from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';


const props = defineProps({
    medico: {type: Object}
})

const form = useForm({
    id: props.medico ? props.medico.id : '',
    nome: props.medico ? props.medico.nome : '',
    crm: props.medico ? props.medico.crm : ''
});

const $toast = useToast({
    position: 'top-right',
    duration : 2000,
    dismissible: true
});

const update = () => {
    if(props.medico){ //se está editando um médico
        axios.put('medicos/' + props.medico.id, form)
        .then((res) => {
            console.log(res);
            $toast.success('Médico atualizado com sucesso!');
        })
        .catch((error) => {
            console.log('Error: ' + error.res.data);
            $toast.error('Erro ao atualizar!');
        })
    }
}

</script>

<template>
    <Head>
        <title>{{ props.medico ? 'Edita Médico' : 'Cadastro de Médicos' }}</title>
    </Head>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ props.medico ? 'Edita Médico' : 'Cadastro de Médicos' }}</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <form @submit.prevent="$event=> props.medico ? form.put(route('medicos.update',props.medico)) : form.post(route('medicos.store'))">
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg" >
                        <div class="mb-4 w-96">
                            <InputLabel for="nome" value="Nome"></InputLabel>
                            <TextInput id="nome" v-model="form.nome" type="text" required @blur="update"></TextInput>
                        </div>
                        <div class="mb-4">
                            <InputLabel for="crm" value="CRM"></InputLabel>
                            <TextInput id="crm" v-model="form.crm" type="text" required @blur="update"></TextInput>
                        </div>
                        <div class="my-4" :disabled="form.processing">
                            <PrimaryButton>Salvar</PrimaryButton>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
