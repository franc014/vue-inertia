<script setup lang="ts">
import FilterButton from '@/components/FilterButton.vue';
import TaskForm from '@/components/TaskForm.vue';
import TaskList from '@/components/TaskList.vue';
import { Task, TaskFilter } from '@/components/types';
import Layout from '@/layouts/settings/Layout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

defineOptions({ layout: Layout });

const tasks = ref<Task[]>([]);
const filter = ref<TaskFilter>('all');

const filteredTasks = computed(() => {
    switch (filter.value) {
        case 'all':
            return tasks.value;
        case 'completed':
            return tasks.value.filter((task) => task.completed);

        case 'uncompleted':
            return tasks.value.filter((task) => !task.completed);
        default:
            return tasks.value;
    }
});

//computed

const totalCompleted = computed(() => {
    return tasks.value.reduce((acc, task) => (task.completed ? acc + 1 : acc), 0);
});

function addTask(newTask: string) {
    tasks.value.push({
        id: Math.random().toString(36).substring(2, 9),
        title: newTask,
        completed: false,
    });
}

function toggleCompleted(id: string) {
    const task = tasks.value.find((task) => task.id === id);
    if (task) {
        task.completed = !task.completed;
    }
}

function deleteTask(id: string) {
    console.log(id);
    const index = tasks.value.findIndex((task) => task.id === id);
    if (index !== -1) {
        tasks.value.splice(index, 1);
    }
}

function setFilter(value: TaskFilter) {
    filter.value = value;
}
</script>

<template>
    <Head title="Welcome">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <header class="flex gap-2">
        <Link href="/" class="btn btn-primary">Home</Link>
        <Link href="/products" class="btn btn-primary">Products</Link>
    </header>
    <div class="content flex min-h-screen flex-col space-y-6 bg-[#FDFDFC] p-6 text-[#1b1b18] lg:justify-center lg:p-8 dark:bg-[#0a0a0a]">
        <div class="mx-auto w-1/2 space-y-3 lg:block">
            <TaskForm @add-task="addTask" />
            <h3 class="text-left">There are {{ tasks.length }} tasks.</h3>
            <h3 v-if="!tasks.length">Add a task to get started</h3>
            <h3>{{ totalCompleted }} / {{ tasks.length }} completed</h3>
            <div class="flex gap-2" v-if="tasks.length">
                <FilterButton filter="all" v-on:set-filter="setFilter" :currentFilter="filter" />
                <FilterButton filter="uncompleted" v-on:set-filter="setFilter" :currentFilter="filter" />
                <FilterButton filter="completed" v-on:set-filter="setFilter" :currentFilter="filter" />
            </div>
            <TaskList :tasks="filteredTasks" v-on:toggle-completed="toggleCompleted" v-on:delete-task="deleteTask" />
        </div>
    </div>
</template>

<style scoped>
@reference "tailwindcss/theme.css";
.content {
    @apply bg-fuchsia-50;
}
</style>
