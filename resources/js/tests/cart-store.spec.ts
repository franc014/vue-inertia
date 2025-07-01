import { useCartStore } from "../stores/cartStore";
import { createPinia, setActivePinia } from "pinia";



describe('Cart store', function () {
    beforeEach(function () {
        setActivePinia(createPinia());
    });

    //sends cart via an api call to create a new cart in the DB
    it('initializes a new cart, and creates a new cart in the DB', async function () {

        const cart = useCartStore();

        cart.init = vi.fn(async function () {
            const response = await fetch('http://vue-inertia.test/cart/create', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' }
            });
            const data = await response.json();
            this.id = data.ui_cart_id;
            this.items = data.items;

        });

        await cart.init();

        expect(cart.id).toBe(1);
        expect(cart.items).toEqual([]);



    });

    //api call to get the cart
    it('initializes a new cart from the DB', function(){
        const cart = useCartStore();

        expect(cart.items.length).toBe(0);
    });


    it('adds a product to the cart', function () {
        const cart = useCartStore();
        expect(cart.items.length).toBe(0);

        cart.addItem({
            title: 'Product 1',
            product_id: 1,
            slug: 'product-1',
            price: 10000,
            tax: 0.15,
            quantity: 2,
            total: 20000,
            total_with_tax: 23000
        });

        expect(cart.items.length).toBe(1);
        expect(cart.items[0].title).toBe('Product 1');
        expect(cart.items[0].product_id).toBe(1);
        expect(cart.items[0].slug).toBe('product-1');
        expect(cart.items[0].price).toBe(10000);
        expect(cart.items[0].quantity).toBe(2);
        expect(cart.items[0].total).toBe(20000);
        expect(cart.items[0].total_with_tax).toBe(23000);

    });

    it('can change a product quantity', function () {
        const cart = useCartStore();

        cart.addItem({
            title: 'Product 1',
            product_id: 1,
            slug: 'product-1',
            price: 10000,
            tax: 0.15,
            quantity: 2,
            total: 20000,
            total_with_tax: 23000
        });

        const item = cart.items[0];

        expect(item.slug).toBe('product-1');

        cart.updateItemQuantity(item.slug, 3);

        expect(cart.items[0].quantity).toBe(3);
        expect(cart.items[0].total).toBe(30000);
        expect(cart.items[0].total_with_tax).toBe(34500);

    });

    it('can remove a product from the cart', function () {
        const cart = useCartStore();

        cart.addItem({
            title: 'Product 1',
            product_id: 1,
            slug: 'product-1',
            price: 10000,
            tax: 0.15,
            quantity: 2,
            total: 20000,
            total_with_tax: 10000 * 2 * 1.15
        });

        cart.addItem({
            title: 'Product 2',
            product_id: 2,
            slug: 'product-2',
            price: 12400,
            tax: 0.15,
            quantity: 4,
            total: 49600,
            total_with_tax: 12400 * 4 * 1.15
        });

        const item1 = cart.items[0];
        const item2 = cart.items[1];

        expect(item1.slug).toBe('product-1');
        expect(item2.slug).toBe('product-2');

        cart.removeItem(item1.slug);

        expect(cart.items.length).toBe(1);
        expect(cart.items[0].slug).toBe('product-2');
    });

    it('if product is already in the cart, quantity and totals are updated', function () {
        const cart = useCartStore();

        cart.addItem({
            title: 'Product 1',
            product_id: 1,
            slug: 'product-1',
            price: 10000,
            tax: 0.15,
            quantity: 2,
            total: 20000,
            total_with_tax: 23000
        });

        expect(cart.items.length).toBe(1);
        expect(cart.items[0].quantity).toBe(2);

        cart.addItem({
            title: 'Product 1',
            product_id: 1,
            slug: 'product-1',
            price: 10000,
            tax: 0.15,
            quantity: 3,
            total: 30000,
            total_with_tax: 34500
        });

        expect(cart.items.length).toBe(1);
        expect(cart.items[0].quantity).toBe(3);
        expect(cart.items[0].total).toBe(30000);
        expect(cart.items[0].total_with_tax).toBe(34500);

    });

    //todo: test server side sync with DB
    //todo: increment and decrement for items already in the cart component
    //todo validation
});
