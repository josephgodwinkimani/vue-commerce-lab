<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import FormProduct from '@/Components/Organisms/FormProduct.vue'
import { Head, Link } from '@inertiajs/vue3'
import { ref } from 'vue'

// Create a ref for the ProductForm component.
const productFormRef = ref()

// Calls the submitForm method in ProductForm.
function saveProduct() {
    if (productFormRef.value) {
        productFormRef.value.submitForm()
    }
}
</script>

<template>
    <Head title="Add New Product" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2
                    class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
                >
                    Add New Product
                </h2>
                <div class="flex gap-4">
                    <button
                        class="focus:shadow-outline-blue rounded-lg border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 hover:bg-blue-700 focus:outline-none active:bg-blue-600"
                        @click="saveProduct"
                    >
                        Save
                    </button>
                    <Link
                        :href="route('products.index')"
                        class="focus:shadow-outline-blue rounded-lg border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 hover:bg-blue-700 focus:outline-none active:bg-blue-600"
                        >Cancel</Link
                    >
                </div>
            </div>
        </template>

        <FormProduct ref="productFormRef" action="post" />
    </AuthenticatedLayout>
</template>
