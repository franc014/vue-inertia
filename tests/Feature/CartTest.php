<?php

use App\Models\Cart;

it('gets a cart', function () {

    $uiCartId = '123';
    Cart::factory()->create([
        'ui_cart_id' => $uiCartId,
    ]);

    $this->post(route('cart.show', ['id' => $uiCartId]))
        ->assertOk()
        ->assertJson([
            'ui_cart_id' => $uiCartId,
            'items' => []
        ]);

});

it('creates a new item in the cart', function () {

    $cart = Cart::factory()->create(
        [
         'ui_cart_id' => '123'
       ]
    );

    $cartData = [
        'title' => 'Product 1',
        'description' => 'Product 1 description',
        'product_id' => 1,
        'slug' => 'product-1',
        'quantity' => 3,
        'price' => 10000,
        'taxes' => [
            [
                'name' => 'VAT',
                'value' => 0.15
            ],
            [
                'name' => 'PST',
                'value' => 0.05
            ]
        ],
    ];

    //dd($cartData);


    expect($cart->items)->toBeEmpty();

    $this->post(route('cart.items.store', [
        'cart' => $cart->ui_cart_id
    ]), $cartData)
        ->assertOk()
        ->assertJson([
            'ui_cart_id' => $cart->ui_cart_id,
            'items' => [
                [
                    'title' => 'Product 1',
                    'product_id' => 1,
                    'slug' => 'product-1',
                    'quantity' => 3,
                    'price' => 10000,
                    'taxes' => [
                        [
                            'name' => 'VAT',
                            'value' => 0.15
                        ],
                        [
                            'name' => 'PST',
                            'value' => 0.05
                        ]
                    ],
                    'total' => $cartData['price'] * $cartData['quantity'],
                    'total_with_taxes' => $cartData['price'] *
                    $cartData['quantity'] * (1 + $cartData['taxes'][0]['value'] + $cartData['taxes'][1]['value'])
                ]
            ]
        ]);



});
