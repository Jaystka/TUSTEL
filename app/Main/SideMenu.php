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
