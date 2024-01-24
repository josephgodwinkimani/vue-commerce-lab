<script setup lang="ts">
import FormOrder from '@/Components/Organisms/FormOrder.vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Order } from '@/types'
import { Head, Link } from '@inertiajs/vue3'
import { computed, ref } from 'vue'

const { order } = defineProps<{
    order: Order
}>()

// Create a ref for the FormOrder component.
const orderFormRef = ref()

// Create a ref for the saved state.
const saved = ref(false)

// Define the cancelOrDone computed property.
const cancelOrDone = computed(() => {
    return saved.value ? route('orders.index') : route('orders.show', order.id)
})

// Calls the submitForm method in orderForm.
function saveOrder() {
    if (orderFormRef.value) {
        orderFormRef.value.submitForm()
        saved.value = true
    }
}
</script>

<template>
    <Head :title="`Edit Order ID: ${order.id}`" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2
                    class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
                >
                    Edit Order ID: {{ order.id }}
                </h2>
                <div class="flex gap-4">
                    <button
                        class="focus:shadow-outline-blue rounded-lg border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 hover:bg-blue-700 focus:outline-none active:bg-blue-600"
                        @click="saveOrder"
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
            <FormOrder ref="orderFormRef" :order="order" action="patch" />
        </div>
    </AuthenticatedLayout>
</template>
