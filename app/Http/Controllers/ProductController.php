<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Order;
use App\Recommend;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Session;
use Auth;
use Stripe\Stripe;
use Stripe\Charge;

class ProductController extends Controller
{
    public function getIndex() {
        $products = Recommend::all();
        return view('shops.index', ['products' => $products]);
    }

    public function getAddToCart(Request $request, $id) {
        $product = Recommend::find($id);
        $oldCart = Session::has('cart')?$request->session()->get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);

        $request->session()->put('cart', $cart);
        return redirect()->route('user.profile');
    }

    public function getReduceByOne(Request $request, $id) {
        $oldCart = Session::has('cart')?$request->session()->get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->reduceByOne($id);

        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        }
        else {
            Session::forget('cart');
        }

        return redirect()->route('products.shoppingCart');

    }

    public function getRemoveItem(Request $request, $id) {
        $oldCart = Session::has('cart')?$request->session()->get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);

        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        }
        else {
            Session::forget('cart');
        }

        return redirect()->route('products.shoppingCart');
    }

    public function getCart() {
        if (!Session::has('cart')) {
            return view('shops.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('shops.shopping-cart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }

    public function getCheckout() {
        if (!Session::has('cart')) {
            return view('shops.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;
        return view('shops.checkout', ['total' => $total]);
    }

    public function postCheckout(Request $request) {
        if (!Session::has('cart')) {
            return redirect()->route('shops.shoppingCart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        Stripe::setApiKey('sk_test_XtxmXV4I2yGUjM4XDSvkhsAB
');
        try {
            $charge = Charge::create(array(
                "amount" => $cart->totalPrice * 100,
                "currency" => "usd",
                "source" => $request->input('stripeToken'),
                "description" => "Test Charge"
            ));
            $order = new Order();
            $order->cart = serialize($cart);
            $order->address = $request->input('address');
            $order->name = $request->input('name');
            $order->payment_id = $charge->id;

            Auth::user()->orders()->save($order);
        }
        catch (\Exception $e) {
            return redirect()->route('checkout')->with('error', $e->getMessage());
        }

        Session::forget('cart');
        return redirect()->route('products.index')->with('success', 'Successfully purchased!');
    }

    public function getBrowse() {
        $browses = Recommend::all();
        return view('shops.browse', ['browses' => $browses]);
    }

    public function getProfiles($name) {
        $profiles = User::where('name', $name)->first();
        $recommends = Recommend::where('recommends.unique', "=", $profiles->id)->get();
        return view('shops.profiles', ['profiles' => $profiles, 'recommends' => $recommends]);
    }

    public function getFood() {
        $f = "food";
        $browses = Recommend::where('recommends.type', "=", $f)->get();
        return view('shops.food', ['f' => $f, 'browses' => $browses]);
    }

    public function getClothes() {
        $c = 'clothes';
        $browses = Recommend::where('recommends.type', "=", $c)->get();
        return view('shops.clothes', ['c' => '$c', 'browses' => $browses]);
    }

    public function getEntertainment() {
        $e = "entertainment";
        $browses = Recommend::where('recommends.type', "=", $e)->get();
        return view('shops.entertainment', ['e' => '$e', 'browses' => $browses]);
    }

    public function getEtc() {
        $et = "etc";
        $browses = Recommend::where('recommends.type', "=", $et)->get();
        return view('shops.etc', ['et' => '$et', 'browses' => $browses]);
    }
}
