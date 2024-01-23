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
    <Head :title="`Viewing Order ID: ${order.id}`" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2
                    class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
                >
                    Viewing Order ID: {{ order.product.id }}
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
        <div class="bg-white shadow-md">
            <div class="md:flex">
                <div class="p-8">
                    <div
                        class="text-sm font-semibold uppercase tracking-wide text-indigo-500"
                    >
                        Order ID: {{ order.id }}
                    </div>
                    <p
                        class="mt-1 block text-lg font-medium leading-tight text-black"
                    >
                        Date: {{ formatDate(order.created_at) }}
                    </p>
                    <p class="mt-2 text-gray-500">
                        <span>Status: </span>
                        <span :class="order.status">{{ order.status }}</span>
                    </p>
                    <p class="mt-2 text-gray-500">
                        <span>Customer: </span>
                        <Link
                            v-if="order.customer"
                            :href="route('customers.show', order.customer.id)"
                            class="text-indigo-600 hover:text-indigo-900"
                        >
                            {{ order.customer.name }}
                        </Link>
                        <span v-else class="text-gray-400">No Customer</span>
                    </p>
                    <p class="mt-2 text-gray-500">
                        <span>Product: </span>
                        <Link
                            v-if="order.product"
                            :href="route('products.show', order.product.id)"
                            class="text-indigo-600 hover:text-indigo-900"
                        >
                            {{ order.product.name }}
                        </Link>
                        <span v-else class="text-gray-400">No Product</span>
                    </p>
                    <p class="mt-2 text-gray-500">
                        Quantity: {{ order.quantity }}
                    </p>
                    <p class="mt-2 text-gray-500">
                        Total Amount: ${{ order.total_amount }}
                    </p>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
.completed {
    @apply text-green-500;
}

.pending {
    @apply text-yellow-500;
}

.shipped {
    @apply text-blue-500;
}
</style>
