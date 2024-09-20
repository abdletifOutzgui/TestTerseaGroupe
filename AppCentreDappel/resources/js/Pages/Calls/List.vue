<template>
    <Head title="Appels" />
    
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-5">Appels</h2>

            <div class="mb-5">
                <button 
                    @click="createAppel"
                    class="bg-green-500 text-white font-semibold py-2 px-4 rounded hover:bg-green-600 transition duration-200"
                >
                    Nouvelle Appel
                </button>
            </div>
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="py-2 px-4 border-b">Agent</th>
                        <th class="py-2 px-4 border-b">Subject</th>
                        <th class="py-2 px-4 border-b">Comment</th>
                        <th class="py-2 px-4 border-b">Call Time</th>
                        <th class="py-2 px-4 border-b">Duration (mins)</th>
                        <th class="py-2 px-4 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="appel in appels.data" :key="appel.id">
                        <td class="py-2 px-4 border-b">{{ appel.agent?.name }}</td>
                        <td class="py-2 px-4 border-b">{{ appel.subject }}</td>
                        <td class="py-2 px-4 border-b">{{ appel.comment }}</td>
                        <td class="py-2 px-4 border-b">{{ new Date(appel.call_time).toLocaleString() }}</td>
                        <td class="py-2 px-4 border-b">{{ appel.duration }}</td>
                        <td class="py-2 px-4 border-b flex justify-start items-center">
                            <button 
                                @click="editCall(appel.id)" 
                                class="bg-blue-500 text-white font-semibold py-1 px-3 rounded hover:bg-blue-600 transition duration-200"
                            >
                                Edit
                            </button>
                            <button 
                                @click="deleteCall(appel.id)" 
                                class="bg-red-500 text-white font-semibold py-1 px-3 rounded hover:bg-red-600 transition duration-200 ml-2"
                            >
                                Delete
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="mt-4">
                <Pagination :links="appels.links" @change-page="changePage"/>
            </div>
        </template>
    </AuthenticatedLayout>
</template>

<script setup>
    import { Head } from '@inertiajs/vue3';
    import { defineProps } from 'vue';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import Pagination from '@/Components/Pagination.vue';

    const props = defineProps({
        appels: Object, 
    });

    const editCall = (id) => {
        Inertia.visit(`/appels/${id}/edit`); 
    };

    const deleteCall = async (appelId) => {
        if (confirm("Are you sure you want to delete this record?")) {
            await Inertia.delete(`/appels/${appelId}`);
        }
    };

    const changePage = (page) => {
        Inertia.get('/appels', { page }, { preserveState: true });
    };

    const createAppel = () => {
        Inertia.visit('/appels/create');
    };

</script>
