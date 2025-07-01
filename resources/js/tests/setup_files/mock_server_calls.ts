import { afterAll, afterEach, beforeAll } from 'vitest';
import { setupServer } from 'msw/node';
import { http, HttpResponse } from 'msw';


const cart ={
    ui_cart_id: 1,
    items: []
};

export const restHandlers = [
    http.post('http://vue-inertia.test/cart/create', () => {
        return HttpResponse.json(cart);
    }),
];

const server = setupServer(...restHandlers);

// Start server before all tests
beforeAll(() => server.listen({ onUnhandledRequest: 'error' }));

// Close server after all tests
afterAll(() => server.close());

// Reset handlers after each test for test isolation
afterEach(() => server.resetHandlers());
