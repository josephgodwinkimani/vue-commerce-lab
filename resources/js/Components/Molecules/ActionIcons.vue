<script setup lang="ts">
import { Link, useForm } from '@inertiajs/vue3'

const { entityId, viewRoute, editRoute, deleteRoute } = defineProps({
    entityId: {
        type: [Number, String],
        required: true
    },
    viewRoute: {
        type: String,
        required: true
    },
    editRoute: {
        type: String,
        required: false,
        default: null
    },
    deleteRoute: {
        type: String,
        required: true
    }
})

const form = useForm({ entityId })

function destroy(id: number | string, deleteRoute: string) {
    if (confirm('Are you sure? This action is irreversible!')) {
        form.delete(route(deleteRoute, id))
    }
}
</script>

<template>
    <div class="action-icons">
        <Link
            v-if="editRoute"
            aria-label="Edit"
            class="icon"
            :href="route(editRoute, entityId)"
        >
            <font-awesome-icon :icon="['fas', 'pen-to-square']" />
        </Link>

        <Link aria-label="View" class="icon" :href="route(viewRoute, entityId)">
            <font-awesome-icon :icon="['fas', 'eye']" />
        </Link>

        <button
            aria-label="Delete"
            class="icon delete"
            href="#"
            @click="destroy(entityId, deleteRoute)"
        >
            <font-awesome-icon :icon="['fas', 'trash-can']" />
        </button>
    </div>
</template>

<style scoped>
.action-icons {
    @apply flex gap-3;
}

.icon {
    @apply text-gray-500 hover:text-gray-200;
}

.delete {
    @apply hover:text-red-500;
}
</style>
