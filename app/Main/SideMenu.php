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
        return [
            'dashboard' => [
                'icon' => 'home',
                'title' => 'Dashboard',
                'sub_menu' => [
                    'dashboard-overview-1' => [
                        'icon' => '',
                        'route_name' => 'dashboard-overview-1',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                        'title' => 'Overview 1'
                    ],
                    'dashboard-overview-2' => [
                        'icon' => '',
                        'route_name' => 'dashboard-overview-2',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                        'title' => 'Overview 2'
                    ],
                    'dashboard-overview-3' => [
                        'icon' => '',
                        'route_name' => 'dashboard-overview-3',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                        'title' => 'Overview 3'
                    ]
                ]
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
                'icon' => 'user',
                'route_name' => 'customer.index',
                'params' => [
                    'layout' => 'side-menu'
                ],
                'title' => 'Customer'
            ],
        ];
    }
}
