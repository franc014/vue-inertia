<script lang="ts" setup>
import { TaskFilter } from './types';

const props = defineProps<{
    filter: TaskFilter;
    currentFilter: TaskFilter;
}>();

const emits = defineEmits<{
    setFilter: [filter: TaskFilter];
}>();
</script>
<template>
    <button class="btn" :class="{ current: props.filter === props.currentFilter }" @click="emits('setFilter', props.filter)">
        {{ props.filter }}
    </button>
</template>

<style scoped>
@reference "tailwindcss/theme.css";
.current {
    @apply bg-fuchsia-800;
}
</style>
