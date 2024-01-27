<script setup lang="ts">
import ActionIcons from '@/Components/Molecules/ActionIcons.vue'
import Pagination from '@/Components/Molecules/Pagination.vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Product } from '@/types'
import { formatCurrency, formatNumber } from '@/utils'
import { Head, Link } from '@inertiajs/vue3'

const { products } = defineProps<{
    products: {
        data: Product[]
        current_page: number
        last_page: number
        prev_page_url: string | null
        next_page_url: string | null
    }
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
            </div>
        </template>

        <div v-if="!products.data.length" class="flex flex-col gap-4">
            <h3 class="text-xl font-bold dark:text-white">
                No products found.
            </h3>
        </div>

        <div v-else>
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>SKU</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="product in products.data" :key="product.id">
                        <td>
                            <Link :href="route('products.show', product.id)">{{
                                product.name
                            }}</Link>
                        </td>
                        <td>{{ product.sku }}</td>
                        <td>
                            <img
                                :alt="product.name"
                                :src="product.image"
                                class="image"
                                loading="lazy"
                            />
                        </td>
                        <td>{{ product.description }}</td>
                        <td>{{ formatCurrency(product.price) }}</td>
                        <td>{{ formatNumber(product.quantity) }}</td>
                        <td>
                            <ActionIcons
                                :entity-id="product.id"
                                view-route="products.show"
                                delete-route="products.destroy"
                            />
                        </td>
                    </tr>
                </tbody>
            </table>
            <Pagination :pagination-data="products" />
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
.table {
    @apply w-full border-collapse dark:text-white;

    th,
    td {
        @apply p-4 text-left dark:bg-gray-700;
    }

    th {
        @apply bg-gray-100 dark:bg-gray-800;
    }

    a {
        @apply text-blue-500 underline hover:no-underline;
    }

    .image {
        @apply h-16 w-16;
    }
}
</style>
