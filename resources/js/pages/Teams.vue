<script setup lang="ts">
import Footer from '@/components/teams/Footer.vue';
import Header from '@/components/teams/Header.vue';
import Layout from '@/layouts/settings/Layout.vue';

import TeamMembers from '@/components/teams/TeamMembers.vue';
import { useTeamStore } from '@/stores/TeamStore';
import { Team } from '@/types';
import { usePage } from '@inertiajs/vue3';

import { useLStorage } from '../composables/useLStorage';

defineOptions({ layout: Layout });

const food = useLStorage('food', 'lamborgini');
const age = useLStorage('age', '18');

const { team } = usePage().props as unknown as { team: Team };
const { cart } = usePage().props as unknown as { cart: any };
const teamStore = useTeamStore();
teamStore.init(team);

console.log(cart);

/* if (teamStore?.members?.length === 0) {
    teamStore.fill(team);
} */

/* import { useTeamStore } from '@/stores/TeamStore';
import { Team } from '@/types';
import { usePage } from '@inertiajs/vue3'; */

/* const { team } = usePage().props as unknown as { team: Team };
const teamStore = useTeamStore(); */
</script>

<template>
    <Header />
    <div class="flex flex-col gap-y-3 place-self-center">
        <TeamMembers />
    </div>
    <Footer />
</template>
