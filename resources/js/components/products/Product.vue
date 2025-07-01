<template>
    <article class="flex flex-col justify-between space-y-2 rounded bg-slate-50 p-2">
        <p class="font-bold">{{ product.title }}</p>
        <p>{{ product.price }}</p>
        <Button variant="secondary" @click="addItemToCart">Add</Button>
    </article>
</template>

<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import { useCartStore } from '@/stores/cartStore';

const props = defineProps<{
    product: any;
}>();

const { product } = props;

async function addItemToCart() {
    const cart = useCartStore();
    await cart.addItem({
        title: product.title,
        description: 'Product 1 description',
        product_id: product.id,
        slug: 'product-1',
        price: product.price,
        taxes: [{ name: 'VAT', value: 0.15 }],
        quantity: 1,
    });
}
</script>

<style scoped></style>
