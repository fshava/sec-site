<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import EditUserForm from './Partials/EditUserForm.vue';
import { Head, usePage, Link } from '@inertiajs/inertia-vue3';

const user = usePage().props.value.user;
const userRoles = usePage().props.value.userRoles;
const roles = usePage().props.value.roles;
</script>

<template>

    <Head title="Admin-Users" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Admin/Users/Edit</h2>
        </template>
        
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <EditUserForm
                    :user="user"
                    :userRoles="userRoles"
                    :roles="roles"      
                    class="max-w-xl"
                    />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
