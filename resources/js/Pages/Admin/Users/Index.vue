<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
// import DeleteRoleForm from './Partials/DeleteRoleForm.vue';
import { Head, usePage, Link } from '@inertiajs/inertia-vue3';

const users = usePage().props.value.users;
</script>

<template>

    <Head title="Admin-Roles" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Admin/Users/Index</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
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
                                                    Email
                                                </th>
                                                <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                                                    Verified at
                                                </th>
                                                <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                                                    Roles
                                                </th>
                                                <th scope="col" colspan="3" width="1%"
                                                    class="text-sm font-medium text-white px-6 py-4">
                                                    Actions
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="user in users" class="bg-white border-b">
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    {{ user.name }}
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    {{ user.email }}
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    {{ user.email_verified_at }}
                                                </td>
                                                <td>
                                                    <div class="flex space-x-2 justify-center">
                                                        <span v-for="role in user.roles"
                                                            class="text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-blue-600 text-white rounded-full">
                                                            <Link :href="route('roles.show', role)" as="button">
                                                                {{ role.name }}
                                                            </Link>
                                                        </span>
                                                    </div>
                                                </td>
                                                <td
                                                    class="text-sm text-green-900 font-light px-6 py-4 whitespace-nowrap">
                                                    <Link :href="route('users.show', user)" as="button"
                                                        class="underline text-sm text-green-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                    View
                                                    </Link>
                                                </td>
                                                <td
                                                    class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                    <Link :href="route('users.edit', user)" as="button"
                                                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                    Edit
                                                    </Link>
                                                </td>
                                                <!-- <td
                                                    class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                    <DeleteRoleForm :role="role" />
                                                </td> -->
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
