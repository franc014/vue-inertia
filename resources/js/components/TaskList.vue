<script setup lang="ts">
import { Task } from './types';

const { tasks } = defineProps<{
    tasks: Task[];
}>();

const emits = defineEmits<{
    toggleCompleted: [id: string];
    deleteTask: [id: string];
}>();
</script>

<template>
    <TransitionGroup name="list" tag="div" class="space-y-4">
        <article v-for="task in tasks" :key="task.id" class="space-y-3">
            <div class="flex items-center">
                <div class="flex items-center gap-2">
                    <input type="checkbox" v-on:input="emits('toggleCompleted', task.id)" :checked="task.completed" />
                    <span :class="{ 'line-through': task.completed }">{{ task.title }}</span>
                </div>
                <button class="btn ml-auto" @click="emits('deleteTask', task.id)">Delete</button>
            </div>
        </article>
    </TransitionGroup>
</template>

<style>
.list-enter-active,
.list-leave-active {
    transition: all 0.5s ease-in-out;
}
.list-enter-from,
.list-leave-to {
    opacity: 0;
    transform: translateY(300px);
}
</style>
