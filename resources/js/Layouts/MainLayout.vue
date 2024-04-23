<script setup>
import Header from '../Layouts/MainPartials/Header.vue';
import Sidebar from '../Layouts/MainPartials/Sidebar.vue';
import { Bars3Icon, BellIcon, XMarkIcon } from '@heroicons/vue/24/outline'
import { ref } from 'vue';

const sidebarOpen = ref(false);

const toggleSidebar = () => {
  sidebarOpen.value = !sidebarOpen.value;
}
</script>

<template>
  <div class="flex flex-col h-screen">
    <Header class="z-50 h-16" />
    <div class="flex flex-1 pt-16">
      <Sidebar :class="{ 'hidden lg:block': !sidebarOpen }" />
      <main class="flex-1 h-screen overflow-y-auto bg-gray-200">
        <div class="sticky top-0 h-16 text-white bg-gray-800 " v-if="$slots.header">
          <div class=" rounded-tl-3xl bg-gradient-to-r from-gray-900 to-gray-700">
            <div class="p-4 ml-2 text-3xl font-semibold text-white">
              <slot name="header" />
            </div>
          </div>
        </div>
        <div class="p-4">
          <slot />
        </div>
      </main>
    </div>
  </div>
  <div class="fixed z-50 lg:hidden top-4 left-4">
    <button id="sidebarToggle" @click="toggleSidebar"
      class="px-2 py-2 text-white bg-gray-800 rounded-md shadow-md focus:outline-none focus:ring-2 focus:ring-gray-600">
      <Bars3Icon v-if="!sidebarOpen" class="block w-6 h-6" />
      <XMarkIcon v-else class="block w-6 h-6" />
    </button>
  </div>
</template>

<style scoped>
aside {
  height: calc(100vh - 4rem);
}

main {
  height: calc(100vh - 4rem);
}
</style>