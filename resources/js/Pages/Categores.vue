<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head } from '@inertiajs/vue3'
import { AlbumsOutline } from '@vicons/ionicons5'
</script>

<template>

    <Head title="Categores" />

    <AuthenticatedLayout title="Categores page">
        <div class="flex justify-center gap-2">
            <AlbumsOutline class="bg-white dark:bg-gray-800 rounded-xl p-2 w-10" />
            <h1 class="bg-white dark:bg-gray-800 rounded-xl p-2">Categores page</h1>
        </div>
    </AuthenticatedLayout>
</template>