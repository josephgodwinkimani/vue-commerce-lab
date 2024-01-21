<script setup lang="ts">
import { useForm } from '@inertiajs/vue3'
import Button from './Button.vue'
import { computed } from 'vue'
import DOMPurify from 'dompurify'
import { ref } from 'vue'

// Set form shape and initial values.
const form = useForm({
    name: '',
    description: '',
    price: '',
    image: null as File | null
})

// Image preview ref.
const previewImage = ref<string | null>(null)

// Define the allowed HTML tags for the description field.
const allowedHTMLTags = ['b', 'i', 'em', 'strong', 'a', 'br', 'p', 'ul', 'li']

// Store submission state.
const isSubmitted = ref(false)

// Store form message state.
const formMessage = ref('')

// Define the computed property for form validation.
const isFormValid = computed(() => {
    return form.name && form.description && form.price && form.image
})

/**
 * Form submission handler.
 *
 * @returns void
 */
function submitForm(): void {
    // Sanitize individual form fields.
    form.name = sanitizeInput(form.name)
    form.description = sanitizeInput(form.description, allowedHTMLTags)
    form.price = sanitizeInput(form.price)

    // Post the sanitized form data.
    form.post('/products', {
        onSuccess: () => {
            // Reset the form.
            form.reset()
            // Reset the image preview.
            previewImage.value = null
            // Set the success message.
            formMessage.value = 'Product added successfully!'
            // Set the submission state.
            isSubmitted.value = true
            // Reset the submission state after 3 seconds.
            setTimeout(() => {
                isSubmitted.value = false
                formMessage.value = ''
            }, 3000)
        },
        onError: () => {
            // Set the success message.
            formMessage.value = 'There was an error adding the product.'
            // Set the submission state.
            isSubmitted.value = true
        }
    })
}

/**
 * Handle file change event.
 *
 * @param event The file change event.
 *
 * @returns void
 */
async function onFileChange(event: Event): Promise<void> {
    // Get the file input element from the event.
    const input = event.target as HTMLInputElement

    // Return if no file is selected.
    if (!input.files || input.files.length === 0) return

    // Get the first file from the FileList object.
    const file = input.files[0]

    // Define the allowed image types
    const validImageTypes = ['image/jpeg', 'image/png']

    // Check if the file is one of the valid image types.
    if (!validImageTypes.includes(file.type)) {
        alert('Please select a valid image file (JPG or PNG).')
        return
    }

    // Check if the image size is at least 300x300 pixels.
    const isSizeValid = await checkImageSize(file)
    if (!isSizeValid) {
        alert('The image size must be at least 300x300 pixels.')
        return
    }

    // Read the file as a data URL for preview.
    previewImage.value = await readFileAsDataURL(file)

    // Set the selected file in the form data.
    form.image = file
}

/**
 * Check if the image size meets the minimum requirements.
 *
 * @param file The file to check.
 *
 * @returns Promise<boolean>
 */
function checkImageSize(file: File): Promise<boolean> {
    return new Promise((resolve) => {
        const img = new Image()
        img.onload = () => {
            // Check the natural width and height of the image.
            const width = img.naturalWidth
            const height = img.naturalHeight
            // Resolve true if both width and height are at least 300 pixels.
            resolve(width >= 300 && height >= 300)
        }
        img.onerror = () => {
            // Resolve false if there's an error loading the image.
            resolve(false)
        }
        // Create a URL for the file and set it as the image source.
        img.src = URL.createObjectURL(file)
    })
}

/**
 * Read the file as a data URL.
 *
 * @param file The file to read.
 *
 * @returns Promise<string>
 */
function readFileAsDataURL(file: File): Promise<string> {
    return new Promise((resolve, reject) => {
        const reader = new FileReader()

        // Event listener for when file reading is completed.
        reader.onloadend = () => resolve(reader.result as string)

        // Error handling for file reading.
        reader.onerror = reject

        // Initiating the file reading process.
        reader.readAsDataURL(file)
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
        <h2 class="title">Add New Product</h2>
        <form class="form" @submit.prevent="submitForm">
            <div class="field">
                <label for="name"
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
                    Please enter the product name. HTML is not allowed.
                </p>
            </div>
            <div class="field">
                <label for="description"
                    >Product Description<span class="required">*</span></label
                >
                <textarea
                    id="description"
                    v-model="form.description"
                    type="text"
                    placeholder="Product Description"
                    required
                />
                <p class="description">
                    Please enter the product description. Basic HTML is allowed.
                </p>
            </div>
            <div class="field">
                <label for="price"
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
                    Please enter the product price in US Dollars (e.g. 100.00).
                </p>
            </div>
            <div class="field">
                <label class="pb-1" for="image"
                    >Product Image<span class="required">*</span></label
                >
                <input id="image" type="file" required @change="onFileChange" />
                <p class="description">
                    Please select an image file (JPG or PNG) with a minimum size
                    of 300x300 pixels.
                </p>
                <img v-if="previewImage" class="pt-2" :src="previewImage" />
            </div>
            <Button type="submit" :disabled="!isFormValid">Save</Button>

            <div v-if="formMessage">
                <p>{{ formMessage }}</p>
            </div>
        </form>
    </section>
</template>

<style scoped>
.title {
    @apply text-lg font-semibold leading-tight text-gray-800 dark:text-gray-200;
}

.form {
    @apply flex flex-col gap-6;

    .field {
        @apply flex flex-col;
    }

    .description {
        @apply pt-2 text-sm italic text-gray-600;
    }

    .required {
        @apply text-red-800;
    }
}
</style>
