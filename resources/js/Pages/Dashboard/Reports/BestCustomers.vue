<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Customer } from '@/types'
import { Head } from '@inertiajs/vue3'

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
        <section class="flex gap-8">
            <h2>Best Customers</h2>
        </section>
        <pre>{{ JSON.stringify(bestCustomers, null, 2) }}</pre>
    </AuthenticatedLayout>
</template>

<style scoped></style>
