export interface Task {
    id: string;
    title: string;
    completed: boolean;
}

export interface Team {
    id: number;
    name: string;
    spots: number;
    team_members: TeamMember[];
}

export interface TeamMember {
    id: number;
    name: string;
    email: string;
    status: string;
}

export type TaskFilter = 'all' | 'uncompleted' | 'completed';
