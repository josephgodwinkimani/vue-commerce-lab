<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Product } from '@/types'
import { Head } from '@inertiajs/vue3'

const { bestSellingProducts } = defineProps<{
    bestSellingProducts: Product[]
}>()
</script>

<template>
    <Head title="Report: Best Sellers" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Report: Best Sellers
            </h2>
        </template>
        <section class="flex gap-8">
            <h2>Best Sellers</h2>
        </section>
        <pre>{{ JSON.stringify(bestSellingProducts, null, 2) }}</pre>
    </AuthenticatedLayout>
</template>

<style scoped></style>
