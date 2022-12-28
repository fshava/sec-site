<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import EditRoleForm from './Partials/EditRoleForm.vue';
import { Head, usePage, Link } from '@inertiajs/inertia-vue3';

const role = usePage().props.value.role;
const rolePermissions = usePage().props.value.rolePermissions;
const count = usePage().props.value.count;
</script>

<template>

    <Head title="Admin-Roles" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-lg font-medium text-gray-900">Admin/Roles/{{ role.name }}</h2>

            <p class="mt-1 text-sm text-gray-600">
                <span style="color: red; font-weight: bolder; text-transform: capitalize;">{{ role.name }}</span> role currently have <span style="font-weight: bold; color: crimson;">{{ count }}</span>
                permissions.
            </p>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <!-- Display permissions for selection -->
                    <!-- table -->
                    <div class="flex flex-col">
                        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="overflow-hidden">
                                    <table class="min-w-full text-center">
                                        <thead class="border-b bg-gray-800">
                                            <tr>
                                                <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                                                    Permission Name
                                                </th>
                                                <th scope="col" colspan="3" width="1%"
                                                    class="text-sm font-medium text-white px-6 py-4">
                                                    Guard
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="permission in rolePermissions" class="bg-white border-b">
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    {{ permission.name }}</td>
                                                <td
                                                    class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
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
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
