<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import CreateRoleForm from './Partials/CreateRoleForm.vue';
import { Head, usePage, Link } from '@inertiajs/inertia-vue3';

const permissions = usePage().props.value.permissions;
</script>

<template>

    <Head title="Admin-Roles" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Admin/Roles/Create</h2>
        </template>
        
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <CreateRoleForm
                        class="max-w-xl"
                    />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
