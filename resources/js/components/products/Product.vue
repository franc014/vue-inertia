<template>
    <article class="flex flex-col justify-between space-y-2 rounded bg-slate-50 p-2">
        <p class="font-bold">{{ product.title }}</p>
        <p>{{ product.price }}</p>
        <Button variant="secondary">Add</Button>
    </article>
</template>

<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';

const props = defineProps<{
    product: any;
}>();

const { product } = props;
</script>

<style scoped></style>
