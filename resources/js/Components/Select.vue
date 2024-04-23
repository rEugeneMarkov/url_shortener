<script setup>
import { ref } from 'vue'

const props = defineProps({
    values: Object,
    required: true,
})

const model = defineModel({
    required: true,
});

</script>

<template>
    <select v-model="model"
        class="py-0 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        <option v-for="(value, key) in values" :key="key" :value="key">
            {{ value }}
        </option>
    </select>
</template>