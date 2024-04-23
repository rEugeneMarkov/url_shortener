<script setup>
import { Link } from '@inertiajs/vue3';
import { ChevronLeftIcon, ChevronRightIcon } from '@heroicons/vue/20/solid';

const props = defineProps({
    data: {
        type: Object,
        default: () => ({}),
    },
    bg: {
        type: String,
        default: 'bg-white',
    },
});
</script>

<template>
    <div v-if="data.last_page > 1" :class="bg"
        class="flex items-center justify-between px-4 py-3 border-t border-gray-200 sm:px-6">
        <div class="flex justify-between flex-1 sm:hidden">
            <Link :href="data.prev_page_url ? data.prev_page_url : data.path + '?page=' + data.current_page"
                class="btn-for-sm">Previous</Link>
            <div class="btn-for-sm">{{ data.current_page }} of {{ data.last_page }} pages</div>
            <Link :href="data.next_page_url ? data.next_page_url : data.path + '?page=' + data.current_page"
                class="btn-for-sm">Next</Link>
        </div>
        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-700 me-6">
                    Showing{{ ' ' }}
                    <span class="font-medium">{{ data.from }}</span>
                    {{ ' ' }}to{{ ' ' }}
                    <span class="font-medium">{{ data.to }}</span>
                    {{ ' ' }}of{{ ' ' }}
                    <span class="font-medium">{{ data.total }}</span>
                    {{ ' ' }}results
                </p>
            </div>
            <div>
                <div class="inline-flex -space-x-px rounded-md shadow-sm isolate">
                    <template v-if="data.links.length > 3">
                        <div class="flex">
                            <Link class="btn-previous" :href="data.prev_page_url ? data.prev_page_url : '#'"
                                :class="{ 'cursor-not-allowed': !data.prev_page_url }">
                            <ChevronLeftIcon class="w-5 h-5" />
                            </Link>

                            <template v-for="link in data.links">

                                <Link v-if="link.active" class="btn-current" :href="link.url" v-html="link.label" />

                                <Link v-else-if="Number(link.label) || link.label === '...'" class="btn-default"
                                    :href="link.url ? link.url : '#'" v-html="link.label"
                                    :class="{ 'cursor-not-allowed': link.label === '...' }"
                                    :disabled="link.label === '...'" />
                            </template>

                            <Link class="btn-next" :href="data.next_page_url ? data.next_page_url : '#'"
                                :class="{ 'cursor-not-allowed': !data.next_page_url }">
                            <ChevronRightIcon class="w-5 h-5" />
                            </Link>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.btn-next {
    @apply relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0;
}

.btn-previous {
    @apply relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0;
}

.btn-current {
    @apply relative z-10 inline-flex items-center bg-sky-600 px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-600;
}

.btn-default {
    @apply relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0;
}

.btn-for-sm {
    @apply relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 ms-2;
}

.ellipsis {
    @apply relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 ring-1 ring-inset ring-gray-300 focus:outline-offset-0;

}
</style>