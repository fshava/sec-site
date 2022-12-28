<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm, usePage } from '@inertiajs/inertia-vue3';
import { nextTick, ref } from 'vue';

const confirmingRoleDeletion = ref(false);
const passwordInput = ref(null);
const props = defineProps({
    role: Object,
});

const form = useForm({
    password: '',
});

const confirmRoleDeletion = () => {
    confirmingRoleDeletion.value = true;

    nextTick(() => passwordInput.value.focus());
};

const deleteRole = () => {
    console.log(props.role);
    form.delete(route('roles.destroy', props.role), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingRoleDeletion.value = false;

    form.reset();
};
</script>

<template>
    <section>

        <DangerButton @click="confirmRoleDeletion">Delete</DangerButton>

        <Modal :show="confirmingRoleDeletion" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">
                    Are you sure your want to delete the role?
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    Once the role is deleted, some users will be unable to do any action which was possible with this role. Please
                    enter your password to confirm you would like to permanently delete your account.
                </p>

                <div class="mt-6">
                    <InputLabel for="password" value="Password" class="sr-only" />

                    <TextInput
                        id="password"
                        ref="passwordInput"
                        v-model="form.password"
                        type="password"
                        class="mt-1 block w-3/4"
                        placeholder="Password"
                        @keyup.enter="deleteRole"
                    />

                    <InputError :message="form.errors.password" class="mt-2" />
                </div>

                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>

                    <DangerButton
                        class="ml-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteRole"
                    >
                        Delete Role
                    </DangerButton>
                </div>
            </div>
        </Modal>
    </section>
</template>
