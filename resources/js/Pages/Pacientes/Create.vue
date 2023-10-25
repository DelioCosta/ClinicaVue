<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
    paciente: {type: Object}
})

const form = useForm({
    id: props.paciente ? props.paciente.id : '',
    nome: props.paciente ? props.paciente.nome : '',
    data_nascimento: props.paciente ? props.paciente.data_nascimento : '',
    foto: props.paciente ? props.paciente.foto : ''
});


</script>

<template>
    <Head>
        <title>{{ props.paciente ? 'Edita Paciente' : 'Cadastro de Pacientes' }}</title>
    </Head>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ props.paciente ? 'Edita Paciente' : 'Cadastro de Pacientes' }}</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <form @submit.prevent="$event=> props.paciente ? form.put(route('pacientes.update',props.paciente)) : form.post(route('pacientes.store'))">
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg" >
                        <div class="mb-4 w-96">
                            <InputLabel for="nome" value="Nome"></InputLabel>
                            <TextInput id="nome" v-model="form.nome" type="text" required ></TextInput>
                            <InputError :message="form.errors.nome" class="mt-2"></InputError>
                        </div>
                        <div class="mb-4">
                            <InputLabel for="data_nascimento" value="Data Nascimento"></InputLabel>
                            <TextInput id="data_nascimento" v-model="form.data_nascimento" type="date" required ></TextInput>
                            <InputError :message="form.errors.data_nascimento" class="mt-2"></InputError>
                        </div>
                        <div class="mb-4">
                            <InputLabel for="sexo" value="Sexo"></InputLabel>
                            <select id="sexo" v-model="form.sexo" required>
                                <option value="M">Masculino</option>
                                <option value="F">Feminino</option>
                            </select>
                            <InputError :message="form.errors.sexo" class="mt-2"></InputError>
                        </div>
                        <div class="mb-4">
                            <InputLabel for="foto" value="Foto"></InputLabel>
                            <input type="file" @input="form.foto = $event.target.files[0]">
                            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                {{ form.progress.percentage }}%
                            </progress>
                            <InputError :message="form.errors.foto" class="mt-2"></InputError>
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
