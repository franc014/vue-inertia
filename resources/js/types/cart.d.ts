export interface Cart {
    id: string;
    items: CartItem[];
}

export interface CartItem {
    id: string;
    title: string;
    price: number;
    quantity: number;
}
