<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentMethod;

class PaymentMethodController extends Controller
{
    //
    public function index()
    {
        // Get all the payment methods and pass them to the view
        $paymentMethods = PaymentMethod::all();
        return view('dashboard.paymentmethod.index', compact('paymentMethods'));
    }
    public function create(){
        return view('dashboard.paymentmethod.create'); 
    }

    public function edit($id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);
        return view('dashboard.paymentmethod.edit', compact('paymentMethod'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'methodname' => 'required|string|max:255',
            'description' => 'nullable|string',
            'exchange_rate' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'account_holder_name' => 'nullable|string|max:255',
            'account_number' => 'nullable|string|max:255',
        ]);

        $paymentMethod = PaymentMethod::findOrFail($id);

        $imageName = $paymentMethod->image;
        if ($request->hasFile('image')) {
            $imageName = $request->image->getClientOriginalName();
            $request->image->move(public_path('img'), $imageName);
        }

        $paymentMethod->update([
            'title' => $request->methodname,
            'details' => $request->description,
            'slug' => strtolower(str_replace(' ', '-', $request->methodname)),
            'exchange_rate' => $request->exchange_rate,
            'image' => $imageName,
            'account_holder_name' => $request->account_holder_name,
            'account_number' => $request->account_number,
        ]);

        return redirect()->route('paymentmethod.index')->with('success', 'Payment method updated successfully');
    }

    public function store(Request $request)
    {
        $request->validate([
            'methodname' => 'required|string|max:255',
            'description' => 'nullable|string',
            'exchange_rate' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'account_holder_name' => 'nullable|string|max:255',
            'account_number' => 'nullable|string|max:255',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = $request->image->getClientOriginalName();
            $request->image->move(public_path('img'), $imageName);
        }

        PaymentMethod::create([
            'title' => $request->methodname,
            'details' => $request->description,
            'slug' => strtolower(str_replace(' ', '-', $request->methodname)),
            'exchange_rate' => $request->exchange_rate,
            'image' => $imageName,
            'account_holder_name' => $request->account_holder_name,
            'account_number' => $request->account_number,
        ]);

        return redirect()->route('paymentmethod.index')->with('success', 'Payment method added successfully.');
    }

    public function destroy($id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);
        
        // Authorization check
        $this->authorize('delete payment methods', $paymentMethod);
        
        try {
            $paymentMethod->delete();
            return redirect()->route('paymentmethod.index')->with('success', 'Payment method deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('paymentmethod.index')->with('error', 'Failed to delete payment method.');
        }
    }

}
