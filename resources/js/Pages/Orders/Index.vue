<script setup lang="ts">
import ActionIcons from '@/Components/Molecules/ActionIcons.vue'
import Pagination from '@/Components/Molecules/Pagination.vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Order } from '@/types'
import { formatCurrency, formatDate, formatNumber } from '@/utils'
import { Head, Link } from '@inertiajs/vue3'

const { orders } = defineProps<{
    orders: {
        data: Order[]
        current_page: number
        last_page: number
        prev_page_url: string | null
        next_page_url: string | null
    }
}>()
</script>

<template>
    <Head title="All Orders" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2
                    class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
                >
                    All Orders
                </h2>
                <Link
                    :href="route('orders.create')"
                    class="focus:shadow-outline-blue rounded-lg border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 hover:bg-blue-700 focus:outline-none active:bg-blue-600"
                    >Add New Order</Link
                >
            </div>
        </template>

        <div v-if="!orders.data.length" class="flex flex-col gap-4">
            <h3 class="text-xl font-bold dark:text-white">No orders found.</h3>
        </div>

        <div v-else>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Status</th>
                        <th>Customer</th>
                        <th>Date</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="order in orders.data" :key="order.id">
                        <td>{{ order.id }}</td>
                        <td :class="order.status">{{ order.status }}</td>
                        <td>
                            <Link
                                v-if="order.customer"
                                :href="
                                    route('customers.show', order.customer.id)
                                "
                            >
                                {{ order.customer.name }}
                            </Link>
                            <span v-else>No Customer</span>
                        </td>
                        <td>{{ formatDate(order.created_at) }}</td>
                        <td>
                            <Link
                                v-if="order.product"
                                :href="route('products.show', order.product.id)"
                            >
                                {{ order.product.name }}
                            </Link>
                            <span v-else>No Product</span>
                        </td>
                        <td>{{ formatNumber(order.quantity) }}</td>
                        <td>{{ formatCurrency(order.total_amount) }}</td>
                        <td>
                            <ActionIcons
                                :entity-id="order.id"
                                edit-route="orders.edit"
                                view-route="orders.show"
                                delete-route="orders.destroy"
                            />
                        </td>
                    </tr>
                </tbody>
            </table>
            <Pagination :pagination-data="orders" />
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

.completed {
    @apply text-green-500;
}

.pending {
    @apply text-yellow-500;
}

.shipped {
    @apply text-orange-500;
}
</style>
