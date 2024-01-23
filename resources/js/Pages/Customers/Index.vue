<script setup lang="ts">
import { Customer } from '@/types'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Link, Head } from '@inertiajs/vue3'

// Define page props.
const { customers } = defineProps<{
    customers: Customer[]
}>()
</script>

<template>
    <Head title="All Cusomters" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2
                    class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
                >
                    All Customers
                </h2>
                <Link
                    :href="route('customers.create')"
                    class="focus:shadow-outline-blue rounded-lg border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 hover:bg-blue-700 focus:outline-none active:bg-blue-600"
                    >Add New Customer</Link
                >
            </div>
        </template>

        <!-- If there are no customers -->
        <div v-if="!customers.length" class="flex flex-col gap-4">
            <h3 class="text-xl font-bold dark:text-white">
                No customers found.
            </h3>
            <Link
                class="hover:underline dark:text-white"
                :href="route('customers.create')"
                >Add a customer</Link
            >
        </div>

        <!-- Customers Table -->
        <table v-else class="customers-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Zip</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="customer in customers" :key="customer.id">
                    <td>
                        <Link
                            class="hover:underline"
                            :href="route('customers.show', customer.id)"
                            >{{ customer.name }}</Link
                        >
                    </td>
                    <td>{{ customer.email }}</td>
                    <td>{{ customer.phone }}</td>
                    <td>{{ customer.address }}</td>
                    <td>{{ customer.city }}</td>
                    <td>{{ customer.state }}</td>
                    <td>{{ customer.zip }}</td>
                    <td>
                        <Link
                            class="hover:underline"
                            :href="route('customers.show', customer.id)"
                            >View</Link
                        >
                        |
                        <Link
                            class="hover:underline"
                            :href="route('customers.edit', customer.id)"
                            >Edit</Link
                        >
                    </td>
                </tr>
            </tbody>
        </table>
    </AuthenticatedLayout>
</template>

<style scoped>
.customers-table {
    @apply w-full border-collapse dark:text-white;
}

.customers-table th,
.customers-table td {
    @apply p-4 text-left dark:bg-gray-700;
}

.customers-table th {
    @apply bg-gray-100 dark:bg-gray-800;
}

.image {
    @apply h-16 w-16;
}

.actions {
    @apply flex gap-2;
}
</style>
