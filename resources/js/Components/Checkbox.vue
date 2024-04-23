<script setup>

const props = defineProps({
    value: {
        default: null,
    },
});

const model = defineModel({
    type: Boolean,
    default: false,
})

</script>

<template>
    <input type="checkbox" :value="value" v-model="model"
        class="text-indigo-600 border-gray-300 rounded shadow-sm focus:ring-indigo-500" />
</template>
