<script lang="ts" setup>
import { ref } from 'vue';

const newTask = ref('');
const error = ref('');

const emit = defineEmits<{
    addTask: [newTask: string];
}>();

function handleSubmit() {
    if (!newTask.value.trim()) {
        error.value = 'Task cannot be empty';
    } else {
        emit('addTask', newTask.value.trim());
        newTask.value = '';
    }
}
</script>
<template>
    <form v-on:submit.prevent="handleSubmit" class="space-y-4">
        <label for="nt" class="flex flex-col gap-2">
            New task
            <input
                v-model="newTask"
                id="nt"
                type="text"
                :aria-invalid="!!error || undefined"
                class="rounded border border-zinc-600 p-2"
                name="new Task"
                v-on:input="error = ''"
            />
            <span class="text-red-500" v-if="error">{{ error }}</span>
        </label>

        <div>
            <button class="btn">Add taskita</button>
        </div>
    </form>
</template>

<style>
@reference "tailwindcss/theme.css";

[aria-invalid='true'] {
    @apply border-red-500;
}
</style>
