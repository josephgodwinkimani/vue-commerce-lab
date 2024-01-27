<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Product } from '@/types'
import { formatCurrency, formatNumber } from '@/utils'
import { Head, Link } from '@inertiajs/vue3'

const { product, totalSalesLastWeek } = defineProps<{
    product: Product
    totalSalesLastWeek: number
}>()
</script>

<template>
    <Head :title="`Viewing Product: ${product.name}`" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2
                    class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
                >
                    Viewing Product: {{ product.name }}
                </h2>
                <div class="flex gap-4">
                    <Link
                        :href="route('products.index')"
                        class="focus:shadow-outline-blue rounded-lg border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 hover:bg-blue-700 focus:outline-none active:bg-blue-600"
                        >All Products</Link
                    >
                </div>
            </div>
        </template>
        <div class="product">
            <div class="md:flex">
                <div class="md:flex-shrink-0">
                    <img
                        :src="product.image"
                        :alt="product.name"
                        class="h-48 w-full object-cover md:h-full md:w-48"
                    />
                </div>
                <div class="p-8">
                    <p><span>Name:</span> {{ product.name }}</p>
                    <p><span>Description:</span> {{ product.description }}</p>
                    <p>
                        <span>Price:</span> {{ formatCurrency(product.price) }}
                    </p>
                    <p>
                        <span>Quantity:</span>
                        {{ formatNumber(product.quantity) }}
                    </p>
                    <p>
                        <span>Total Sales Last Week:</span>
                        {{ formatNumber(totalSalesLastWeek) }}
                    </p>
                    <p>
                        <span>Total Lifetime Sales:</span>
                        {{ formatNumber(product.lifetime_sales) }} ({{
                            formatCurrency(product.lifetime_revenue)
                        }})
                    </p>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
.product {
    @apply overflow-hidden rounded shadow-md dark:bg-gray-800 dark:text-white;

    a {
        @apply text-blue-600 hover:underline;
    }

    span {
        @apply font-semibold;
    }
}
</style>
