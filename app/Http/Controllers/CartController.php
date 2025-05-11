<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Səbət səhifəsini göstərir
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    // Məhsulu səbətə əlavə edir
    public function add(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);
        $quantity = $request->input('quantity', 1);

        // Məhsul səbətdə varsa, miqdarını artır
        if(isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            // Məhsul səbətdə yoxdursa, yeni element kimi əlavə et
            $cart[$product->id] = [
                "name" => $product->name,
                "quantity" => $quantity,
                "price" => $product->price,
                "image_path" => $product->image_path // Əgər məhsul şəkli varsa
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('cart.index')->with('success', __('Product added to cart successfully!')); // Bu tərcümə açarı lang/az.json-a əlavə olunmalıdır
    }

    // Səbətdəki məhsulun miqdarını yeniləyir
    public function update(Request $request, $productId)
    {
        $cart = session()->get('cart', []);
        $quantity = $request->input('quantity');

        if(isset($cart[$productId]) && $quantity > 0) {
            $cart[$productId]['quantity'] = $quantity;
            session()->put('cart', $cart);
            return redirect()->route('cart.index')->with('success', __('Cart updated successfully!')); // Bu tərcümə açarı lang/az.json-a əlavə olunmalıdır
        } elseif (isset($cart[$productId]) && $quantity <= 0) {
            // Miqdar 0 və ya daha az olarsa, məhsulu sil
            unset($cart[$productId]);
            session()->put('cart', $cart);
            return redirect()->route('cart.index')->with('success', __('Product removed from cart!')); // Bu tərcümə açarı lang/az.json-a əlavə olunmalıdır
        }

        return redirect()->route('cart.index')->with('error', __('Unable to update cart!')); // Bu tərcümə açarı lang/az.json-a əlavə olunmalıdır
    }

    // Məhsulu səbətdən silir
    public function remove($productId)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
            return redirect()->route('cart.index')->with('success', __('Product removed from cart!'));
        }

        return redirect()->route('cart.index')->with('error', __('Unable to remove product from cart!')); // Bu tərcümə açarı lang/az.json-a əlavə olunmalıdır
    }
}
