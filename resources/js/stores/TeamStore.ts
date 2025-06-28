import { defineStore } from 'pinia';


import { route } from 'ziggy-js';


export const useTeamStore = defineStore('team', {
    state: () => ({
        name: '',
        spots: 0,
        members: [],
    }),
    actions: {
        init(team: any | null) {
            const teamLS = localStorage.getItem('team');
            if (teamLS) {
                const teamFromLS = JSON.parse(teamLS);
                console.log('in ls');


                this.name = teamFromLS.name;
                this.spots = teamFromLS.spots;
                this.members = teamFromLS.team_members;
            } else {
                if (team) {
                    this.name = team.name;
                    this.spots = team.spots;
                    this.members = team.team_members;

                    console.log('not in ls');


                    localStorage.setItem('team', JSON.stringify(team));
                }
                localStorage.setItem('team', JSON.stringify({}));

            }
        },

    },
    getters: {
        spotsAvailable: function (state) {
            console.log(state);

            return state.spots  - state.members.length
        },

    },
});
