<script setup>
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import { router } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    link: Object
})

const confirmingLinkDeletion = ref({});

const confirmLinkDeletion = (id) => {
    confirmingLinkDeletion.value[id] = true;
}

const closeModal = (id) => {
    confirmingLinkDeletion.value[id] = false;
}

const destroy = (id) => {
    router.delete(route('links.destroy', id));
}
</script>

<template>
    <div class="block border border-gray-300 rounded-md hover:bg-gray-200 size-8">
        <button class="p-1" @click.prevent="confirmLinkDeletion(link.id)">
            <i class="size-5 fas fa-trash"></i>
        </button>
    </div>
    <Modal :show="confirmingLinkDeletion[link.id]" @close="closeModal(link.id)">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900">
                Are you sure you want to delete this Link?
            </h2>

            <div class="flex justify-end mt-6">
                <SecondaryButton @click="closeModal(link.id)"> Cancel
                </SecondaryButton>

                <DangerButton class="ms-3" @click="destroy(link.id)">
                    Delete Link
                </DangerButton>
            </div>
        </div>
    </Modal>
</template>