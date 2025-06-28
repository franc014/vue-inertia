<script setup lang="ts">
defineProps({
    name: String,
    email: String,
    status: String,
});
</script>
<template>
    <tr class="bg-gray-100 px-12">
        <td class="flex items-center gap-x-4 px-6 py-4 text-xl font-medium">
            <img :src="`https://i.pravatar.cc/50?u=${email}`" alt="" class="rounded-xl" />
            {{ name }}
        </td>

        <td class="px-6 py-4 text-gray-500">{{ email }}</td>

        <td class="px-6 py-4">
            <button class="text-xl text-green-400">{{ status }}</button>
        </td>
    </tr>
</template>
