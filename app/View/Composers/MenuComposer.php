<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\Repositories\ProductRepository;
use Cart as Cart;

class MenuComposer
{
    protected ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function compose(View $view)
    {
        $view->with([
            'total' => Cart::getTotal(),
            'content' => Cart::getContent(),
            'cartCount'  => Cart::getTotalQuantity(),
            'cartTotal'  => Cart::getTotal(),
            'categories' => $this->productRepository->getCategorie(),
        ]);
    }
}
