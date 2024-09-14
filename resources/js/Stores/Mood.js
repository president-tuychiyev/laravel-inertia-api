import { defineStore } from 'pinia'

export const useMoodStore = defineStore('mood', () => {
    const mood = ref(JSON.parse(localStorage.getItem('mood')))
    const overrides = {
        common: {
            borderRadius: "15px"
        }
    }
    const setMode = () => {
        mood.value = !mood.value
        mood.value ? document.documentElement.classList.add('dark') : document.documentElement.classList.remove('dark')


        localStorage.setItem("mood", mood.value)
    }

    return { mood, overrides, setMode }
})