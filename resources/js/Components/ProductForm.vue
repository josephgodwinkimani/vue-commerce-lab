<script setup lang="ts">
import { Product } from '@/types'
import { useForm } from '@inertiajs/vue3'
import { computed } from 'vue'
import DOMPurify from 'dompurify'
import { ref } from 'vue'

// Define component props.
const { product, action, errors } = defineProps({
    product: {
        type: Object as () => Product,
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
    name: product ? product.name : '',
    sku: product ? product.sku : '',
    description: product ? product.description : '',
    price: product ? product.price : '',
    quantity: product ? product.quantity : '',
    image: product ? product.image : ''
})

// Set the form action based on the action.
const formAction = action === 'post' ? 'post' : 'patch'

// Set the form URL based on the action.
const url =
    formAction === 'post' ? '/products/create' : `/products/${product.id}/edit`

// Define the allowed HTML tags for the description field.
const allowedHTMLTags = ['b', 'i', 'em', 'strong', 'a', 'br', 'p', 'ul', 'li']

// Success message state.
const successMessage = ref('')

// Define the computed property for form validation.
const isFormValid = computed(() => {
    return (
        form.name &&
        form.sku &&
        form.description &&
        form.price &&
        form.quantity &&
        form.image
    )
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
    form.name = sanitizeInput(form.name)
    form.sku = sanitizeInput(form.sku)
    form.description = sanitizeInput(form.description, allowedHTMLTags)
    form.image = sanitizeInput(form.image)

    // Send the form data.
    form[formAction](url, {
        preserveScroll: true,
        onSuccess: () => {
            successMessage.value = `${product.name} has been saved successfully.`
        },
        onError: () => {
            successMessage.value = ''
        }
    })
}

/**
 * Sanitize form fields.
 *
 * @param value The value to sanitize.
 * @param allowedTags Optional allowed tags for sanitizing HTML content.
 *
 * @returns The sanitized string.
 */
function sanitizeInput(value: string, allowedTags: string[] = []): string {
    return DOMPurify.sanitize(value, { ALLOWED_TAGS: allowedTags })
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
            <!-- Product name input -->
            <div class="field">
                <label class="label" for="name"
                    >Product Name<span class="required">*</span></label
                >
                <input
                    id="name"
                    v-model="form.name"
                    type="text"
                    placeholder="Product Name"
                    required
                />
                <p class="description">
                    Please enter the name. HTML is not allowed.
                </p>
            </div>
            <!-- Product SKU input -->
            <div class="field">
                <label class="label" for="sku"
                    >Product SKU<span class="required">*</span></label
                >
                <input
                    id="sku"
                    v-model="form.sku"
                    type="text"
                    placeholder="Product SKU"
                    required
                />
                <p class="description">
                    Please enter the SKU. This must be unique.
                </p>
            </div>
            <!-- Product description input -->
            <div class="field">
                <label class="label" for="description"
                    >Product Description<span class="required">*</span></label
                >
                <textarea
                    id="description"
                    v-model="form.description"
                    type="text"
                    placeholder="Product Description"
                    required
                    rows="6"
                />
                <p class="description">
                    Please enter the description. Basic HTML is allowed.
                </p>
            </div>
            <!-- Product price input -->
            <div class="field">
                <label class="label" for="price"
                    >Product Price<span class="required">*</span></label
                >
                <input
                    id="price"
                    v-model="form.price"
                    type="number"
                    placeholder="100.00"
                    required
                    step="0.01"
                />
                <p class="description">
                    Please enter the price in US Dollars (e.g., 100.00).
                </p>
            </div>
            <!-- Product quantity input -->
            <div class="field">
                <label class="label" for="quantity"
                    >Product Quantity<span class="required">*</span></label
                >
                <input
                    id="quantity"
                    v-model="form.quantity"
                    type="number"
                    placeholder="100"
                    required
                />
                <p class="description">
                    Please enter the quantity (e.g., 100).
                </p>
            </div>
            <!-- Product image input -->
            <div class="field">
                <label class="label" for="image"
                    >Product Image<span class="required">*</span></label
                >
                <input id="image" v-model="form.image" type="url" required />
                <p class="description">
                    Please enter the full URL to an image. (e.g.,
                    https://via.placeholder.com/640x480.png/001199)
                </p>
            </div>
            <!-- Preview the image if it exists -->
            <div v-if="form.image">
                <p>Image preview:</p>
                <img
                    :src="form.image"
                    alt="Product Image"
                    class="preview-image"
                />
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
