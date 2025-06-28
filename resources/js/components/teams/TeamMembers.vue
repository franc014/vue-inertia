<script setup lang="ts">
import { useTeamStore } from '@/stores/TeamStore';
import TeamMember from './TeamMember.vue';

const team = useTeamStore();
/* import { Team } from '@/types';
import { computed } from 'vue';
import TeamMember from './TeamMember.vue';

const props = defineProps<{
    team: Team;
}>();

const { team } = props;
const availableSpots = computed(() => team.spots - team.team_members.length); */
</script>

<template>
    <table class="table-fixed border-separate border-spacing-2">
        <thead>
            <th class="px-6 py-2 text-left">Name</th>
            <th class="px-6 py-2 text-left">Email</th>
            <th class="px-6 py-2 text-left">Status</th>
        </thead>
        <tbody>
            <TeamMember v-for="member in team.members" :key="member.id" :name="member.name" :email="member.email" :status="member.status" />
        </tbody>
    </table>
    <!--  <p class="text-right text-gray-600 italic" v-if="availableSpots <= 0">There are no remaining team spots. Upgrade to add more.</p> -->
</template>

<style scoped></style>
