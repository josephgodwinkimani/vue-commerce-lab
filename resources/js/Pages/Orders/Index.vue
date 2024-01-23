<script setup lang="ts">
import ActionIcons from '@/Components/Molecules/ActionIcons.vue'
import Pagination from '@/Components/Molecules/Pagination.vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Order } from '@/types'
import { formatDate } from '@/utils'
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
                            <ActionIcons
                                :entity-id="order.id"
                                view-route="orders.show"
                                edit-route="orders.edit"
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
    @apply w-full border-collapse dark:text-white;

    th,
    td {
        @apply p-4 text-left dark:bg-gray-700;
    }

    th {
        @apply bg-gray-100 dark:bg-gray-800;
    }
}
</style>
