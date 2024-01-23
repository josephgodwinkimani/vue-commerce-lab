<script setup lang="ts">
import { Customer } from '@/types'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
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

        <div class="bg-white shadow-md">
            <div class="md:flex">
                <div class="p-8">
                    <div
                        class="text-sm font-semibold uppercase tracking-wide text-indigo-500"
                    >
                        {{ customer.name }}
                    </div>
                    <p
                        class="mt-1 block text-lg font-medium leading-tight text-black"
                    >
                        {{ customer.email }}
                    </p>
                    <p class="mt-2 text-gray-500">
                        Phone: {{ customer.phone }}
                    </p>
                    <p class="text-gray-500">
                        Address: {{ customer.address }}, {{ customer.city }},
                        {{ customer.state }},
                        {{ customer.zip }}
                    </p>
                </div>
            </div>
            <div v-if="customer.orders.length" class="border-t border-gray-200">
                <dl>
                    <div
                        class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                    >
                        <dt class="text-sm font-medium text-gray-500">
                            Orders
                        </dt>
                        <dd
                            class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0"
                        >
                            <ul
                                class="divide-y divide-gray-200 rounded-md border border-gray-200"
                            >
                                <li
                                    v-for="order in customer.orders"
                                    :key="order.id"
                                    class="flex items-center justify-between py-3 pl-3 pr-4 text-sm"
                                >
                                    <div class="flex w-0 flex-1 items-center">
                                        <span class="ml-2 w-0 flex-1 truncate"
                                            >Order ID: {{ order.id }}</span
                                        >
                                    </div>
                                    <div class="flex-shrink-0">
                                        <Link
                                            :href="
                                                route('orders.show', order.id)
                                            "
                                            class="font-medium text-indigo-600 hover:text-indigo-500"
                                            >View Order</Link
                                        >
                                    </div>
                                </li>
                            </ul>
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
