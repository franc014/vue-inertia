export interface Cart {
    id: string;
    items: CartItem[];
    total: number;
}

export interface CartItem {
    id: string;
    title: string;
    price: number;
    quantity: number;
}
