<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class ProductController extends Controller
{
    public function index()
    {
        // Fetch all products
        $products = Product::where('business_id', Auth::user()->id)->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        // Return create product form
        return view('products.create');
    }

    public function store(Request $request)
    {
        // Validate and save product
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);
        $validated['business_id'] = Auth::user()->id;

        Product::create($validated);
        return redirect()->route('owner.products.index')->with('success', 'Product created successfully.');
    }

    public function show($id)
    {
        // Show product details
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function edit($id)
    {
        // Return edit product form
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        // Validate and update product
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

        $product = Product::findOrFail($id);
        $product->update($validated);

        return redirect()->route('owner.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        // Delete the product
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('owner.products.index')->with('success', 'Product deleted successfully.');
    }
    public function list()
    {
        // dd('in the function');
        // Fetch all products
        $products = Product::all();
        return view('products.list', compact('products'));
    }
    public function order_list()
    {
        // dd('in the function');
        // Fetch all products
        $orders = Order::where('buyer_user_id' , Auth::user()->id)->get();
        return view('products.orderlist', compact('orders'));
    }


   
public function buyProduct($id)
{
    $product = Product::findOrFail($id);

    return view('products.buy', compact('product'));
}
public function createOrder(Request $request, $id)
{
    try {
        // Get the product details
        $product = Product::findOrFail($id);

        // Set Stripe API Key
        Stripe::setApiKey(env('STRIPE_SECRET')); // Use from .env for security

        // Create a PaymentIntent
        $paymentIntent = PaymentIntent::create([
            'amount' => intval($product->price * 100), // Convert price to cents
            'currency' => 'usd',
            'payment_method' => $request->payment_method_id,
            'confirmation_method' => 'manual',
            'confirm' => true,
            'return_url' => route('business.products.confirm'), // Add your confirmation route here
        ]);

        // Handle PaymentIntent status
        if ($paymentIntent->status === 'succeeded') {
            // Create an order record
            $order = Order::create([
                'buyer_user_id' => auth()->id(),
                'product_id' => $product->id,
                'status' => 'paid',
            ]);

            return redirect()->route('business.products.success')->with('message', 'Payment successful!');
        } elseif ($paymentIntent->status === 'requires_action') {
            return redirect()->route('business.products.confirm', [
                'payment_intent_id' => $paymentIntent->id
            ]);
        } else {
            return redirect()->route('business.products.cancel')->withErrors('Payment failed. Please try again.');
        }
    } catch (\Exception $e) {
        \Log::error('Stripe Payment Error: ' . $e->getMessage());
        return redirect()->route('business.products.cancel')->withErrors('Payment failed: ' . $e->getMessage());
    }
}

public function confirmPayment(Request $request)
{
    try {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $paymentIntent = PaymentIntent::retrieve($request->payment_intent_id);

        if ($paymentIntent->status === 'succeeded') {
            return redirect()->route('business.products.success')->with('message', 'Payment confirmed!');
        }

        return redirect()->route('business.products.cancel')->withErrors('Payment confirmation failed.');
    } catch (\Exception $e) {
        \Log::error('Stripe Confirmation Error: ' . $e->getMessage());
        return redirect()->route('business.products.cancel')->withErrors('Payment confirmation failed.');
    }
}

public function paymentSuccess(Request $request)
{
   
    // Show success page
    return view('products.success');
}

public function paymentCancel(Request $request)
{
  
    // Show cancel page
    return view('products.cancel');
}
}
