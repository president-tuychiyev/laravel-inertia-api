<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head } from '@inertiajs/vue3'
import { NSelect, NTag } from 'naive-ui'

const props = defineProps({
    users: Object
})

const columns = [
    {
        title: '#',
        key: 'id'
    },
    {
        title: 'Name',
        key: 'name'
    },
    {
        title: 'Email',
        key: 'email'
    },
    {
        title: 'Actions',
        key: 'actions',
        render: (row) => {
            return row.role_id == 2 ? h(NTag, { type: 'info' }, { default: () => 'Supper Admin' }) : h(NSelect, { options: [{ label: 'User', value: 1 }, { label: 'Admin', value: 3 }], defaultValue: row.role_id })
        }
    }
]
</script>
<template>

    <Head title="Users" />

    <AuthenticatedLayout title="Users page">
        <n-data-table :columns="columns" :data="users.data" class="bg-white dark:bg-gray-800 p-4 rounded-xl" />
    </AuthenticatedLayout>
</template>