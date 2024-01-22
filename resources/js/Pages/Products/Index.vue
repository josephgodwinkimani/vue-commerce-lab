<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Link, Head } from '@inertiajs/vue3'

// Define page props.
const { products } = defineProps<{
    products: {
        id: number
        name: string
        sku: string
        description: string
        price: number
        quantity: number
        image: string
        user_id: number
        created_at: string
        updated_at: string
    }[]
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
                    :href="route('products.add')"
                    class="focus:shadow-outline-blue rounded-lg border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 hover:bg-blue-700 focus:outline-none active:bg-blue-600"
                    >Add New Product</Link
                >
            </div>
        </template>

        <!-- If there are no products -->
        <div v-if="!products.length" class="flex flex-col gap-4">
            <h3 class="text-xl font-bold dark:text-white">
                No products found.
            </h3>
            <Link
                class="hover:underline dark:text-white"
                :href="route('products.add')"
                >Add a product</Link
            >
        </div>

        <!-- No Products -->
        <div v-if="!products.length" class="no-products">
            <h3>No products found.</h3>
            <Link :href="route('products.add')">Add a product</Link>
        </div>

        <!-- Products Table -->
        <table v-else class="products-table">
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
                <tr v-for="product in products" :key="product.id">
                    <td>
                        <Link
                            class="hover:underline"
                            :href="route('products.view', product.id)"
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
                        <Link
                            class="hover:underline"
                            :href="route('products.view', product.id)"
                            >View</Link
                        >
                        |
                        <Link
                            class="hover:underline"
                            :href="route('products.edit', product.id)"
                            >Edit</Link
                        >
                    </td>
                </tr>
            </tbody>
        </table>
    </AuthenticatedLayout>
</template>

<style scoped>
.products-table {
    @apply w-full border-collapse dark:text-white;
}

.products-table th,
.products-table td {
    @apply p-4 text-left dark:bg-gray-700;
}

.products-table th {
    @apply bg-gray-100 dark:bg-gray-800;
}

.image {
    @apply h-16 w-16;
}

.actions {
    @apply flex gap-2;
}
</style>
