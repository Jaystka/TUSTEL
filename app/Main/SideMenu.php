<?php

namespace App\Main;

class SideMenu
{
    /**
     * List of side menu items.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function menu()
    {
        if (auth()->user() != '') {
            if (auth()->user()->role == 0) {
                return [
                    'dashboard' => [
                        'icon' => 'home',
                        'route_name' => 'dashboard',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                        'title' => 'Dashboard'

                    ],
                    'rental' => [
                        'icon' => 'inbox',
                        'route_name' => 'rental.index',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'Rental'
                    ],
                    'payment' => [
                        'icon' => 'credit-card',
                        'route_name' => 'payment.index',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'Pembayaran'
                    ],
                    'retur' => [
                        'icon' => 'calendar',
                        'route_name' => 'retur.index',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'Pengembalian'
                    ],
                    'product' => [
                        'icon' => 'camera',
                        'route_name' => 'product.index',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'Produk'
                    ],
                    'customer' => [
                        'icon' => 'users',
                        'route_name' => 'customer.index',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'Customer'
                    ],
                    'user' => [
                        'icon' => 'user',
                        'route_name' => 'user.index',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'Users'
                    ],
                ];
            } else {
                return [
                    'dashboard' => [
                        'icon' => 'home',
                        'route_name' => 'dashboard',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                        'title' => 'Dashboard'

                    ],
                    'rental' => [
                        'icon' => 'inbox',
                        'route_name' => 'rental.index',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'Rental'
                    ],
                    'payment' => [
                        'icon' => 'credit-card',
                        'route_name' => 'payment.index',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'Pembayaran'
                    ],
                    'retur' => [
                        'icon' => 'calendar',
                        'route_name' => 'retur.index',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'Pengembalian'
                    ],
                    'product' => [
                        'icon' => 'camera',
                        'route_name' => 'product.index',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'Produk'
                    ],
                    'customer' => [
                        'icon' => 'users',
                        'route_name' => 'customer.index',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'Customer'
                    ]
                ];
            }
        } else {
            return [
                'dashboard' => [
                    'icon' => 'home',
                    'route_name' => 'dashboard',
                    'params' => [
                        'layout' => 'side-menu',
                    ],
                    'title' => 'Dashboard'

                ],
            ];
        }
    }
}
