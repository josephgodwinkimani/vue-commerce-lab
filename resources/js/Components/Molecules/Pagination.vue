<script setup lang="ts">
import { Link } from '@inertiajs/vue3'

// Define component props.
const { paginationData } = defineProps({
    paginationData: {
        type: Object,
        required: true
    }
})
</script>

<template>
    <div class="pagination">
        <Link
            v-if="paginationData.prev_page_url"
            :href="paginationData.prev_page_url"
        >
            <font-awesome-icon :icon="['fas', 'fa-angle-left']" />
        </Link>
        <span class="text-base">
            Page {{ paginationData.current_page }} of
            {{ paginationData.last_page }}
        </span>
        <Link
            v-if="paginationData.next_page_url"
            :href="paginationData.next_page_url"
        >
            <font-awesome-icon :icon="['fas', 'fa-angle-right']" />
        </Link>
    </div>
</template>

<style scoped>
.pagination {
    @apply mt-4 flex items-center justify-center gap-4 text-2xl dark:text-white;
}
</style>
