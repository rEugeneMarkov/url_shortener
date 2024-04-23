<script setup>
import Modal from '@/Components/Modal.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm, router } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    link: Object
})

const form = useForm({
    title: props.link.title,
})

const confirmingLinkEdition = ref({});

const confirmLinkEdition = (id) => {
    confirmingLinkEdition.value[id] = true;
}

const closeModal = (id) => {
    confirmingLinkEdition.value[id] = false;
}
function submit() {
    router.put(route('links.update', props.link.id), form);
    closeModal(props.link.id);
}

</script>

<template>
    <div class="border border-gray-300 rounded-md hover:bg-gray-200 size-8 me-2">
        <button class="" @click="confirmLinkEdition(link.id)">
            <i class="px-2 py-1.5 size-4 fas fa-pen"></i>
        </button>
    </div>
    <Modal :show="confirmingLinkEdition[link.id]" @close="closeModal(link.id)">
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white sm:rounded-lg">
                    <div class="p-6 bg-white mx-right">
                        <div class="flex justify-between">
                            <div class="text-xl font-semibold">
                                Edit Link
                            </div>
                        </div>
                    </div>
                    <div class="w-full p-6 mx-auto text-gray-900">
                        <div class="flex flex-col w-full">
                            <InputLabel for="title" value="Title" />
                            <TextInput id="title" type="text" class="block w-full mt-1" v-model="form.title" required />
                            <InputError class="mt-2" :message="form.errors.title" />
                        </div>
                        <div class="flex justify-end mt-5">

                            <SecondaryButton type="button" @click="closeModal(link.id)">
                                Cancel
                            </SecondaryButton>

                            <PrimaryButton type="submit" @click="submit" class="ms-4">
                                Save Changes
                            </PrimaryButton>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Modal>
</template>