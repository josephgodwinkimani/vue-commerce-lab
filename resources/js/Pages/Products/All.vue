<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Link, Head } from '@inertiajs/vue3'
defineProps<{
    products: {
        id: number
        name: string
        description: string
        price: number
        quantity: number
        image: string
        user_id: number
        created_at: string
        updated_at: string
    }[]
}>()
</script>

<template>
    <Head title="All Products" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2
                    class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
                >
                    All Products
                </h2>
                <Link
                    :href="route('products.create')"
                    class="focus:shadow-outline-blue rounded-lg border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 hover:bg-blue-700 focus:outline-none active:bg-blue-600"
                    >Add New Product</Link
                >
            </div>
        </template>
        <div>
            <ul>
                <!-- Loop through products and display each one -->
                <li v-for="product in products" :key="product.id">
                    <div>
                        <h2>{{ product.name }}</h2>
                        <img :src="product.image" alt="Product image" />
                        <Link
                            :href="
                                route('products.view', { product: product.id })
                            "
                            >View</Link
                        >
                        <Link
                            :href="
                                route('products.edit', { product: product.id })
                            "
                            >Edit</Link
                        >
                    </div>
                </li>
            </ul>
        </div>
    </AuthenticatedLayout>
</template>
