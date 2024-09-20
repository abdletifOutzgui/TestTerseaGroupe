<template>
    <Head title="Create Appel" />
    
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-5">Create New Appel</h2>
        </template>

        <div class="max-w-2xl mx-auto">
            <form @submit.prevent="submit" class="bg-white p-6 rounded-lg shadow-md">

                <div class="mb-4">
                    <label for="call_time" class="block text-sm font-medium text-gray-700">L'heure de l'appel</label>
                    <input
                        type="datetime-local"
                        id="call_time"
                        v-model="form.call_time"
                        required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                    />
                </div>

                <div class="mb-4">
                    <label for="duration" class="block text-sm font-medium text-gray-700">Durée (mins)</label>
                    <input
                        type="number"
                        id="duration"
                        v-model="form.duration"
                        required
                        min="1"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                    />
                </div>

                <div class="mb-4">
                    <label for="subject" class="block text-sm font-medium text-gray-700">Sujet de l'appel</label>
                    <input
                        type="text"
                        id="subject"
                        v-model="form.subject"
                        required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                    />
                </div>

                <div class="flex items-center justify-end">
                    <button
                        type="submit"
                        class="bg-blue-500 text-white font-semibold py-2 px-4 rounded hover:bg-blue-600 transition duration-200"
                    >
                        Create Appel
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
        call_time: '',
        comment: '',
        duration: '',
        subject: ''
    });

    const submit = () => {
        Inertia.post('/appels', form.value);
    };
</script>
