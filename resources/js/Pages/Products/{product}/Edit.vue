<script setup lang="ts">
import FormProduct from '@/Components/Organisms/FormProduct.vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Product } from '@/types'
import { Head, Link } from '@inertiajs/vue3'
import { computed, ref } from 'vue'

// Define page props.
const { product } = defineProps<{
    product: Product
}>()

// Create a ref for the ProductForm component.
const productFormRef = ref()

// Create a ref for the saved state.
const saved = ref(false)

// Define the cancelOrDone computed property.
const cancelOrDone = computed(() => {
    return saved.value
        ? route('products.index')
        : route('products.show', product.id)
})

// Calls the submitForm method in ProductForm.
function saveProduct() {
    if (productFormRef.value) {
        productFormRef.value.submitForm()
        saved.value = true
    }
}
</script>

<template>
    <Head :title="`Edit Product: ${product.name}`" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2
                    class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
                >
                    Edit Product: {{ product.name }}
                </h2>
                <div class="flex gap-4">
                    <button
                        class="focus:shadow-outline-blue rounded-lg border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 hover:bg-blue-700 focus:outline-none active:bg-blue-600"
                        @click="saveProduct"
                    >
                        Save
                    </button>
                    <Link
                        :href="cancelOrDone"
                        class="focus:shadow-outline-blue rounded-lg border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 hover:bg-blue-700 focus:outline-none active:bg-blue-600"
                    >
                        <span v-if="saved">Done</span
                        ><span v-else>Cancel</span></Link
                    >
                </div>
            </div>
        </template>
        <div>
            <FormProduct
                ref="productFormRef"
                :product="product"
                action="patch"
            />
        </div>
    </AuthenticatedLayout>
</template>
