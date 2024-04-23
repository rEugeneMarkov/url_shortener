<script setup>
import { Head, Link, useForm, router } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const props = defineProps({
    submitUrl: {
        type: String,
        default: 'links.store'
    },
    cancelUrl: {
        type: String,
        default: 'links.index'
    }
})

const form = useForm({
    title: '',
    link: '',
})

const submit = () => {
    form.post(route(props.submitUrl));
}

const cancel = () => {
    router.get(route(props.cancelUrl));
}
</script>

<template>
    <div class="w-full max-w-4xl p-6 mx-auto text-gray-900">
        <div class="flex flex-col">
            <InputLabel for="link" value="Destination" />
            <TextInput id="link" type="text" class="block w-full mt-1" placeholder="https://example.com/my-long-url"
                v-model="form.link" required />
            <InputError class="mt-2" :message="form.errors.link" />

            <InputLabel for="title" value="Title (optional)" class="mt-4" />
            <TextInput id="title" type="text" class="block w-full mt-1" v-model="form.title" />
            <InputError class="mt-2" :message="form.errors.title" />
        </div>
        <div class="flex justify-end mt-4">
            <SecondaryButton type="link" @click="cancel" class="h-10 mr-3">
                Cancel
            </SecondaryButton>
            <PrimaryButton class="h-10" @click="submit" :disabled="!form.isDirty"
                :class="{ 'opacity-50 cursor-not-allowed': !form.isDirty }">
                Create
            </PrimaryButton>
        </div>

    </div>
</template>