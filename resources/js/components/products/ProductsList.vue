<template>
    <p class="mb-4 text-2xl font-bold">Products list</p>
    <article class="grid grid-cols-3 gap-8">
        <Product v-for="product in products" :key="product.id" :product="product" />
    </article>
</template>

<script setup lang="ts">
import Product from './Product.vue';
const props = defineProps<{
    products: any;
}>();

const { products } = props;
</script>

<style scoped></style>
