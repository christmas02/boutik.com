<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\View\Composers\MenuComposer;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Associe MenuComposer à la vue menu_principal
        // Ici, tu listes toutes les vues qui doivent recevoir ces variables
        View::composer([
            'layouts.simple.menu_principal',
            'layouts.simple.mobile_menu',
            'layouts.simple.header',
            'layouts.simple.footer',
            'layouts.simple.cart_sidebar',
            // Tailwind layout
            'layouts.tailwind.header',
            'layouts.tailwind.footer',
            'layouts.tailwind.cart_sidebar',
        ], MenuComposer::class);
    }

    public function register(): void
    {
        //
    }
}
