import i18n from '@/Locales'
import { defineStore } from 'pinia'

export const useLocaleStore = defineStore('locale', () => {
    const lang = ref(localStorage.getItem('locale'))

    const setLang = (locale) => {
        i18n.global.locale.value = locale
        lang.value = locale
        localStorage.setItem('locale', locale)
    }

    return { lang, setLang }
})