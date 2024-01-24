<script setup lang="ts">
import ActionIcons from '@/Components/Molecules/ActionIcons.vue'
import Pagination from '@/Components/Molecules/Pagination.vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Customer } from '@/types'
import { Head, Link } from '@inertiajs/vue3'

const { customers } = defineProps<{
    customers: {
        data: Customer[]
        current_page: number
        last_page: number
        prev_page_url: string | null
        next_page_url: string | null
    }
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

        <div v-if="!customers.data.length" class="flex flex-col gap-4">
            <h3 class="text-xl font-bold dark:text-white">
                No customers found.
            </h3>
            <Link
                class="hover:underline dark:text-white"
                :href="route('customers.create')"
                >Add a customer</Link
            >
        </div>

        <div v-else>
            <table class="table">
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
                    <tr v-for="customer in customers.data" :key="customer.id">
                        <td>
                            <Link
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
                            <ActionIcons
                                :entity-id="customer.id"
                                view-route="customers.show"
                                edit-route="customers.edit"
                                delete-route="customers.destroy"
                            />
                        </td>
                    </tr>
                </tbody>
            </table>
            <Pagination :pagination-data="customers" />
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

    a {
        @apply text-blue-500 underline hover:no-underline;
    }
}
</style>
