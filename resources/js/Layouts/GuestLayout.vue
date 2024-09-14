<script setup>
import { Link } from '@inertiajs/vue3'
import { useMoodStore } from '@/Stores/Mood'
</script>

<template>
    <n-config-provider :theme-overrides="useMoodStore().overrides">
        <slot />
    </n-config-provider>
</template>
