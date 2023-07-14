<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use ERPs\SAPInterfaces\Client\Infrastructure\IClient;
use ERPs\SAPInterfaces\Client\Infrastructure\Facades\Client;
use ERPs\SAPInterfaces\Orders\Infrastructure\IOrder;
use ERPs\SAPInterfaces\Orders\Infrastructure\Facades\Order;
use ERPs\SAPInterfaces\Stock\Infrastructure\IStock;
use ERPs\SAPInterfaces\Stock\Infrastructure\Facades\Stock;
use ERPs\SAPInterfaces\Delivery\Infrastructure\IDelivery;
use ERPs\SAPInterfaces\Delivery\Infrastructure\Facades\Delivery;

class SAPServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IClient::class, Client::class);
        $this->app->bind(IOrder::class, Order::class);
        $this->app->bind(IStock::class, Stock::class);
        $this->app->bind(IDelivery::class, Delivery::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
