<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Link, Head } from '@inertiajs/vue3'

// Define page props.
const { products } = defineProps<{
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
            <ul class="grid grid-cols-2 gap-8">
                <!-- Loop through products and display each one -->
                <li v-for="product in products" :key="product.id">
                    <div class="flex flex-col gap-4">
                        <h3 class="text-xl font-bold dark:text-white">
                            {{ product.name }}
                        </h3>
                        <Link
                            class="hover:underline dark:text-white"
                            :href="
                                route('products.view', {
                                    product: product.id
                                })
                            "
                        >
                            <img
                                :src="product.image"
                                alt="Product image"
                                class="image"
                            />
                        </Link>
                        <div class="flex items-center gap-4">
                            <Link
                                class="hover:underline dark:text-white"
                                :href="
                                    route('products.view', {
                                        product: product.id
                                    })
                                "
                                >View</Link
                            >
                            <Link
                                class="hover:underline dark:text-white"
                                :href="
                                    route('products.edit', {
                                        product: product.id
                                    })
                                "
                                >Edit</Link
                            >
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
.image {
    @apply h-64 w-64;
}

.action {
    @apply rounded-full bg-blue-500 px-4 py-2 font-bold text-white hover:bg-blue-700;
}
</style>
