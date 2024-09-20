<template>
    <Head title="Tickets" />
    
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-5">Tickets</h2>

            <div class="mb-5">
                <button 
                    @click="createTicket"
                    class="bg-green-500 text-white font-semibold py-2 px-4 rounded hover:bg-green-600 transition duration-200"
                >
                    Nouvelle Ticket
                </button>
            </div>
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="py-2 px-4 border-b">Client</th>
                        <th class="py-2 px-4 border-b">Commentaire</th>
                        <th class="py-2 px-4 border-b">status</th>
                        <th class="py-2 px-4 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="ticket in tickets.data" :key="ticket.id">
                        <td class="py-2 px-4 border-b">{{ ticket.client?.name }}</td>
                        <td class="py-2 px-4 border-b">{{ ticket.commentaire }}</td>
                        <td class="py-2 px-4 border-b">{{ ticket.status }}</td>
                        <td class="py-2 px-4 border-b flex justify-start items-center">
                            <button 
                                @click="ticketEdit(ticket.id)" 
                                class="bg-blue-500 text-white font-semibold py-1 px-3 rounded hover:bg-blue-600 transition duration-200"
                            >
                                Edit
                            </button>
                            <button 
                                @click="deleteTicket(ticket.id)" 
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
        tickets: Object, 
    });

    const ticketEdit = (id) => {
        Inertia.visit(`/tickets/${id}/edit`); 
    };

    const deleteTicket = async (id) => {
        if (confirm("Are you sure you want to delete this record?")) {
            await Inertia.delete(`/tickets/${id}`);
        }
    };

    const changePage = (page) => {
        Inertia.get('/tickets', { page }, { preserveState: true });
    };

    const createTicket = () => {
        Inertia.visit('/tickets/create');
    };

</script>
