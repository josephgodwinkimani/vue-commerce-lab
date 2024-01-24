<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Product, TopCustomer } from '@/types'
import { formatCurrency, formatNumber } from '@/utils'
import { Head, Link } from '@inertiajs/vue3'

const {
    ordersCount,
    totalRecentOrdersAmount,
    topCustomers,
    topSellingProducts
} = defineProps<{
    ordersCount: number
    totalRecentOrdersAmount: number
    topSellingProducts: Product[]
    topCustomers: TopCustomer[]
}>()
</script>

<template>
    <Head title="Dashboard - Vue Commerce Lab" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Welcome, {{ $page.props.auth.user.name }}!
            </h2>
        </template>
        <section class="flex gap-8">
            <aside class="widget">
                <h2>This Week's Orders</h2>
                <p>Total: {{ formatNumber(ordersCount) }}</p>
                <p>Amount: {{ formatCurrency(totalRecentOrdersAmount) }}</p>
                <Link href="/orders">View All Orders</Link>
            </aside>
            <aside class="widget">
                <h2>Top Selling Products This Week</h2>
                <ol>
                    <li v-for="product in topSellingProducts" :key="product.id">
                        <Link :href="`/products/${product.id}`">
                            {{ product.name }}
                        </Link>
                        {{ formatNumber(product.quantity) }}
                    </li>
                </ol>
                <Link href="/products">View All Products</Link>
            </aside>
            <aside class="widget">
                <h2>Top Customers This Week</h2>
                <ol>
                    <li v-for="customer in topCustomers" :key="customer.id">
                        <Link :href="`/customers/${customer.id}`">
                            {{ customer.name }}
                        </Link>
                        {{ formatCurrency(customer.total_spent) }}
                    </li>
                </ol>
                <Link href="/customers">View All Customers</Link>
            </aside>
        </section>
    </AuthenticatedLayout>
</template>

<style scoped>
.widget {
    @apply flex flex-col gap-2 rounded-lg bg-gray-100 p-4 shadow-md dark:bg-gray-800 dark:text-white;

    h2 {
        @apply text-lg font-semibold;
    }

    a {
        @apply text-blue-500 underline hover:no-underline;
    }

    ol {
        @apply list-inside list-decimal;
    }
}
</style>
