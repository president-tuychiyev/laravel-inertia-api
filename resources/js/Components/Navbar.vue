<script setup>
import { useMoodStore } from "@/Stores/Mood"
import { useLocaleStore } from "@/Stores/Locale"
import { PersonCircleOutline, ExitOutline, Language, LogOut, MoonOutline, SunnyOutline, RocketOutline, CheckmarkDone } from "@vicons/ionicons5"
import { NIcon } from 'naive-ui'

const props = defineProps({
    user: Object,
    title: String
})

const infoModal = ref(false)

const langs = [
    {
        label: () => useLocaleStore().lang == 'uz' ? h('div', { class: 'flex items-center gap-1' }, {
            default: () => [
                h(NIcon, null, { default: () => h(CheckmarkDone) }),
                'O‘zbekcha'
            ]
        }) : 'O‘zbekcha',
        key: 'uz'
    },
    {
        label: () => useLocaleStore().lang == 'ru' ? h('div', { class: 'flex items-center gap-1' }, {
            default: () => [
                h(NIcon, null, { default: () => h(CheckmarkDone) }),
                'Русский'
            ]
        }) : 'Русский',
        key: 'ru'
    },
    {
        label: () => useLocaleStore().lang == 'en' ? h('div', { class: 'flex items-center gap-1' }, {
            default: () => [
                h(NIcon, null, { default: () => h(CheckmarkDone) }),
                'English'
            ]
        }) : 'English',
        key: 'en'
    }
]

const setLang = (key) => useLocaleStore().setLang(key)

const profileOptions = [
    {
        title: () => "Account",
        key: "profile",
        icon: renderIcon(PersonCircleOutline),
    },
    {
        label: () => h("a", { href: route('auth.logout') }, { default: () => "Logout" }),
        key: "logout",
        icon: renderIcon(ExitOutline),
    }
]

const profile = (key) => {
    if (key == 'profile') {
        infoModal.value = true
    }
}
const defaultAvatar = () => props.user.name.split(' ').map(word => word[0])[0]

const railStyle = ({ checked }) => {
    const style = {};
    checked ? style.background = "#2a2a2e" : style.background = "#f4f5f5"
    return style;
}
</script>

<template>
    <n-layout-header bordered class="shadow-sm sticky top-0 z-50">
        <div class="flex items-center justify-between h-14 px-4">
            <n-tag type="success" class="!px-5 select-none" round>
                {{ props.title }}
            </n-tag>
            <div class="items-center justify-center flex">
                <n-switch :default-value="useMoodStore().mood" @update:value="useMoodStore().setMode()"
                    :rail-style="railStyle">
                    <template #checked-icon>
                        <n-icon :component="MoonOutline" />
                    </template>
                    <template #unchecked-icon>
                        <n-icon :component="SunnyOutline" />
                    </template>
                </n-switch>
                <span class="mx-2"></span>
                <span class="mx-2"></span>
                <n-dropdown trigger="click" :options="langs" @select="setLang">
                    <n-button strong secondary circle>
                        <template #icon>
                            <n-icon :component="Language" />
                        </template>
                    </n-button>
                </n-dropdown>
                <span class="mx-2"></span>
                <n-dropdown trigger="click" :options="profileOptions" @select="profile">
                    <n-button strong secondary circle
                        class="p-5 bg-gradient-to-r  animate-gradient-x background-animate"
                        :class="useMoodStore().mood ? 'from-blue-500 to-orange-500 via-purple-700' : 'from-blue-200 to-orange-200 via-purple-200'">
                        <template #icon>
                            <n-p class="font-semibold">
                                {{ defaultAvatar() }}
                            </n-p>
                        </template>
                    </n-button>
                </n-dropdown>
            </div>
        </div>
    </n-layout-header>

    <n-modal transform-origin="center" v-model:show="infoModal" preset="dialog">
        <template #header>
            <div>Profil</div>
        </template>
        <div class="flex justify-center">
            <p class="text-sm font-bold">{{ user.name }}</p>
        </div>
        <hr class="my-3">
        <div>
            <span>Email: </span>
            <span>{{ user.email }}</span>
        </div>
    </n-modal>
</template>