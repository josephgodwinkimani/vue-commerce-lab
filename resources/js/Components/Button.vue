<script setup lang="ts">
// Define the component props.
const props = defineProps({
    type: {
        type: String as () => 'button' | 'submit' | 'reset',
        default: 'button'
    },
    disabled: {
        type: Boolean,
        default: false
    },
    onClick: {
        type: Function,
        default: () => {}
    }
})

// Define the component emits.
const emit = defineEmits(['click'])

// Handle button click event.
const handleClick = () => {
    emit('click')
    props.onClick()
}
</script>

<template>
    <button
        :type="props.type"
        :disabled="props.disabled"
        class="button"
        @click="handleClick"
    >
        <slot />
    </button>
</template>

<style scoped>
.button {
    @apply rounded-md bg-indigo-600;
    @apply px-4 py-2 transition duration-150 ease-in-out;
    @apply text-center font-bold text-white;

    &:hover {
        @apply bg-indigo-800;
    }

    &:disabled {
        @apply cursor-not-allowed opacity-50;
    }
}
</style>
