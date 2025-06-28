import { useCartStore } from "@/stores/cartStore";

export function initializeCart() {

    const cartLS = localStorage.getItem('cart');
    const cartPinia = useCartStore();

    if (cartLS) {
        const cart = JSON.parse(cartLS);

        //fetch cart from db, compare id with ls cart id for further security
        //for the moment just use the one in localstorage
        cartPinia.update(cart);
        console.log('loaded from localstorage');

    } else {

        cartPinia.init('a_new_cart_id');
        localStorage.setItem('cart', JSON.stringify(cartPinia));
        console.log('first load to localstorage');

        //set cart in bkedn db, with ziggi and axios, test with inertiarouter also


    }


}
