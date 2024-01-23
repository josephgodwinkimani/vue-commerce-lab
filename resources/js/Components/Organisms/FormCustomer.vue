<script setup lang="ts">
import { Customer } from '@/types'
import { sanitizeInput } from '@/utils'
import { useForm } from '@inertiajs/vue3'
import { computed, ref } from 'vue'

// Define component props.
const { customer, action, errors } = defineProps({
    customer: {
        type: Object as () => Customer,
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
    name: customer ? customer.name : '',
    email: customer ? customer.email : '',
    phone: customer ? customer.phone : '',
    address: customer ? customer.address : '',
    city: customer ? customer.city : '',
    state: customer ? customer.state : '',
    zip: customer ? customer.zip : ''
})

// Set the form action based on the action.
const formAction = action === 'post' ? 'post' : 'patch'

// Set the form URL based on the action.
const url =
    formAction === 'post'
        ? '/customers/create'
        : `/customers/${customer.id}/edit`

// Success message state.
const successMessage = ref('')

// Define the computed property for form validation.
const isFormValid = computed(() => {
    return (
        form.name &&
        form.email &&
        form.phone &&
        form.address &&
        form.city &&
        form.state &&
        form.zip
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
    form.email = sanitizeInput(form.email)
    form.phone = sanitizeInput(form.phone)
    form.address = sanitizeInput(form.address)
    form.city = sanitizeInput(form.city)
    form.state = sanitizeInput(form.state)
    form.zip = sanitizeInput(form.zip)

    // Send the form data.
    form[formAction](url, {
        preserveScroll: true,
        onSuccess: () => {
            successMessage.value = `${customer.name} has been saved successfully.`
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
            <!-- Customer name input -->
            <div class="field">
                <label class="label" for="name"
                    >Customer Name<span class="required">*</span></label
                >
                <input
                    id="name"
                    v-model="form.name"
                    type="text"
                    placeholder="Full Name"
                    required
                />
                <p class="description">Please enter the name.</p>
            </div>
            <!-- Customer email input -->
            <div class="field">
                <label class="label" for="email"
                    >Customer email<span class="required">*</span></label
                >
                <input
                    id="email"
                    v-model="form.email"
                    type="email"
                    placeholder="text@example.com"
                    required
                />
                <p class="description">Please enter the email.</p>
            </div>
            <!-- Customer phone input -->
            <div class="field">
                <label class="label" for="phone"
                    >Customer Phone<span class="required">*</span></label
                >
                <input
                    id="phone"
                    v-model="form.phone"
                    type="text"
                    placeholder="(123) 456-7890"
                    required
                />
                <p class="description">Please enter the phone number.</p>
            </div>
            <!-- Customer address input -->
            <div class="field">
                <label class="label" for="address"
                    >Customer Address<span class="required">*</span></label
                >
                <input
                    id="address"
                    v-model="form.address"
                    type="text"
                    placeholder="123 Main St."
                    required
                />
                <p class="description">Please enter the address.</p>
            </div>
            <!-- Customer city input -->
            <div class="field">
                <label class="label" for="city"
                    >Customer City<span class="required">*</span></label
                >
                <input
                    id="city"
                    v-model="form.city"
                    type="text"
                    placeholder="Anytown"
                    required
                />
                <p class="description">Please enter the city.</p>
            </div>
            <!-- Customer state input -->
            <div class="field">
                <label class="label" for="state"
                    >Customer State<span class="required">*</span></label
                >
                <input
                    id="state"
                    v-model="form.state"
                    type="text"
                    placeholder="AL"
                    required
                />
                <p class="description">Please enter the abbrevated state.</p>
            </div>
            <!-- Customer zip input -->
            <div class="field">
                <label class="label" for="zip"
                    >Customer Zip<span class="required">*</span></label
                >
                <input
                    id="zip"
                    v-model="form.zip"
                    type="text"
                    placeholder="12345"
                    required
                />
                <p class="description">Please enter the zip code.</p>
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
