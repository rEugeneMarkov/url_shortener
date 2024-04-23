<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import CreateForm from './Links/Partials/CreateForm.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const props = defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
})
</script>

<template>

    <Head title="Welcome" />
    <div class="relative flex flex-col items-center min-h-screen bg-gray-100 dark:bg-gray-900">
        <div class="z-50">
            <ApplicationLogo class="w-12 h-12 py-1 mt-2 text-white fill-current" />
        </div>
        <nav v-if="canLogin"
            class="fixed top-0 right-0 flex justify-end flex-1 w-full px-6 py-4 text-lg font-bold bg-slate-500">
            <Link v-if="$page.props.auth.user" :href="route('dashboard')"
                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
            Dashboard
            </Link>

            <template v-else>
                <Link :href="route('login')"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                Log in
                </Link>

                <Link v-if="canRegister" :href="route('register')"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                Register
                </Link>
            </template>
        </nav>

        <div class="mt-20">
            <div class="">


                <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

                    <div class="text-center">
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">URL Shortener</h1>
                    </div>

                    <div class="text-center">
                        <p class="mt-4 text-lg text-gray-500 dark:text-white/90">
                            URL Shortener with Laravel, Vue, Tailwind and Inertia.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
