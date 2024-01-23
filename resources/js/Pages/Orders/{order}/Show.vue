<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Order } from '@/types'
import { formatDate } from '@/utils'
import { Head, Link } from '@inertiajs/vue3'

const { order } = defineProps<{
    order: Order
}>()
</script>

<template>
    <Head :title="`Viewing: ${order.id}`" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2
                    class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
                >
                    Viewing: {{ order.id }}
                </h2>
                <div class="flex gap-4">
                    <Link
                        :href="route('orders.edit', order.id)"
                        class="focus:shadow-outline-blue rounded-lg border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 hover:bg-blue-700 focus:outline-none active:bg-blue-600"
                        >Edit Order</Link
                    >
                    <Link
                        :href="route('orders.index')"
                        class="focus:shadow-outline-blue rounded-lg border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 hover:bg-blue-700 focus:outline-none active:bg-blue-600"
                        >All Orders</Link
                    >
                </div>
            </div>
        </template>
        <div class="flex gap-4 dark:text-white">
            {{ order.id }}
            {{ formatDate(order.created_at) }}
            <Link
                v-if="order.customer"
                :href="route('customers.show', order.customer.id)"
            >
                {{ order.customer.name }}
            </Link>
            <span v-else>No Customer</span>

            <Link
                v-if="order.product"
                :href="route('products.show', order.product.id)"
            >
                {{ order.product.name }}
            </Link>
            <span v-else>No Product</span>

            {{ order.quantity }}
            ${{ order.total_amount }}
        </div>
    </AuthenticatedLayout>
</template>
