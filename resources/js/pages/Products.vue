<script setup lang="ts">
import ProductsList from '@/components/products/ProductsList.vue';
import Layout from '@/layouts/settings/Layout.vue';
import { useCartStore } from '@/stores/cartStore';
import { Link, usePage } from '@inertiajs/vue3';

defineOptions({ layout: Layout });

const props = usePage().props as unknown as { product: any };

const { products } = props;

console.log(useCartStore());
</script>

<template>
    <header class="flex gap-2">
        <Link href="/" class="btn btn-primary">Home</Link>
        <Link href="/products" class="btn btn-primary">Products</Link>
        <Link href="/food" class="btn btn-primary">Food</Link>
    </header>
    <div class="bg-fuchsia-100 p-10">
        <ProductsList :products="products" />
    </div>
</template>
