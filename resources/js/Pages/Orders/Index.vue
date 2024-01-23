<script setup lang="ts">
import { Order } from '@/types'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Link, Head } from '@inertiajs/vue3'

// Define page props.
const { orders } = defineProps<{
    orders: Order[]
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
            </div>
        </template>

        <!-- If there are no orders -->
        <div v-if="!orders.length" class="flex flex-col gap-4">
            <h3 class="text-xl font-bold dark:text-white">No orders found.</h3>
        </div>

        <!-- Orders Table -->
        <table v-else class="orders-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Status</th>
                    <th>Customer</th>
                    <th>Date</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="order in orders" :key="order.id">
                    <td>
                        <Link
                            class="hover:underline"
                            :href="route('orders.show', order.id)"
                            >{{ order.id }}</Link
                        >
                    </td>
                    <td>{{ order.status }}</td>
                    <td>{{ order.customerId }}</td>
                    <td>{{ order.createdAt }}</td>
                    <td>{{ order.quantity }}</td>
                    <td>${{ order.totalAmount }}</td>
                    <td>
                        <Link
                            class="hover:underline"
                            :href="route('orders.show', order.id)"
                            >View</Link
                        >
                        |
                        <Link
                            class="hover:underline"
                            :href="route('orders.edit', order.id)"
                            >Edit</Link
                        >
                    </td>
                </tr>
            </tbody>
        </table>
    </AuthenticatedLayout>
</template>

<style scoped>
.orders-table {
    @apply w-full border-collapse dark:text-white;
}

.orders-table th,
.orders-table td {
    @apply p-4 text-left dark:bg-gray-700;
}

.orders-table th {
    @apply bg-gray-100 dark:bg-gray-800;
}

.image {
    @apply h-16 w-16;
}

.actions {
    @apply flex gap-2;
}
</style>
