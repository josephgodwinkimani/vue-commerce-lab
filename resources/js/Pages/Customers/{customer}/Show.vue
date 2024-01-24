<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Customer } from '@/types'
import { Head, Link } from '@inertiajs/vue3'

const { customer } = defineProps<{
    customer: Customer
}>()
</script>

<template>
    <Head :title="`Viewing: ${customer.name}`" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2
                    class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
                >
                    Viewing: {{ customer.name }}
                </h2>
                <div class="flex gap-4">
                    <Link
                        :href="route('customers.edit', customer.id)"
                        class="focus:shadow-outline-blue rounded-lg border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 hover:bg-blue-700 focus:outline-none active:bg-blue-600"
                        >Edit Customer</Link
                    >
                    <Link
                        :href="route('customers.index')"
                        class="focus:shadow-outline-blue rounded-lg border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 hover:bg-blue-700 focus:outline-none active:bg-blue-600"
                        >All Customers</Link
                    >
                </div>
            </div>
        </template>

        <div class="customer">
            <p><span>Name:</span> {{ customer.name }}</p>
            <p><span>Email:</span> {{ customer.email }}</p>
            <p><span>Phone:</span> {{ customer.phone }}</p>
            <p>
                <span>Address:</span> {{ customer.address }},
                {{ customer.city }}, {{ customer.state }},
                {{ customer.zip }}
            </p>

            <div v-if="customer.orders.length">
                <div>
                    <span>Recent Orders</span>
                    <ol>
                        <li v-for="order in customer.orders" :key="order.id">
                            <span
                                >Order ID:
                                <Link :href="route('orders.show', order.id)">{{
                                    order.id
                                }}</Link></span
                            >
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
.customer {
    @apply bg-white p-8 shadow dark:bg-gray-800 dark:text-white;

    p {
        @apply mb-2;
    }

    span {
        @apply font-semibold;
    }

    a {
        @apply text-blue-500 underline hover:no-underline;
    }

    ol {
        @apply mt-2 list-inside list-decimal;
    }
}
</style>
