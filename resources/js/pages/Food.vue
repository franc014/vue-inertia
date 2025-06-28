<script setup lang="ts">
import { Head } from '@inertiajs/vue3';

import Layout from '@/layouts/settings/Layout.vue';

import { useTeamStore } from '@/stores/TeamStore';
import { useLStorage } from '../composables/useLStorage';

defineOptions({ layout: Layout });
const food = useLStorage('food');

const age = useLStorage('age');

const team = useTeamStore();
//team.init(null);

console.log(team.name);
</script>

<template>
    <Head title="Welcome">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <div
        class="content container mx-auto flex min-h-screen flex-col space-y-6 bg-[#FDFDFC] p-6 text-[#1b1b18] lg:justify-center lg:p-8 dark:bg-[#0a0a0a]"
    >
        <div class="mx-auto w-1/2 space-y-3 lg:block">
            <label for="food" class="flex flex-col gap-2">
                food
                <input type="text" id="food" class="border border-zinc-600 p-2" v-model="food" />
            </label>

            <label for="age" class="flex flex-col gap-2">
                age
                <input type="text" id="age" class="border border-zinc-600 p-2" v-model="age" />
            </label>
        </div>
    </div>
</template>

<style scoped>
@reference "tailwindcss/theme.css";
.content {
    @apply bg-fuchsia-100;
}
</style>
