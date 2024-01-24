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
    id: order ? order.id : 0,
    billing_address: order ? order.billing_address : '',
    credit_card_last_four: order ? order.credit_card_last_four : '',
    credit_card_type: order ? order.credit_card_type : '',
    customer_id: order ? order.customer_id : 0,
    customer_note: order ? order?.customer_note : '',
    product_id: order ? order.product_id : 0,
    quantity: order ? order.quantity : 0,
    shipping_address: order ? order.shipping_address : '',
    status: order ? order.status : '',
    total_amount: order ? order.total_amount : 0
})

// Set the form action based on the action.
const formAction = action === 'post' ? 'post' : 'patch'

// Set the form URL based on the action.
const url = formAction === 'post' ? '/orders' : `/orders/${order.id}`

// Define the allowed HTML tags for the description field.
const allowedHTMLTags = ['b', 'i', 'em', 'strong', 'a', 'br', 'p', 'ul', 'li']

// Success message state.
const successMessage = ref('')

// Define the computed property for form validation.
const isFormValid = computed(() => {
    return form.status
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
    form.status = sanitizeInput(form.status)
    form.customer_note = sanitizeInput(
        form.customer_note ? form.customer_note : '',
        allowedHTMLTags
    )

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
            <!-- Hide uneditable fields -->
            <input v-model="form.id" type="hidden" />
            <input v-model="form.billing_address" type="hidden" />
            <input v-model="form.credit_card_last_four" type="hidden" />
            <input v-model="form.credit_card_type" type="hidden" />
            <input v-model="form.customer_id" type="hidden" />
            <input v-model="form.product_id" type="hidden" />
            <input v-model="form.quantity" type="hidden" />
            <input v-model="form.shipping_address" type="hidden" />
            <input v-model="form.total_amount" type="hidden" />

            <!-- Order status input -->
            <div class="field">
                <label class="label" for="status"
                    >Order Status<span class="required">*</span></label
                >
                <select id="status" v-model="form.status" required>
                    <option value="" disabled>Select Status</option>
                    <option value="completed">Completed</option>
                    <option value="shipped">Shipped</option>
                    <option value="pending">Pending</option>
                </select>
                <p class="description">Please select the order status.</p>
            </div>
            <!-- Customer note input -->
            <div class="field">
                <label class="label" for="description"
                    >Customer Note<span class="required">*</span></label
                >
                <textarea
                    id="description"
                    v-model="form.customer_note"
                    type="text"
                    placeholder="Enter the customer note."
                    required
                    rows="6"
                />
                <p class="description">
                    Please enter the customer note. Basic HTML is allowed.
                </p>
            </div>
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

    .required {
        @apply text-red-800;
    }
}
</style>
