import { defineStore } from "pinia";
import { Cart, CartItem } from "../types/cart";

export const useCartStore = defineStore('cart', {
    state: () => ({
        id: '' ,
        items: [] as CartItem[],
        total: 0,
    }),
    actions: {
        init(id: string) {
            this.id = id;
        },
        update(cart: Cart) {
            this.id = cart.id;
            this.items = cart.items;
            this.total = cart.total;
        },
    },

});
