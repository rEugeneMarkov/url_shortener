<script setup>
import MainLayout from '../../Layouts/MainLayout.vue';
import Pagination from '../../Components/Pagination.vue';
import DeleteLink from './Partials/DeleteLink.vue';
import EditLink from './Partials/EditLink.vue';
import Select from '@/Components/Select.vue';
import TextInput from '../../Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';


const props = defineProps({
    links: Object,
    appUrl: String,
    filters: Object,
    sortValues: Object,
    perPageValues: Object,
})

const form = useForm({
    search: props.filters.search ?? '',
    sort_by: props.filters.sort_by,
    per_page: props.filters.per_page,
})

const sortValues = props.sortValues

const perPageValues = props.perPageValues

const isCopied = ref({});

function copyToClipboard(url, id) {
    navigator.clipboard.writeText(url);
    isCopied.value[id] = true;

    setTimeout(() => {
        isCopied.value[id] = false;
    }, 1000);
}
const formatDateString = (dateString) => {
    const date = new Date(dateString);
    const formatter = new Intl.DateTimeFormat('en-US', {
        month: 'short',
        day: 'numeric',
        year: 'numeric',
    });
    return formatter.format(date);
}
const handleSortChange = () => {
    form.get(route('links.index'));
}
</script>

<template>

    <Head title="Links" />

    <MainLayout>
        <template #header>
            <div class="flex justify-between">
                <div>Links</div>
                <Link
                    class="h-12 px-6 -my-2 py-2.5 text-xl font-bold text-white bg-gray-900 border border-gray-500 rounded-lg hover:bg-gray-100 hover:font-semibold hover:text-gray-800"
                    :href="route('links.create')">
                Create New
                </Link>
            </div>
        </template>

        <div v-if="links.data.length">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="w-full overflow-hidden bg-gray-200 sm:rounded-lg">
                    <div class="flex w-full mt-5">
                        <div class="flex flex-col items-center w-full md:pl-6 md:flex-row">
                            <form class="flex flex-col items-center w-72 md:w-full md:flex-row">
                                <TextInput type="text" name="search" placeholder="Search" v-model="form.search"
                                    class="h-8 mb-2 md:mb-0" @change="handleSortChange" />
                                <Select class="h-8 mx-0 mb-2 md:mb-0 md:mx-2" name="sort_by" v-model="form.sort_by"
                                    :values="sortValues" @change="handleSortChange" />
                                <Select class="h-8 mb-2 md:mx-2 md:mb-0" name="per_page" v-model="form.per_page"
                                    :values="perPageValues" @change="handleSortChange" />
                                <Link :href="route('links.index')"
                                    class="inline-block font-semibold leading-6 text-indigo-600 md:ml-6 hover:text-indigo-800">
                                Clear all
                                </Link>
                            </form>
                        </div>
                    </div>
                    <div class="p-6 text-gray-900">
                        <div class="flex flex-col">
                            <ul>
                                <li v-for="link in links.data " :key="link.id">
                                    <div class="p-4 mb-2 bg-white rounded-lg shadow-md md:flex md:justify-between">
                                        <div class="hidden w-20 px-2 md:flex items-none ">
                                            <div
                                                class="flex items-center justify-center w-12 h-12 border-2 rounded-full">
                                                <img :src="link.favicon" alt="" class="w-8 h-8 rounded-full">
                                            </div>
                                        </div>
                                        <div class="grow">
                                            <div class="pb-2">
                                                <Link class="text-xl font-semibold hover:underline"
                                                    :href="route('links.show', link.id)">
                                                {{ link.title }}
                                                </Link>
                                            </div>
                                            <div class="pb-2">
                                                <a class="font-semibold text-blue-500 hover:text-blue-700 hover:underline"
                                                    :href="route('links.redirect', link.back_halve)" target="_blank">
                                                    {{ appUrl + '/' + link.back_halve }}
                                                </a>
                                            </div>
                                            <div class="pb-4">
                                                <a class="hover:underline">
                                                    {{ link.link }}
                                                </a>
                                            </div>
                                            <div class="flex justify-start text-sm">
                                                <div>
                                                    <i class="pe-2 far fa-calendar"></i>
                                                </div>
                                                <div>
                                                    {{ formatDateString(link.created_at) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex flex-row items-start mt-3 text-gray-700 md:mt-0">
                                            <div
                                                class="h-8 bg-gray-200 border border-gray-300 rounded-md hover:bg-gray-300 me-2">
                                                <button class="p-1 mx-2"
                                                    @click="copyToClipboard(appUrl + '/' + link.back_halve, link.id)">
                                                    <div class="flex flex-row items-center">
                                                        <i class="me-2 fas fa-copy"></i>
                                                        {{ isCopied[link.id] ? 'Copied' : 'Copy' }}
                                                    </div>

                                                </button>
                                            </div>

                                            <EditLink :link="link" />
                                            <DeleteLink :link="link" />
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <div class="flex justify-end mt-6">
                                <Pagination :data="links" class="w-full" bg="bg-gray-200" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </MainLayout>
</template>
