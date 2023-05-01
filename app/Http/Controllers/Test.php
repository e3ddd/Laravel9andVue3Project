<?php

namespace App\Http\Controllers;


use App\Http\Enums\MagnitudeEnums\PriceEnum;
use App\Http\Factories\Convert\ConvertValueManager;
use App\Http\StripePaymentClass;
use App\Models\FavoriteProduct;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Repositories\AdminPanel\CategoriesRepository;
use App\Repositories\AdminPanel\OrderRepository;
use App\Repositories\AdminPanel\ProductRepository;
use App\Services\AdminPanel\OrderService;
use App\Services\CommentsService;
use App\Services\ShoppingCartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Stripe\Checkout\Session;
use Stripe\Price;
use Stripe\Stripe;


class Test extends Controller
{

    public function show()
    {
        return view('testForm');
    }

    public function index(Request $request)
    {
        $test = new CategoriesRepository();
        dump($test->searchCategory('b'));

    }
}

