<script setup lang="ts">
import ProductsList from '@/components/products/ProductsList.vue';
import Layout from '@/layouts/settings/Layout.vue';
import { usePage } from '@inertiajs/vue3';

defineOptions({ layout: Layout });

const props = usePage().props as unknown as { product: any };

console.log(props);

const { products } = props;
</script>

<template>
    <div class="bg-fuchsia-100 p-10">
        <ProductsList :products="products" />
    </div>
</template>
