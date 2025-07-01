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
                } catch (e) {
                    // restore cart to DB with LS cart if it has been removed for some reason
                    console.error('Nope, sorry. could not get cart', e.message);
                    console.info('Trying to restore cart in DB with LS cart...');

                    try {
                        const cartDB = await createCartInDB(cart.id);
                        this.id = cartDB.data.ui_cart_id;
                        this.items = cartDB.data.items;

                    } catch (e) {
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

                } catch (e) {
                    console.error('nope, sorry. could not create cart', e.message);
                }

            }

        },
        addItem(item: CartItem) {
            this.items.push(item);
        },
    },
    /* getters: {
        is
    } */


});
