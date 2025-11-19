<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display all products (shop homepage)
     */
    public function index()
    {
        $products = Product::where('available', true)->get();
        return view('shop.index', compact('products'));
    }

    /**
     * Display a single product
     */
    public function show(Product $product)
    {
        if (!$product->available) {
            abort(404);
        }
        
        return view('shop.show', compact('product'));
    }

    /**
     * Add product to cart (PROTECTED - requires auth)
     */
    public function addToCart(Request $request, $productId)
    {
        // Double check authentication (route should already be protected)
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login to add items to cart.');
        }

        $product = Product::findOrFail($productId);
        
        $cart = session()->get('cart', []);
        
        // If product already in cart, increase quantity
        if(isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            // Add new product to cart
            $cart[$product->id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }
        
        session()->put('cart', $cart);
        
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    /**
     * View cart (public but shows different content for guests)
     */
    public function cart()
    {
        $cart = session()->get('cart', []);
        return view('shop.cart', compact('cart'));
    }

    /**
     * Remove product from cart (PROTECTED - requires auth)
     */
    public function removeFromCart(Request $request, $id)
    {
        // Double check authentication
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login to manage your cart.');
        }

        $cart = session()->get('cart', []);
        
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        
        return redirect()->back()->with('success', 'Product removed from cart successfully!');
    }

    /**
     * Update cart quantity (PROTECTED - requires auth)
     */
    public function updateCart(Request $request, $id)
    {
        // Double check authentication
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login to manage your cart.');
        }

        $cart = session()->get('cart', []);
        
        if(isset($cart[$id]) && $request->quantity > 0) {
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }
        
        return redirect()->back()->with('success', 'Cart updated successfully!');
    }
}