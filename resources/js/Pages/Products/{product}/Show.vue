<script setup lang="ts">
import { Product } from '@/types'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link } from '@inertiajs/vue3'

const { product } = defineProps<{
    product: Product
}>()
</script>

<template>
    <Head :title="`Viewing: ${product.name}`" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2
                    class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
                >
                    Viewing: {{ product.name }}
                </h2>
                <div class="flex gap-4">
                    <Link
                        :href="route('products.index')"
                        class="focus:shadow-outline-blue rounded-lg border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 hover:bg-blue-700 focus:outline-none active:bg-blue-600"
                        >Go Back</Link
                    >
                    <Link
                        :href="route('products.edit', product.id)"
                        class="focus:shadow-outline-blue rounded-lg border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 hover:bg-blue-700 focus:outline-none active:bg-blue-600"
                        >Edit Product</Link
                    >
                </div>
            </div>
        </template>
        <div class="flex gap-4 dark:text-white">
            <a :href="product.image" target="_blank">
                <img :src="product.image" :alt="product.name" class="h-32 w-32"
            /></a>
            <div>
                <p>{{ product.description }}</p>
                <p>${{ product.price }}</p>
                <p>{{ product.quantity }} available</p>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
