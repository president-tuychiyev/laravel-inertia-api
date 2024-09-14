import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Standart vue imports
 */
import { h, ref, reactive, onMounted, computed } from 'vue'
window.h = h
window.ref = ref
window.reactive = reactive
window.onMounted = onMounted
window.computed = computed

/**
 * Standart Inertia imports
 */
import { usePage, router } from '@inertiajs/vue3'
window.usePage = usePage
window.router = router

/**
 * Standart Naive imports
 */
import { NIcon } from 'naive-ui'
window.renderIcon = (icon) => {
    return () => h(NIcon, null, { default: () => h(icon) })
}

localStorage.getItem('locale') === null ? localStorage.setItem('locale', 'uz') : null

/**
 * default mood for this system UI
 */
localStorage.getItem('mood') === null ? localStorage.setItem('mood', false) : null
const userTheme = JSON.parse(localStorage.getItem('mood'));
const systemTheme = window.matchMedia('(prefers-color0scheme: dark)').matches;
window.onload = () => {
    if (userTheme || (!userTheme && systemTheme)) {
        document.documentElement.classList.add('dark');
        return;
    }
}
