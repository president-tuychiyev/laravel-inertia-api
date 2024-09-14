<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue"
import LoginBgImage from "@/Assets/bg-login.webp"
import { Head } from '@inertiajs/vue3'
import { useMessage } from "naive-ui"

const message = useMessage()

const formRef = ref()
const formValue = ref({
    email: "",
    password: "",
})

const rules = {
    login: {
        required: true,
        message: "Please input your login",
        trigger: "blur"
    },
    password: {
        required: true,
        message: "Please input your password",
        trigger: "blur"
    }
}

const handleValidateClick = (e) => {
    e.preventDefault();
    formRef.value?.validate((errors) => {
        if (!errors) {
            router.post(route('auth.login'), formValue.value)
        } else {
            console.log(errors);
            message.error("Invalid");
        }
    });
}
</script>

<template>
    <GuestLayout>

        <Head title="Login" />

        <div :style="`background-image: url('${LoginBgImage}')`" class="bg-cover bg-center h-screen">
            <div class="bg-black/50 h-screen w-screen">
                <div class="flex items-center h-screen justify-between max-w-screen-md mx-auto">
                    <div>
                        <img src="@/Assets/logo.png" class="w-72" />
                        <p class="text-white mt-1 uppercase text-xs tracking-widest text-right select-none">
                            Medical online service
                        </p>
                    </div>
                    <div
                        class="block p-10 backdrop-blur-sm rounded-lg shadow-xl relative bg-white/40 max-w-sm text-center">
                        <p class="text-white font-bold uppercase">
                            Dashboard
                        </p>
                        <div class="flex items-center justify-center mt-6">
                            <n-form ref="formRef" :label-width="80" :model="formValue" :rules="rules" size="large">
                                <n-form-item label="Login" path="login">
                                    <n-input v-model:value="formValue.login" placeholder="Input login" />
                                </n-form-item>
                                <n-form-item label="Password" path="password">
                                    <n-input v-model:value="formValue.password" :maxlength="8" type="password"
                                        show-password-on="mousedown" placeholder="Input password" />
                                </n-form-item>

                                <div class="flex justify-center mt-8">
                                    <n-button color="black" @click="handleValidateClick">Login</n-button>
                                </div>
                            </n-form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
