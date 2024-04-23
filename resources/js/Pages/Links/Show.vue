<script setup>
import MainLayout from '../../Layouts/MainLayout.vue';
import { Head, Link, useForm, router } from '@inertiajs/vue3';
import DeleteLink from './Partials/DeleteLink.vue';
import EditLink from './Partials/EditLink.vue';
import { ref } from 'vue';

const props = defineProps({
    link: Object,
    appUrl: String
})

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
    const formatter = new Intl.DateTimeFormat('en-EU', {
        month: 'long',
        day: 'numeric',
        year: 'numeric',
        hour: 'numeric',
        minute: 'numeric',
        second: 'numeric',
        hour12: true,
        timeZone: 'Europe/Riga',
        timeZoneName: 'short'
    });
    return formatter.format(date);
}

</script>

<template>

    <Head title="Link Information" />

    <MainLayout>
        <template #header>
            <h2>Link Information</h2>
        </template>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex justify-between mb-4">
                    <div>
                        <Link :href="route('links.index')"
                            class="text-sm font-semibold leading-6 text-indigo-600 hover:text-indigo-800">
                        < Back to list </Link>
                    </div>
                </div>
                <div class="p-4 mb-2 bg-white rounded-lg shadow-md md:flex md:flex-row lg:justify-between">
                    <div>
                        <div class="flex flex-row justify-between">
                            <div class="pb-2 text-2xl font-bold">
                                {{ link.title }}
                            </div>
                        </div>
                        <div class="flex flex-row">
                            <div class="hidden w-20 px-2 md:flex items-none ">
                                <div class="flex items-center justify-center w-12 h-12 border-2 rounded-full">
                                    <img :src="link.favicon" alt="" class="w-8 h-8 rounded-full">
                                </div>
                            </div>
                            <div class="grow">
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
                        </div>
                    </div>
                    <div class="flex flex-row items-start mt-5 text-gray-700 md:mt-0">
                        <div class="h-8 bg-gray-200 border border-gray-300 rounded-md hover:bg-gray-300 me-2">
                            <button class="p-1 mx-2" @click="copyToClipboard(appUrl + '/' + link.back_halve, link.id)">
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

            </div>
        </div>
    </MainLayout>
</template>
