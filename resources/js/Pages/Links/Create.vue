<script setup>
import MainLayout from '../../Layouts/MainLayout.vue';
import { Head } from '@inertiajs/vue3';
import CreateForm from './Partials/CreateForm.vue';

</script>

<template>

    <Head title="User create" />

    <MainLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2>Create new</h2>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200 mx-right">
                        <div class="flex justify-between">
                            <div>
                                Create
                            </div>
                            <div>
                            </div>
                        </div>
                    </div>
                    <CreateForm />
                </div>
            </div>
        </div>
    </MainLayout>
</template>
