import { createI18n } from 'vue-i18n'

import uz from './uz.json'
import ru from './ru.json'
import en from './en.json'

const messages = { uz: uz, ru: ru, en: en }

const i18n = createI18n({
    locale: localStorage.getItem('locale'),
    legacy: false,
    fallbackLocale: localStorage.getItem('locale'),
    messages: messages
})

export default i18n