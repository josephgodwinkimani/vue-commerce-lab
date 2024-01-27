<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { OrderStatus } from '@/types'
import { Head } from '@inertiajs/vue3'

const { orderStatusCounts } = defineProps<{
    orderStatusCounts: OrderStatus[]
}>()
</script>

<template>
    <Head title="Report: Order Status" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2
                    class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
                >
                    Report: Order Status
                </h2>
            </div>
        </template>

        <div v-if="!orderStatusCounts.length" class="flex flex-col gap-4">
            <h3 class="text-xl font-bold dark:text-white">No orders found.</h3>
        </div>

        <div v-else>
            <table class="table">
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="order in orderStatusCounts" :key="order.id">
                        <td>{{ order.status }}</td>
                        <td>{{ order.total }}</td>
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
