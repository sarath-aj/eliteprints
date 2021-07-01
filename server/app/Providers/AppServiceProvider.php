<?php

namespace App\Providers;

use App\Models\Cart;
use Illuminate\Support\ServiceProvider;
use App\Cart\Payments\PaymentGateway;
use App\Cart\Payments\Gateways\StripePaymentGateway;
use Stripe\Stripe;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // if ($this->app->environment() !== 'production') {
        //     $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        // }


        $this->app->singleton(Cart::class, function ($app) {
            $user = $app->auth->user();

            if ($user) {
                $user->load(['cart.stock']);
            }

            return new Cart($user);
        });

        $this->app->singleton(PaymentGateway::class, function () {
            return new StripePaymentGateway();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }
}