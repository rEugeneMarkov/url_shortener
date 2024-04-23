<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
</script>

<template>
    <header class="fixed top-0 w-full px-4 py-3 text-white bg-gray-800">
        <div class="flex items-center justify-end mx-auto lg:justify-between ">
            <div class="items-center hidden text-2xl font-extrabold lg:flex ml-7">
                <ApplicationLogo class="w-8 h-8 mr-3 text-white fill-current" />
                URL Shortener
            </div>
            <div>
                <Menu as="div" class="relative inline-block mr-3 text-left">
                    <MenuButton class="px-2 py-2 text-white">
                        <span class="pr-2">
                            <i class="fas fa-user-circle"></i>
                        </span>
                        <span v-if="$page.props.auth.user">
                            Hi, {{ $page.props.auth.user.name }}
                        </span>
                        <svg class="inline h-3 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                        </svg>
                    </MenuButton>
                    <MenuItems class="absolute right-0 w-40 p-3 mt-2 overflow-auto text-white bg-gray-800 rounded-md">
                        <MenuItem>
                        <Link :href="route('profile.edit')"
                            class="block p-2 text-sm text-white no-underline hover:bg-gray-800 hover:text-gray-400">
                        <i class="fa fa-user fa-fw"></i> Profile
                        </Link>
                        </MenuItem>

                        <MenuItem>
                        <Link :href="route('logout')" method="post" as="button"
                            class="block p-2 text-sm text-white no-underline hover:bg-gray-800 hover:text-gray-400">
                        <i class="fas fa-sign-out-alt fa-fw"></i> Log Out
                        </Link>
                        </MenuItem>
                    </MenuItems>
                </Menu>
            </div>
        </div>
    </header>
</template>