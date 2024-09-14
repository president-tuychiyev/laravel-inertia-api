<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue'
import { HomeOutline, ShieldOutline, PeopleOutline, ShieldCheckmarkOutline, ArchiveOutline, AlbumsOutline } from '@vicons/ionicons5'
import { Link } from '@inertiajs/vue3'

const menus = [
    {
        label: () => h(Link, { href: route('dashboard') }, { default: () => "Home" }),
        key: "dashboard",
        icon: renderIcon(HomeOutline)
    },
    {
        label: 'Admin',
        key: "admin",
        icon: renderIcon(ShieldOutline),
        children: [
            {
                label: () => h(Link, { href: route('user.index') }, { default: () => "Users" }),
                key: "user.index",
                icon: renderIcon(PeopleOutline)
            },
            {
                label: () => h(Link, { href: route('dashboard') }, { default: () => 'Roles' }),
                key: "roles",
                icon: renderIcon(ShieldCheckmarkOutline)
            }
        ]
    },
    {
        label: () => h(Link, { href: route('product.index') }, { default: () => "Products" }),
        key: "product.index",
        icon: renderIcon(ArchiveOutline)
    },
    {
        label: () => h(Link, { href: route('category.index') }, { default: () => "Categores" }),
        key: "category.index",
        icon: renderIcon(AlbumsOutline)
    },
];

const details = reactive({
    collapse: JSON.parse(localStorage.getItem('collapse'))
})

const collapse = (isCollapse) => {
    localStorage.setItem('collapse', isCollapse)
    details.collapse = isCollapse
}
</script>
<template>
    <n-layout-sider @update:collapsed="collapse" :collapsed="details.collapse" bordered show-trigger
        collapse-mode="width" :collapsed-width="64" :width="230" :native-scrollbar="false" class="h-screen">
        <a href="#" target="_blank" class="w-full flex items-center my-2 justify-center p-5">
            <ApplicationLogo />
        </a>
        <n-menu :collapsed-width="64" :collapsed-icon-size="22" :default-value="route().current()" :options="menus"
            class="text-sm font-medium mt-2" />
    </n-layout-sider>
</template>