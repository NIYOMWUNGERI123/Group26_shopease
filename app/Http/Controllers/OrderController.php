<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (auth()->user()->isSeller()) {
            $orders = Order::whereHas('product', function ($query) {
                $query->where('seller_id', auth()->id());
            })->get();
        } else {
            $orders = auth()->user()->orders;
        }
        return view('orders.index', compact('orders'));
    }

    public function create(Product $product)
    {
        $this->middleware('role:buyer');
        return view('orders.create', compact('product'));
    }

    public function store(Request $request, Product $product)
    {
        $this->middleware('role:buyer');
        
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $product->stock,
        ]);

        $totalPrice = $product->price * $validated['quantity'];
        
        $order = Order::create([
            'buyer_id' => auth()->id(),
            'product_id' => $product->id,
            'quantity' => $validated['quantity'],
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        $product->decrement('stock', $validated['quantity']);

        return redirect()->route('orders.show', $order)->with('success', 'Order placed successfully.');
    }

    public function show(Order $order)
    {
        if (auth()->user()->isSeller() && $order->product->seller_id !== auth()->id()) {
            abort(403);
        }
        if (auth()->user()->isBuyer() && $order->buyer_id !== auth()->id()) {
            abort(403);
        }
        return view('orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $this->middleware('role:seller');
        if ($order->product->seller_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled',
        ]);

        $order->update($validated);

        return redirect()->route('orders.show', $order)->with('success', 'Order status updated successfully.');
    }
} 