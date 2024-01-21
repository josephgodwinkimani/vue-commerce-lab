<script setup lang="ts">
import ProductForm from '@/Components/ProductForm.vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link } from '@inertiajs/vue3'
defineProps<{
    product: {
        id: number
        name: string
        description: string
        price: number
        quantity: number
        image: string
        user_id: number
        created_at: string
        updated_at: string
    }
}>()
</script>

<template>
    <Head title="Edit {{ product.name }}" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2
                    class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
                >
                    Edit {{ product.name }}
                </h2>
                <Link
                    :href="route('products.view', product.id)"
                    class="focus:shadow-outline-blue rounded-lg border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 hover:bg-blue-700 focus:outline-none active:bg-blue-600"
                    >Cancel</Link
                >
            </div>
        </template>
        <div>
            <ProductForm :product="product" />
        </div>
    </AuthenticatedLayout>
</template>
