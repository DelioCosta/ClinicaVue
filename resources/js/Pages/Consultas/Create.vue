<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import SelectInput from '@/Components/SelectInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import axios from 'axios';
import {useToast} from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';
import { ref } from 'vue';

const props = defineProps({
    consulta: {type: Object},
    medicos: {type: Object},
    pacientes: {type: Object}
})

const form = useForm({
    id: props.consulta ? props.consulta.id : '',
    paciente_id: props.consulta ? props.consulta.paciente_id : '',
    medico_id: props.consulta ? props.consulta.medico_id : '',
    dt: props.consulta ? props.consulta.data : '',
    hora_inicio: props.consulta ? props.consulta.hora_inicio : '',
    hora_fim: props.consulta ? props.consulta.hora_fim : '',
    valor: props.consulta ? props.consulta.valor : ''
});

const $toast = useToast({
    position: 'top-right',
    duration : 2000,
    dismissible: true
});

const block = ref(false);

const check = () => {

    if(!form.medico_id || !form.dt || !form.hora_inicio){
        return false;
    }

    const dados = {
        'medico_id': form.medico_id,
        "data": form.dt,
        "hora": form.hora_inicio,
    };
    axios.get('consultas/check', {params : dados})
    .then((res) =>{
        if(res.data.status == 'sucess'){
            $toast.success(res.data.message);
            block.value = false;
        }else{
            $toast.error(res.data.message);
            block.value = true;
        }
    });

}
</script>

<template>
    <Head>
        <title>{{ props.consulta ? 'Editar Consulta' : 'Cadastro de Consultas' }}</title>
    </Head>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ props.consulta ? 'Edita Consulta' : 'Cadastro de Consultas' }}</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <form @submit.prevent="$event=> props.consulta ? form.put(route('consultas.update',props.consulta)) : form.post(route('consultas.store'))">
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg flex flex-wrap gap-4" >
                        <div class="mb-4">
                            <InputLabel for="paciente_id" value="Paciente"></InputLabel>
                            <SelectInput id="paciente_id" :options="pacientes" v-model="form.paciente_id" required ></SelectInput>
                        </div>
                        <div class="mb-4">
                            <InputLabel for="medico_id" value="Médico"></InputLabel>
                            <SelectInput id="medico_id" :options="medicos" v-model="form.medico_id" @change="check" required ></SelectInput>
                        </div>
                        <div class="mb-4">
                            <InputLabel for="dt" value="Data"></InputLabel>
                            <TextInput id="dt" v-model="form.dt" @blur="check" type="date" required></TextInput>
                        </div>
                        <div class="mb-4">
                            <InputLabel for="hora_inicio" value="Hora Início"></InputLabel>
                            <TextInput id="hora_inicio" v-model="form.hora_inicio" @blur="check" type="time" required></TextInput>
                        </div>
                        <div class="mb-4">
                            <InputLabel for="hora_fim" value="Hora Fim"></InputLabel>
                            <TextInput id="hora_fim" v-model="form.hora_fim" type="time" required></TextInput>
                        </div>
                        <div class="mb-4">
                            <InputLabel for="valor" value="Valor"></InputLabel>
                            <TextInput id="valor" v-model="form.valor" type="text" required></TextInput>
                        </div>
                        <div class="my-4" >
                            <PrimaryButton :disabled="form.processing || block" >Salvar</PrimaryButton>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
