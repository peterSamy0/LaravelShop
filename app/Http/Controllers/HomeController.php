<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Cart;

class HomeController extends Controller
{
    public function index(){
        $products = Product::paginate(6);
        return view('home.home', compact('products'));
    }

    public function redirect(){
        $userType = Auth::user()->usertype;

        if($userType == 1){
            return view('adminPage.admin');
        }else{
            $products = Product::paginate(6);
            return view('home.home', compact('products'));
        }
    }

    public function addToCart(Request $request ,$id){
        $user = Auth::user();
        if($user){
            $cart = new Cart();
            $userID = Auth::user()->id;
            $cart->userID = $userID;
            $cart->productID = $id;
            $cart->quantity = $request->quantity;
            $cart->save();
            return redirect()->back();
        }else{
            return redirect('login');
        }
    }

    public function goToCart(){
        $user = Auth::user();
        if($user){
            $products = Cart::where('userID', $user->id)->get(); 
            return view('home.cart', compact('products'));
        }else{
            return redirect('login');
        }
    }

    public function deleteProductFromCart($id){
        $cart = Cart::findorfail($id);

        $cart->delete();
        return redirect()->back();
    }
}
