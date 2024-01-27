<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Customer } from '@/types'
import { formatCurrency, formatNumber } from '@/utils'
import { Head, Link } from '@inertiajs/vue3'

const { bestCustomers } = defineProps<{
    bestCustomers: Customer[]
}>()
</script>

<template>
    <Head title="Report: Best Customers" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Report: Best Customers
            </h2>
        </template>

        <div v-if="!bestCustomers.length" class="flex flex-col gap-4">
            <h3 class="text-xl font-bold dark:text-white">
                No Best Customers found.
            </h3>
        </div>

        <div v-else>
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Orders</th>
                        <th>Total Revenue</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="customer in bestCustomers" :key="customer.id">
                        <td>
                            <Link
                                :href="route('customers.show', customer.id)"
                                >{{ customer.name }}</Link
                            >
                        </td>
                        <td>{{ formatNumber(customer.lifetime_orders) }}</td>
                        <td>{{ formatCurrency(customer.lifetime_revenue) }}</td>
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
</style>
