<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';


const form = useForm({
    name: '',
});
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Create Permission</h2>

            <p class="mt-1 text-sm text-gray-600">
                Permission name should only include letters of alphabet
            </p>
        </header>

        <form @submit.prevent="form.post(route('permissions.store'))" class="mt-6 space-y-6">
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <!-- <InputError class="mt-2" :message="form.errors.name" /> -->
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
