<script setup lang="ts">
import { Order } from '@/types'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Link, Head } from '@inertiajs/vue3'
import { formatDate } from '@/utils'

// Define page props.
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
            </div>
        </template>

        <!-- If there are no orders -->
        <div v-if="!orders.data.length" class="flex flex-col gap-4">
            <h3 class="text-xl font-bold dark:text-white">No orders found.</h3>
        </div>

        <!-- If there are orders -->
        <div v-else>
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Status</th>
                        <th>Customer</th>
                        <th>Date</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="order in orders.data" :key="order.id">
                        <td>
                            <Link
                                class="hover:underline"
                                :href="route('orders.show', order.id)"
                                >{{ order.id }}</Link
                            >
                        </td>
                        <td>{{ order.status }}</td>
                        <td>{{ order.customer_id }}</td>
                        <td>{{ formatDate(order.created_at) }}</td>
                        <td>{{ order.quantity }}</td>
                        <td>${{ order.total_amount }}</td>
                        <td>
                            <Link
                                class="hover:underline"
                                :href="route('orders.show', order.id)"
                                ><font-awesome-icon :icon="['fas', 'eye']"
                            /></Link>
                            |
                            <Link
                                class="hover:underline"
                                :href="route('orders.edit', order.id)"
                                ><font-awesome-icon
                                    :icon="['fas', 'pen-to-square']"
                            /></Link>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="pagination">
                <Link v-if="orders.prev_page_url" :href="orders.prev_page_url"
                    ><font-awesome-icon :icon="['fas', 'fa-angle-left']"
                /></Link>
                <span class="text-base"
                    >Page {{ orders.current_page }} of
                    {{ orders.last_page }}</span
                >
                <Link v-if="orders.next_page_url" :href="orders.next_page_url"
                    ><font-awesome-icon :icon="['fas', 'fa-angle-right']"
                /></Link>
            </div>
        </div>
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

.pagination {
    @apply mt-4 flex items-center justify-center gap-4 text-2xl dark:text-white;
}
</style>
