<template>
    <nav class="flex justify-center mt-4">
        <ul class="flex space-x-2">
            <li v-if="links.prev">
                <button @click="goToPage(links.prev.url)" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-1 px-3 rounded">
                    Previous
                </button>
            </li>
            <li v-for="link in links" :key="link.label">
                <button 
                    v-if="link.url" 
                    @click="goToPage(link.url)" 
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-1 px-3 rounded"
                >
                    {{ link.label }}
                </button>
            </li>
            <li v-if="links.next">
                <button @click="goToPage(links.next.url)" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-1 px-3 rounded">
                    Next
                </button>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    props: {
        links: Array,
    },
    methods: {
        goToPage(url) {
            this.$emit('change-page', url.split('page=')[1]);
        }
    },
};
</script>
