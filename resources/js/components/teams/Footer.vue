<template>
    <footer class="mt-12 bg-gray-100 py-4 text-center">
        <h5 class="text-lg font-semibold">{{ team.name }} - {{ team.members.length }} Member Team</h5>
    </footer>
</template>

<script setup lang="ts">
import { useTeamStore } from '@/stores/TeamStore';

const team = useTeamStore();
/* import { Team } from '../types';

const props = defineProps<{
    team: Team;
}>();

const { team } = props; */
</script>
