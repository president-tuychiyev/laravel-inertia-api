<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, router } from '@inertiajs/vue3'
import { NImage, NButtonGroup, NTooltip, NButton, NIcon } from 'naive-ui'
import { Pencil, TrashOutline, SaveOutline, ArchiveOutline } from '@vicons/ionicons5'
import { useMessage } from "naive-ui"

const message = useMessage()
const formRef = ref(null)
const formValue = ref({
    name_uz: "",
    name_ru: "",
    name_en: "",
    desc_uz: "",
    desc_ru: "",
    desc_en: "",
    spec_uz: "",
    spec_ru: "",
    spec_en: "",
    category_ids: "",
    brand_id: ""
})
const props = defineProps({
    categores: Array,
    brands: Array,
    countres: Array,
    products: Object
})

const columns = [
    {
        title: '#',
        key: 'id'
    },
    {
        title: 'Media',
        key: 'media',
        width: 100,
        render: (row) => h(NImage, { src: row.media.src })
    },
    {
        title: 'Name(UZ)',
        key: 'name_uz'
    },
    {
        title: 'Name(RU)',
        key: 'name_ru'
    },
    {
        title: 'Name(EN)',
        key: 'name_en'
    },
    {
        title: 'Actions',
        key: 'actions',
        render: (row) => {
            return h(NButtonGroup, null, {
                default: () => [
                    h(NTooltip, { trigger: 'hover' }, { trigger: () => h(NButton, { type: 'info', ghost: true, onClick: () => show(row) }, { default: () => h(NIcon, null, { default: () => h(Pencil) }) }), default: () => 'Update' }),
                    h(NTooltip, { trigger: 'hover' }, { trigger: () => h(NButton, { type: 'info', ghost: true, onClick: () => destroy(row) }, { default: () => h(NIcon, null, { default: () => h(TrashOutline) }) }), default: () => "Delete" }),
                ]
            })
        }
    }
]

const details = reactive({
    showModal: false
})

const show = (data) => {
    details.showModal = true
    formValue.value = data
    formValue.value.category_ids = data.category.map(item => item.category_id)
}

const rules = {
    name_uz: {
        required: true,
        message: "Please input name(UZ)",
        trigger: "blur"
    },
    name_ru: {
        required: true,
        message: "Please input name(RU)",
        trigger: "blur"
    },
    name_en: {
        required: true,
        message: "Please input name(EN)",
        trigger: "blur"
    }
}

const update = (e) => {
    e.preventDefault()
    formRef.value?.validate((errors) => {
        if (!errors) {
            router.post(route('product.update'), formValue.value, { onSuccess(page) { message.success(page.props.message) } })
        } else {
            console.log(errors)
            message.error("Invalid")
        }
    })
}

const pagination = (page) => router.get(route('product.index'), { page: page })

const setMedia = (file) => file.length > 0 ? formValue.value.media = file[0].file : formValue.value.media = {}

const destroy = (data) => {
    router.delete(route('product.destroy', data.id), { onSuccess(page) { message.success(page.props.message) } })
}

const store = (e) => {
    e.preventDefault()
    formRef.value?.validate((errors) => {
        if (!errors) {
            router.post(route('product.store'), formValue.value, { onSuccess(page) { message.success(page.props.message) } })
        } else {
            console.log(errors)
            message.error("Invalid")
        }
    })
}
</script>

<template>

    <Head title="Products" />

    <AuthenticatedLayout title="Products page">
        <div class="p-2 rounded-xl bg-white dark:bg-gray-800 flex justify-between items-center mb-4">
            <div class="flex justify-start items-center">

            </div>
            <n-button @click="formValue = {}; details.showModal = true">Add</n-button>
        </div>

        <n-data-table :columns="columns" :data="products.data" class="bg-white dark:bg-gray-800 p-4 rounded-xl" />

        <n-modal v-model:show="details.showModal" preset="card" class="!w-[65vw]">
            <n-form ref="formRef" :label-width="80" :model="formValue" :rules="rules" size="large">
                <n-form-item label="Name(UZ)" path="name_uz">
                    <n-input v-model:value="formValue.name_uz" :maxlength="200" clearable show-count
                        placeholder="Input Name(UZ)" />
                </n-form-item>
                <n-form-item label="Name(RU)" path="name_ru">
                    <n-input v-model:value="formValue.name_ru" :maxlength="200" clearable show-count
                        placeholder="Input Name(RU)" />
                </n-form-item>
                <n-form-item label="Name(EN)" path="name_en">
                    <n-input v-model:value="formValue.name_en" :maxlength="200" clearable show-count
                        placeholder="Input Name(EN)" />
                </n-form-item>
                <n-form-item label="Description(UZ)" path="desc_uz">
                    <n-input v-model:value="formValue.desc_uz" :maxlength="500" type="textarea" clearable show-count
                        placeholder="Input Description(UZ)" />
                </n-form-item>
                <n-form-item label="Description(RU)" path="desc_ru">
                    <n-input v-model:value="formValue.desc_ru" :maxlength="500" type="textarea" clearable show-count
                        placeholder="Input Description(RU)" />
                </n-form-item>
                <n-form-item label="Description(EN)" path="desc_en">
                    <n-input v-model:value="formValue.desc_en" :maxlength="500" type="textarea" clearable show-count
                        placeholder="Input Description(EN)" />
                </n-form-item>
                <n-form-item label="Specification(UZ)" path="spec_uz">
                    <n-input v-model:value="formValue.spec_uz" :maxlength="500" type="textarea" clearable show-count
                        placeholder="Input Specification(UZ)" />
                </n-form-item>
                <n-form-item label="Specification(RU)" path="spec_ru">
                    <n-input v-model:value="formValue.spec_ru" :maxlength="500" type="textarea" clearable show-count
                        placeholder="Input Specification(RU)" />
                </n-form-item>
                <n-form-item label="Specification(EN)" path="spec_en">
                    <n-input v-model:value="formValue.spec_en" :maxlength="500" type="textarea" clearable show-count
                        placeholder="Input Specification(EN)" />
                </n-form-item>
                <div class="grid grid-cols-4 justify-center items-center gap-2">
                    <n-form-item label="Categores">
                        <n-select v-model:value="formValue.category_ids" :options="categores" :max-tag-count="1"
                            multiple placeholder="Select cateogres..." class="!w-96" />
                    </n-form-item>
                    <n-form-item label="Brand">
                        <n-select v-model:value="formValue.brand_id" :options="brands" placeholder="Select brand..."
                            class="!w-72" />
                    </n-form-item>
                    <n-form-item label="Country">
                        <n-select v-model:value="formValue.country_id" :options="countres"
                            placeholder="Select country..." filterable class="!w-72" />
                    </n-form-item>
                    <n-form-item label="Media">
                        <n-upload list-type="image-card" :on-update:file-list="setMedia"
                            accept="image/jpeg, image/jpg, image/png, image/webp" :max="1">
                            Click to Upload
                        </n-upload>
                    </n-form-item>

                </div>
                <div class="flex justify-center">
                    <n-button v-if="formValue.id" @click="update">
                        <template #icon>
                            <SaveOutline />
                        </template>
                        Save
                    </n-button>
                    <n-button v-else @click="store">
                        <template #icon>
                            <SaveOutline />
                        </template>
                        Ad new product
                    </n-button>
                </div>
            </n-form>
        </n-modal>
    </AuthenticatedLayout>
</template>