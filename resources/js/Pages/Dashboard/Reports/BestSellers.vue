<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Product } from '@/types'
import { formatCurrency, formatNumber } from '@/utils'
import { Head, Link } from '@inertiajs/vue3'

const { bestSellingProducts } = defineProps<{
    bestSellingProducts: Product[]
}>()
</script>

<template>
    <Head title="Report: Best Sellers" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Report: Best Sellers
            </h2>
        </template>

        <div v-if="!bestSellingProducts.length" class="flex flex-col gap-4">
            <h3 class="text-xl font-bold dark:text-white">
                No Best products found.
            </h3>
        </div>

        <div v-else>
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Orders</th>
                        <th>Total Revenue</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="product in bestSellingProducts"
                        :key="product.id"
                    >
                        <td>
                            <Link :href="route('products.show', product.id)">{{
                                product.name
                            }}</Link>
                        </td>
                        <td>{{ formatNumber(product.lifetime_sales) }}</td>
                        <td>{{ formatCurrency(product.lifetime_revenue) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
.table {
    @apply w-full border-collapse capitalize dark:text-white;

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
}
</style>
