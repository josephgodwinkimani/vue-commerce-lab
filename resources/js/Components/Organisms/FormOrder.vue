<script setup lang="ts">
import { Order } from '@/types'
import { sanitizeInput } from '@/utils'
import { useForm } from '@inertiajs/vue3'
import { computed, ref } from 'vue'

// Define component props.
const { order, action, errors } = defineProps({
    order: {
        type: Object as () => Order,
        default: null
    },
    action: {
        type: String,
        default: 'post',
        validator: (value: string) => {
            return ['post', 'patch'].includes(value)
        }
    },
    errors: {
        type: Object,
        default: null
    }
})

// Initialize the form.
const form = useForm({
    billingAddress: order ? order.billing_address : '',
    creditCardLateFour: order ? order.credit_card_late_four : '',
    creditCardType: order ? order.credit_card_type : '',
    customerId: order ? order.customer_id : 0,
    customerNote: order ? order.customer_note : '',
    productId: order ? order.product_id : 0,
    quantity: order ? order.quantity : 0,
    shippingAddress: order ? order.shipping_address : '',
    status: order ? order.status : '',
    totalAmount: order ? order.total_amount : 0
})

// Set the form action based on the action.
const formAction = action === 'post' ? 'post' : 'patch'

// Set the form URL based on the action.
const url = formAction === 'post' ? '/orders' : `/orders/${order.id}/edit`

// Success message state.
const successMessage = ref('')

// Define the computed property for form validation.
const isFormValid = computed(() => {
    return form.status && form.totalAmount // Add other necessary validations
})

// Allow access to the submitForm function from the parent component.
defineExpose({ submitForm })

/**
 * Form submission handler.
 *
 * @returns void
 */
function submitForm(): void {
    // Return if the form is not valid.
    if (!isFormValid.value) {
        alert('Please fill in all required fields.')
        return
    }

    // Sanitize individual form fields.
    form.billingAddress = sanitizeInput(form.billingAddress)
    form.creditCardLateFour = sanitizeInput(form.creditCardLateFour)
    form.creditCardType = sanitizeInput(form.creditCardType)
    form.shippingAddress = sanitizeInput(form.shippingAddress)
    form.status = sanitizeInput(form.status)

    // Send the form data.
    form[formAction](url, {
        preserveScroll: true,
        onSuccess: () => {
            successMessage.value = `Order has been saved successfully.`
        },
        onError: () => {
            successMessage.value = ''
        }
    })
}
</script>

<template>
    <section class="flex flex-col gap-6">
        <!-- Display success message -->
        <div v-if="successMessage" class="success-message">
            {{ successMessage }}
        </div>

        <!-- Display error messages -->
        <div v-if="errors" class="error-message">
            <p>Please fix the following errors:</p>
            <ul>
                <li v-for="error in errors" :key="error">
                    {{ error }}
                </li>
            </ul>
        </div>

        <form class="form" @submit.prevent="submitForm">
            <!-- Order status input -->
            <div class="field">
                <label class="label" for="status"
                    >Order Status<span class="required">*</span></label
                >
                <input
                    id="status"
                    v-model="form.status"
                    type="text"
                    placeholder="Order Status"
                    required
                />
                <p class="description">Please enter the order status.</p>
            </div>

            <!-- Order total amount input -->
            <div class="field">
                <label class="label" for="totalAmount"
                    >Total Amount<span class="required">*</span></label
                >
                <input
                    id="totalAmount"
                    v-model.number="form.totalAmount"
                    type="number"
                    placeholder="0.00"
                    required
                />
                <p class="description">Please enter the total amount.</p>
            </div>

            <!-- Add other order fields here -->
        </form>
    </section>
</template>

<style scoped>
.title {
    @apply text-lg font-semibold leading-tight text-gray-800 dark:text-gray-200;
}

.success-message {
    @apply text-lg font-semibold leading-tight text-green-600;
}

.error-message {
    @apply text-lg font-semibold leading-tight text-red-800;
}

.form {
    @apply flex flex-col gap-6 dark:text-white;

    .label {
        @apply pb-1 text-lg font-semibold dark:text-white;
    }

    .field {
        @apply flex flex-col dark:text-black;
    }

    .description {
        @apply pt-2 text-sm italic text-gray-600 dark:text-white;
    }

    .preview-image {
        @apply h-32 w-32 rounded-md object-cover;
    }

    .required {
        @apply text-red-800;
    }

    .delete-image {
        @apply mt-2 text-sm text-red-800;
    }
}
</style>
