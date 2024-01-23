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
                        :href="route('products.edit', product.id)"
                        class="focus:shadow-outline-blue rounded-lg border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 hover:bg-blue-700 focus:outline-none active:bg-blue-600"
                        >Edit Product</Link
                    >
                    <Link
                        :href="route('products.index')"
                        class="focus:shadow-outline-blue rounded-lg border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 hover:bg-blue-700 focus:outline-none active:bg-blue-600"
                        >All Products</Link
                    >
                </div>
            </div>
        </template>
        <div class="bg-white shadow-md">
            <div class="md:flex">
                <div class="md:flex-shrink-0">
                    <img
                        :src="product.image"
                        :alt="product.name"
                        class="h-48 w-full object-cover md:h-full md:w-48"
                    />
                </div>
                <div class="p-8">
                    <div
                        class="text-sm font-semibold uppercase tracking-wide text-indigo-500"
                    >
                        {{ product.name }}
                    </div>
                    <p
                        class="mt-1 block text-lg font-medium leading-tight text-black"
                    >
                        Price: ${{ product.price }}
                    </p>
                    <p class="mt-2 text-gray-500">{{ product.description }}</p>
                    <p class="mt-2 text-gray-500">
                        Quantity: {{ product.quantity }}
                    </p>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
