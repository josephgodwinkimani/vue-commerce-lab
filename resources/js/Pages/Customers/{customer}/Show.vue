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
        <div class="flex gap-4 dark:text-white">
            {{ customer.name }}
            {{ customer.email }}
            {{ customer.phone }}
            {{ customer.address }}
            {{ customer.city }}
            {{ customer.state }}
            {{ customer.zip }}
        </div>
    </AuthenticatedLayout>
</template>
