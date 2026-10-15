<?php

namespace App\Http\Controllers;

use App\Models\events;
use App\Models\Orders;
use App\Models\Order_details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Events = Events::latest()->get();
        return view('customer.index', compact('Events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'items.*' => 'nullable|integer|min:0'
      
          ]);

        $orderedItems = array_filter(

            $request->items, 

            fn ($quantity) => $quantity > 0
            );

        if (empty($orderedItems)) {
            return redirect()->back()->withErrors(['error' => 'Please select at least one concert ticket to buy.']);
        }

        DB::beginTransaction();

        try {
            $orders = Orders::create([
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'total_price' => 0, 
                'status' => 'pending',
            ]);

            $totalPrice = 0;

            foreach ($orderedItems as $eventId => $quantity) {
                $event = Events::findOrFail($eventId);
                $subtotal = $event->ticket_price * $quantity;
                $totalPrice += $subtotal;
                Order_details::create([
                    'order_id' => $orders->id,
                    'event_id' => $eventId,
                    'quantity' => $quantity,
                    'subtotal' => $subtotal,
                ]);

            }

            $orders->update(['total_price' => $totalPrice]);

            DB::commit();

            Return redirect()->route('customer.index')->with('success', 'Order created successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

        return redirect()->route('customer.index')->with('success', 'Order created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function adminDashboard()
    {
        $orders = Orders::with('orderDetails.event')->latest()->get();
        return view('dashboard', compact('orders'));


    }

    /**
     * Update the specified resource in storage.
     */
    
public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:pending,confirmed,cancelled',
    ]);

    $order = Orders::findOrFail($id);
    $order->status = $request->status;
    $order->save();

    return back()->with('success', 'Status pesanan berhasil diperbarui.');
}

}