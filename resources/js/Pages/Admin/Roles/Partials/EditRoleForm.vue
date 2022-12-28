<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Checkbox from '@/Components/Checkbox.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/inertia-vue3';
import { ref, onMounted } from 'vue';

const el = ref();

onMounted(() => {
    console.log("hello");

    const permissionAlreadyAssigned = (perm) => {
        // find in rolePermissions array
        for (let index = 0; index < rolePermissions.length; index++) {
            // if a role is found in rolePermissions, return true to populate
            if (rolePermissions[index] == perm) {
                console.log(perm);
                return true;
            }

        }
        return false;
    }

    const populate = (perm) => {
        console.log(perm);
        if (permissionAlreadyAssigned(perm)) {
            // pre-populate permission array
            permission.push(perm);
            // locate and modify checkbox to "checked" before rendering
            document.getElementById(perm).checked = true;
        }
    }
})

const props = defineProps({
    permissions: Object,
    rolePermissions: Object,
    role: Object,
});
var permission = [];
const form = useForm({
    name: props.role.name,
    permission: permission,
});
const permissionExist = (perm) => {
    for (let index = 0; index < permission.length; index++) {
        if (permission[index] == perm) {
            permission.splice(index, 1);
            return true;
        }

    }
    return false;
}


const addPermission = (perm) => {
    if (!permissionExist(perm)) {
        permission.push(perm);
    }
}
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Edit Role</h2>

            <p class="mt-1 text-sm text-gray-600">
                Role should be a particular position of a user in an organisation or name of set of duties
            </p>
        </header>

        <form @submit.prevent="form.patch(route('roles.update', props.role))" class="mt-6 space-y-6">
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus
                    autocomplete="name" />

                <!-- <InputError class="mt-2" :message="form.errors.name" /> -->
            </div>
            <!-- Display permissions for selection -->
            <!-- table -->
            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="overflow-hidden">
                            <table class="min-w-full text-center">
                                <thead class="border-b bg-gray-800">
                                    <tr>
                                        <th scope="col" width="1%"><input type="checkbox" name="all_permission"></th>
                                        <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                                            Name
                                        </th>
                                        <th scope="col" colspan="3" width="1%"
                                            class="text-sm font-medium text-white px-6 py-4">
                                            Guard
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="permission in permissions" class="bg-white border-b">
                                        <td>
                                            <Checkbox :id="permission.name" ref="el" onload="populate(permission.name)"
                                                @click="addPermission(permission.name)" type="checkbox"
                                                :value="permissions.name" :name="permission[permissions.name]" />
                                            <!-- <input type="checkbox" v-model="permission[permission.name]"
                                                :value="permission.name"> -->
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ permission.name }}</td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            {{ permission.guard_name }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end table -->
            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
