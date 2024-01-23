<script setup lang="ts">
import { Product } from '@/types'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Link, Head } from '@inertiajs/vue3'
import ActionIcons from '@/Components/Molecules/ActionIcons.vue'
import Pagination from '@/Components/Molecules/Pagination.vue'

const { products } = defineProps<{
    products: {
        data: Product[]
        current_page: number
        last_page: number
        prev_page_url: string | null
        next_page_url: string | null
    }
}>()
</script>

<template>
    <Head title="All Products" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2
                    class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
                >
                    All Products
                </h2>
                <Link
                    :href="route('products.create')"
                    class="focus:shadow-outline-blue rounded-lg border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 hover:bg-blue-700 focus:outline-none active:bg-blue-600"
                    >Add New Product</Link
                >
            </div>
        </template>

        <div v-if="!products.data.length" class="flex flex-col gap-4">
            <h3 class="text-xl font-bold dark:text-white">
                No products found.
            </h3>
            <Link
                class="hover:underline dark:text-white"
                :href="route('products.create')"
                >Add a product</Link
            >
        </div>

        <div v-else>
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>SKU</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="product in products.data" :key="product.id">
                        <td>
                            <Link
                                class="hover:underline"
                                :href="route('products.show', product.id)"
                                >{{ product.name }}</Link
                            >
                        </td>
                        <td>{{ product.sku }}</td>
                        <td>
                            <img
                                :alt="product.name"
                                :src="product.image"
                                class="image"
                                loading="lazy"
                            />
                        </td>
                        <td>{{ product.description }}</td>
                        <td>${{ product.price }}</td>
                        <td>{{ product.quantity }}</td>
                        <td>
                            <ActionIcons
                                :entity-id="product.id"
                                view-route="products.show"
                                edit-route="products.edit"
                                delete-route="products.destroy"
                            />
                        </td>
                    </tr>
                </tbody>
            </table>
            <Pagination :pagination-data="products" />
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

    .image {
        @apply h-16 w-16;
    }
}
</style>
