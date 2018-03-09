<?php

namespace App\Http\Controllers;

use App\User;
use App\Recommend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;


use App\Http\Requests;
use Auth;
use Session;

class UserController extends Controller
{
    public function getSignup() {
        return view('user.signup');
    }

    public function postSignup(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'email|required|unique:users',
            'password' => 'required|min:8'
        ]);


        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password'))

        ]);
        $user->save();

        Auth::login($user);

        if (Session::has('oldUrl')) {
            $oldUrl = Session::get('oldUrl');
            Session::forget('oldUrl');
            return redirect()->to($oldUrl);
        }

        return redirect()->route('user.profile');
    }

    public function getSignin() {
        Session::put('oldUrl', URL::previous());
        return view('user.signin');
    }

    public function postSignin(Request $request) {
        $this->validate($request, [
            'email' => 'email|required',
            'password' => 'required|min:8'
        ]);

       if (Auth::attempt(['email' => $request->input('email'), 'password'=>
        $request->input('password')])) {
           if (Session::has('oldUrl')) {
               $oldUrl = Session::get('oldUrl');
               Session::forget('oldUrl');
               return redirect()->to($oldUrl);
           }
           return redirect()->route('user.profile');
       }
       return redirect()->back();
    }

    public function getProfile() {
        $userid = Auth::user()->id;
        $recommends = Recommend::where('recommends.unique', "=", $userid)->get();
        $orders = Auth::user()->orders;
        $orders->transform(function($order, $key) {
            $order->cart = unserialize($order->cart);
            return $order;
        });
        return view('user.profile', ['orders' => $orders], ['recommends' => $recommends]);

    }

    public function getLogout(){
        Auth::logout();
        return redirect()->route('user.signin');
    }

    public function getRecommend() {
        return view('user.recommend');
    }

    public function postRecommend(Request $request) {
        $this->validate($request, [
            'product_name' => 'required',
            'full_name' => 'required',
            'description' => 'required',
            'image_path' => 'required',
            'prices' => 'required',
            'type' => 'required'

        ]);

        $recommend = new Recommend([
            'product_name' => $request->input('product_name'),
            'full_name' => $request->input('full_name'),
            'description' => $request->input('description'),
            'image_path' => $request->input('image_path'),
            'prices' => $request->input('prices'),
            'unique' => Auth::user()->id,
            'type' => $request->input('type')
        ]);
        $recommend->save();

        Auth::check($recommend);

        if (Session::has('oldUrl')) {
            $oldUrl = Session::get('oldUrl');
            Session::forget('oldUrl');
            return redirect()->to($oldUrl);
        }



        return redirect()->route('user.profile');
        }

}
