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

        if(isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                "name" => $product->name,
                "quantity" => $quantity,
                "price" => $product->price,
                "image_path" => $product->image_path
            ];
        }

        session()->put('cart', $cart);

        if ($request->ajax() || $request->wantsJson()) {
            $cartItemsCount = collect(session('cart'))->sum('quantity');
            return response()->json([
                'success' => true,
                'message' => __('Product added to cart successfully!'),
                'cartItemsCount' => $cartItemsCount,
                'cartTotal' => $this->calculateCartTotal() // Yekun məbləği də göndərə bilərik
            ]);
        }

        return redirect()->route('cart.index')->with('success', __('Product added to cart successfully!'));
    }

    // Səbətdəki məhsulun miqdarını yeniləyir
    public function update(Request $request, $productId)
    {
        $cart = session()->get('cart', []);
        $quantity = $request->input('quantity');
        $changed = false;

        if(isset($cart[$productId]) && $quantity > 0) {
            $cart[$productId]['quantity'] = $quantity;
            session()->put('cart', $cart);
            $changed = true;
            $message = __('Cart updated successfully!');
        } elseif (isset($cart[$productId]) && $quantity <= 0) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
            $changed = true;
            $message = __('Product removed from cart!');
        }

        if ($request->ajax() || $request->wantsJson()) {
            if($changed){
                $cartItemsCount = collect(session('cart'))->sum('quantity');
                return response()->json([
                    'success' => true,
                    'message' => $message,
                    'cartItemsCount' => $cartItemsCount,
                    'cartTotal' => $this->calculateCartTotal(),
                    'itemId' => $productId, // Hansı itemin dəyişdiyini bilmək üçün
                    'newQuantity' => $quantity > 0 ? $quantity : 0,
                    'itemSubtotal' => $quantity > 0 ? number_format($cart[$productId]['price'] * $quantity, 2) : 0
                ]);
            } else {
                return response()->json(['success' => false, 'message' => __('Unable to update cart!')]);
            }
        }

        if($changed){
            return redirect()->route('cart.index')->with('success', $message);
        }
        return redirect()->route('cart.index')->with('error', __('Unable to update cart!'));
    }

    // Məhsulu səbətdən silir
    public function remove(Request $request, $productId) // Request $request əlavə edildi
    {
        $cart = session()->get('cart', []);
        $removed = false;

        if(isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
            $removed = true;
        }

        if ($request->ajax() || $request->wantsJson()) {
            if($removed){
                $cartItemsCount = collect(session('cart'))->sum('quantity');
                return response()->json([
                    'success' => true,
                    'message' => __('Product removed from cart!'),
                    'cartItemsCount' => $cartItemsCount,
                    'cartTotal' => $this->calculateCartTotal(),
                    'itemId' => $productId
                ]);
            }
            return response()->json(['success' => false, 'message' => __('Unable to remove product from cart!')]);
        }

        if($removed) {
            return redirect()->route('cart.index')->with('success', __('Product removed from cart!'));
        }
        return redirect()->route('cart.index')->with('error', __('Unable to remove product from cart!'));
    }

    // Səbətin ümumi məbləğini hesablamaq üçün köməkçi metod
    private function calculateCartTotal()
    {
        $total = 0;
        $cart = session()->get('cart', []);
        foreach ($cart as $id => $details) {
            $total += $details['price'] * $details['quantity'];
        }
        return number_format($total, 2);
    }
}
