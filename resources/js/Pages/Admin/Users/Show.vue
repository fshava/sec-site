<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage, Link } from '@inertiajs/inertia-vue3';

const roles = usePage().props.value.roles;
const user = usePage().props.value.user;
const count = usePage().props.value.count;
</script>

<template>

    <Head title="Admin-Users" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-lg font-medium text-gray-900">Admin/Users/{{ user.name }}</h2>

            <p class="mt-1 text-sm text-gray-600">
                <span style="color: red; font-weight: bolder; text-transform: capitalize;">{{ user.name }}</span>
                currently have <span style="font-weight: bold; color: crimson;">{{ count }}</span>
                roles.
            </p>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <!-- Display permissions for selection -->
                    <!-- Jumbotron -->
                    <div class="p-6 shadow-lg rounded-lg bg-gray-100 text-gray-700">
                        <h2 class="font-semibold text-3xl mb-5">{{ user.name }}</h2>


                        <span v-for="role in user.roles"
                            class="text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-blue-600 text-white rounded-full">{{
        role.name
}}</span>

                        <hr class="my-6 border-gray-300" />
                        <p>
                            It uses utility classes for typography and spacing to space content out within the larger
                            container.
                        </p>

                        <Link :href="route('users.index')" as="button"
                            class="text-sm justify-left text-blue-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Back
                        </Link>
                        <span class="justify-right">
                            <Link :href="route('users.edit',user)" as="button"
                            class="text-sm justify-right text-green-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Edit
                        </Link>
                        </span>
                        

                    </div>
                    <!-- Jumbotron -->
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
