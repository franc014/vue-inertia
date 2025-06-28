<script setup lang="ts">
import { useTeamStore } from '@/stores/TeamStore';
import { Link } from '@inertiajs/vue3';

const team = useTeamStore();

const spotsAvailable = team.spotsAvailable;

//import { computed } from 'vue';
//import { Team } from '../types';

/* const props = defineProps<{
    team: Team;
}>(); */

//const spotsAvaliable = computed(() => props.team.spots - props.team.team_members.length >= 1);
</script>
<template>
    <header class="container mx-auto flex justify-between py-10">
        <div>
            <button class="rounded bg-green-500 px-4 py-2 text-white hover:bg-green-600 disabled:bg-gray-400" :disabled="spotsAvailable === 0">
                Add Member ({{ spotsAvailable }} Spots Left)
            </button>
        </div>
        <div>
            <div class="relative inline-flex items-center text-3xl">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15.182 15.182a4.5 4.5 0 0 1-6.364 0M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Z"
                    />
                </svg>

                <h3>{{ team.name }}</h3>

                <Link href="/food" class="bg-indigo-500 px-4 py-2 text-white">Foodd</Link>

                <div class="absolute -top-2 -right-4 flex h-5 w-5 items-center justify-center rounded-full bg-green-600 text-xs text-white">
                    {{ team.members.length }}
                </div>
            </div>
        </div>
    </header>
</template>

<style scoped></style>
