<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeletePermissionForm from './Partials/DeletePermissionForm.vue';
import { Head, usePage, Link } from '@inertiajs/inertia-vue3';
import { objectToString } from '@vue/shared';

// defineProps({
//     permission:objectToString,
// });
defineProps({permission: String});
const permissions = usePage().props.value.permissions;
</script>

<template>

    <Head title="Admin-Roles" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Admin/Permissions/Index</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div>
                        <Link
                            :href="route('permissions.create')"
                            method="get"
                            as="button"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            >
                            Create New Permission
                        </Link>
                    </div>
                    <!-- table -->
                    <div class="flex flex-col">
                        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="overflow-hidden">
                                    <table class="min-w-full text-center">
                                        <thead class="border-b bg-gray-800">
                                            <tr>
                                                <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                                                    Name
                                                </th>
                                                <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                                                    Guard
                                                </th>
                                                <th scope="col" colspan="3" width="1%" class="text-sm font-medium text-white px-6 py-4">
                                                    Actions
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="permission in permissions" class="bg-white border-b">
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    {{permission.name}}</td>
                                                <td
                                                    class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                    {{permission.guard_name}}
                                                </td>
                                                <td
                                                    class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                    <Link
                                                        :href="route('permissions.edit', permission.id)"
                                                        as="button"
                                                        type="button"
                                                        class="underline text-sm text-blue-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                                    >
                                                        Edit
                                                    </Link>
                                                </td>
                                                <td
                                                    class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                    <!-- <DeletePermissionForm permission = "{{permission}}"></DeletePermissionForm> -->
                                                    <Link
                                                        :href="route('permissions.destroy', permission)"
                                                        method="delete"
                                                        as="button"
                                                        class="underline text-sm text-red-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                                    >
                                                        Delete
                                                    </Link>
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
