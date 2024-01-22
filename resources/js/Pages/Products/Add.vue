<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import ProductForm from '@/Components/ProductForm.vue'
import { Head, Link } from '@inertiajs/vue3'
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
                <Link
                    :href="route('products.index')"
                    class="focus:shadow-outline-blue rounded-lg border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 hover:bg-blue-700 focus:outline-none active:bg-blue-600"
                    >Cancel</Link
                >
            </div>
        </template>

        <ProductForm :product="{}" action="post" button-text="Add Product" />
    </AuthenticatedLayout>
</template>
