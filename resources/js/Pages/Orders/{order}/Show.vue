<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Order } from '@/types'
import { formatCurrency, formatDate } from '@/utils'
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
                    Viewing Order ID: {{ order.id }}
                </h2>
                <div class="flex gap-4">
                    <Link
                        :href="route('orders.index')"
                        class="focus:shadow-outline-blue rounded-lg border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 hover:bg-blue-700 focus:outline-none active:bg-blue-600"
                        >All Orders</Link
                    >
                </div>
            </div>
        </template>
        <div class="order">
            <p><span>Order ID:</span> {{ order.id }}</p>
            <p><span>Date:</span> {{ formatDate(order.created_at) }}</p>
            <p>
                <span>Status: </span>
                <span :class="order.status">{{ order.status }}</span>
            </p>
            <p>
                <span>Customer: </span>
                <Link
                    v-if="order.customer"
                    :href="route('customers.show', order.customer.id)"
                >
                    {{ order.customer.name }}
                </Link>
                <span v-else>No Customer</span>
            </p>
            <p><span>Total Items:</span> {{ order.quantity }}</p>
            <div v-if="order.items" class="mb-2">
                <span>Products:</span>
                <ol>
                    <li v-for="item in order.items" :key="item.id">
                        <span>{{ item.quantity }}x </span>
                        <Link :href="route('products.show', item.product_id)">
                            {{ item.product.name }}
                        </Link>
                        ({{ formatCurrency(item.product.price) }})
                    </li>
                </ol>
            </div>
            <p>
                <span>Total Amount:</span>
                {{ formatCurrency(order.total_revenue) }}
            </p>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
.order {
    @apply bg-white p-8 shadow dark:bg-gray-800 dark:text-white;

    p {
        @apply mb-2;
    }

    ol {
        @apply mt-2 list-inside list-decimal;
    }

    span {
        @apply font-semibold;
    }

    a {
        @apply text-blue-500 underline hover:no-underline;
    }

    .completed {
        @apply capitalize text-green-500;
    }

    .pending {
        @apply capitalize text-yellow-500;
    }

    .shipped {
        @apply capitalize text-orange-500;
    }
}
</style>
