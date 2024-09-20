<template>
    <Head title="Create Appel" />
    
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-5">Crée une ticket</h2>
        </template>

        <div class="max-w-2xl mx-auto">
            <form @submit.prevent="submit" class="bg-white p-6 rounded-lg shadow-md">

                <div class="mb-4">
                    <label for="appel_id" class="block text-sm font-medium text-gray-700">Appel</label>
                    <select
                        id="appel_id"
                        v-model="form.appel_id"
                        required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                    >
                        <option disabled value="">Sélectionnez une appel</option>
                        <option v-for="appel in appels" :key="appel.id" :value="appel.id">
                            {{ appel.appel_id }}
                        </option>
                    </select>

                </div>

                <div class="mb-4">
                    <label for="commentaire" class="block text-sm font-medium text-gray-700">Commentaire</label>
                    <input
                        type="text"
                        id="commentaire"
                        v-model="form.commentaire"
                        required
                        min="1"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                    />
                </div>

                <div class="mb-4">
                    <label for="subject" class="block text-sm font-medium text-gray-700">Sujet de l'appel</label>
                    <select
                        id="appel_id"
                        v-model="form.status"
                        required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                    >
                        <option value="EnCours">En Cours</option>
                        <option value="Resolu">Resolu</option>
                        <option value="Non Resolu">Non Resolu</option>
                        <option value="Annule">Annule</option>
                       
                    </select>
                </div>

                <div class="flex items-center justify-end">
                    <button
                        type="submit"
                        class="bg-blue-500 text-white font-semibold py-2 px-4 rounded hover:bg-blue-600 transition duration-200"
                    >
                        Save
                    </button>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
    import { ref } from 'vue';
    import { Inertia } from '@inertiajs/inertia';
    import { Head } from '@inertiajs/vue3';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

    const form = ref({
        appel_id: '',
        commentaire: '',
        status: ''
    });

    const submit = () => {
        Inertia.post('/tickets', form.value);
    };
</script>
