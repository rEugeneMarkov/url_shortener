<script setup>
import { Link } from '@inertiajs/vue3';
</script>
<template>
    <aside class="w-screen h-screen bg-gray-800 lg:w-64">
        <div class="flex flex-row overflow-y-auto">
            <div class="w-full lg:w-64">
                <ul class="sticky mx-4 text-lg font-extrabold text-white">
                    <li class="mb-2">
                        <Link :href="route('dashboard')"
                            :class="{ 'bg-gray-700 border-b-2 border-red-500': route().current('dashboard') }"
                            class="block px-4 py-2 rounded-md hover:bg-gray-700 hover:border-b-2 hover:border-red-500">
                        <i class="size-5 me-4 fas fa-home"></i>
                        Dashboard
                        </Link>
                    </li>
                    <li class="mb-2">
                        <Link :href="route('links.index')"
                            :class="{ 'bg-gray-700 border-b-2 border-green-500': route().current('links.*') }"
                            class="block px-4 py-2 rounded-md hover:bg-gray-700 hover:border-b-2 hover:border-green-500">
                        <i class="size-5 me-4 fas fa-link"></i>
                        Links
                        </Link>
                    </li>
                </ul>
            </div>
        </div>
    </aside>

</template>
