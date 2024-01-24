<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Product, TopCustomer } from '@/types'
import { Head } from '@inertiajs/vue3'

const { ordersCount, topCustomers, topSellingProducts } = defineProps<{
    ordersCount: number
    topSellingProducts: Product[]
    topCustomers: TopCustomer[]
}>()
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Dashboard
            </h2>
        </template>
        <div>
            <h2>Recent Orders</h2>
            <p>{{ ordersCount }}</p>
        </div>
        <div>
            <h2>Top Selling Products This Week</h2>
            <ul>
                <li v-for="product in topSellingProducts" :key="product.id">
                    {{ product.name }}
                    {{ product.quantity }}
                </li>
            </ul>
        </div>
        <div>
            <h2>Top Customers This Week</h2>
            <ul>
                <li v-for="customer in topCustomers" :key="customer.id">
                    {{ customer.name }}
                    ${{ customer.total_spent }}
                </li>
            </ul>
        </div>
    </AuthenticatedLayout>
</template>
