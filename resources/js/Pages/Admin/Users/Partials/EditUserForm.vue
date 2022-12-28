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
    for (let index = 0; index < props.roles.length; index++) {
        const element = props.roles[index];
        // find in Permissions array
        for (let index = 0; index < props.userRoles.length; index++) {
            // if a role is found in permissions, populate
            if (props.userRoles[index] == element.name) {
                // pre-populate permission array
                role.push(element.name);
                // locate and modify checkbox to "checked" before rendering
                document.getElementById(element.name).checked = true;
                console.log(element.name);
            }

        }
    }

});

const props = defineProps({
    user: Object,
    userRoles: Object,
    roles: Object,
});
var role = [];
const form = useForm({
    user: props.user,
    role: role,
});
const roleExist = (rol) => {
    for (let index = 0; index < role.length; index++) {
        if (role[index] == rol) {
            role.splice(index, 1);
            return true;
        }

    }
    return false;
}


const addRole = (rol) => {
    if (!roleExist(rol)) {
        role.push(rol);
    }
}
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Edit User</h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ props.user.name }} currently have <span style="font-weight: bold; color: crimson;">20</span> roles.
            </p>
        </header>

        <form @submit.prevent="form.patch(route('users.update', props.user))" class="mt-6 space-y-6">
            <!-- Display roles for selection -->
            <!-- table -->
            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="overflow-hidden">
                            <table class="min-w-full text-center">
                                <thead class="border-b bg-gray-800">
                                    <tr>
                                        <th scope="col" width="1%"><input type="checkbox" name="all_role"></th>
                                        <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                                            Role
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="role in props.roles" class="bg-white border-b">
                                        <td>
                                            <Checkbox :id="role.name" ref="el"
                                                @click="addRole(role.name)" type="checkbox"
                                                :value="role.name" :name="role[role.name]" />
                                            <!-- <input type="checkbox" v-model="permission[permission.name]"
                                                :value="permission.name"> -->
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ role.name }}</td>
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
