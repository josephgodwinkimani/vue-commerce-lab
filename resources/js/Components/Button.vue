<script setup lang="ts">
import { defineProps, defineEmits } from 'vue'

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

const emit = defineEmits(['click'])

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
    @apply text-center text-base font-bold text-white;
}
.button:hover {
    @apply bg-indigo-800;
}
.button[disabled] {
    @apply cursor-not-allowed opacity-50;
}
</style>
