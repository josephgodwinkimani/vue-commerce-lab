<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'

// Define page props.
const { customer } = defineProps<{
    customer: {
        id: number
        name: string
        email: string
        phone: string
        address: string
        city: string
        state: string
        zip: string
    }
}>()

// Init form.
const form = useForm({ customer })

// Destroy the product.
function destroy(id: number) {
    if (
        confirm('Are you sure you want to delete? This action is irreversible!')
    ) {
        form.delete(route('customer.destroy', id))
    }
}
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
                        :href="route('customer.index')"
                        class="focus:shadow-outline-blue rounded-lg border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 hover:bg-blue-700 focus:outline-none active:bg-blue-600"
                        >Go Back</Link
                    >
                    <Link
                        :href="route('customer.edit', customer.id)"
                        class="focus:shadow-outline-blue rounded-lg border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 hover:bg-blue-700 focus:outline-none active:bg-blue-600"
                        >Edit Customer</Link
                    >
                    <button
                        class="focus:shadow-outline-red rounded-lg border border-transparent bg-red-600 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 hover:bg-red-700 focus:outline-none active:bg-red-600"
                        @click="destroy(customer.id)"
                    >
                        Delete
                    </button>
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
