<script setup>
import { useMoodStore } from '@/Stores/Mood'
import { darkTheme } from 'naive-ui'
import Sidebar from '@/Components/Sidebar.vue'
import Navbar from '@/Components/Navbar.vue'

const props = defineProps({ title: String })
</script>

<template>
    <n-config-provider :theme-overrides="useMoodStore().overrides" :theme="useMoodStore().mood ? darkTheme : null">
        <n-space vertical>
            <n-layout has-sider>
                <Sidebar />
                <n-layout-content>
                    <Navbar :user="$page.props.auth.user" :title="title" />
                    <n-layout-content>
                        <div class="rounded-lg h-[91vh] bg-slate-100 dark:bg-slate-950">
                            <div class="p-5">
                                <slot />
                            </div>
                        </div>
                    </n-layout-content>
                </n-layout-content>
            </n-layout>
        </n-space>
    </n-config-provider>
</template>
