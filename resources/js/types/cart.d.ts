export interface Cart {
    id: string;
    items: CartItem[];
}

export interface CartItem {
    title: string;
    slug: string;
    product_id: number;
    price: number;
    tax: number;
    quantity: number;
    total: number;
    total_with_tax: number;

}
