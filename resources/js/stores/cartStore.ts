import { defineStore } from "pinia";
import { CartItem } from "../types/cart";
import { v4 as uuidv4 } from 'uuid';
import { route } from "ziggy-js";
import axios from "axios";


async function createCartInDB(cartId: string) {

        const cartDB = await axios.post(route('cart.create'), {
            id: cartId,
        });

    return cartDB;
}

async function getCartFromDB(cartId: string) {
    const cartDB = await axios.post(route('cart.show', { id: cartId }));
    return cartDB;
}

export const useCartStore = defineStore('cart', {
    state: () => ({
        id: '' ,
        items: [] as CartItem[],
    }),
    actions: {
        async init() {
            const cartLS = localStorage.getItem('cart');
            if (cartLS) {
                const cart = JSON.parse(cartLS);
                try {
                    const cartDB = await getCartFromDB(cart.id);
                    this.id = cartDB.data.ui_cart_id;
                    this.items = cartDB.data.items;
                } catch (e: any) {
                    // restore cart to DB with LS cart if it has been removed for some reason
                    console.error('Nope, sorry. could not get cart', e.message);
                    console.info('Trying to restore cart in DB with LS cart...');

                    try {
                        const cartDB = await createCartInDB(cart.id);
                        this.id = cartDB.data.ui_cart_id;
                        this.items = cartDB.data.items;

                    } catch (e: any) {
                        console.error('nope, sorry. could not restore the cart', e.message);
                    }
                }

            }else {

                try {
                    const uuid = uuidv4();

                    const cartDB = await createCartInDB(uuid);

                    localStorage.setItem('cart', JSON.stringify({
                        id: cartDB.data.ui_cart_id,
                        items: [],
                    }));

                    this.id = cartDB.data.ui_cart_id;

                } catch (e: any) {
                    console.error('nope, sorry. could not create cart', e.message);
                }

            }

        },
        async addItem(data: object) {



            console.log({data});


            const cartDB = await axios.post(route('cart.items.store', { cart: this.id }), data);

            this.items = cartDB.data.items;

            localStorage.setItem('cart', JSON.stringify({
                id: this.id,
                items: this.items,
            }));

        },

        updateItemQuantity(slug: string, quantity: number) {
            const index = this.items.findIndex(i => i.slug === slug);
            const item = this.items[index];
            this.items[index].quantity = quantity;
            this.items[index].total = item.price * quantity;
            this.items[index].total_with_tax = this.items[index].total * (1 + item.tax);
        },

        removeItem(slug: string) {
            const index = this.items.findIndex(i => i.slug === slug);
            this.items.splice(index, 1);
        },


    },
    /* getters: {
        is
    } */


});
