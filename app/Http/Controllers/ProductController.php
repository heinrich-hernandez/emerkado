<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Show the form for creating a new product.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Make sure you have a Product model and a corresponding migration
        return view('coop.pages.create-products');
    }

    /**
     * Store a newly created product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // 1. Validate the user input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'available_quantity' => 'required|integer|min:0',
            'user_id' => 'required|exists:coop,id', // Assuming you have a users table
        ]);

        // 2. Create and save the new product to the database
        $product = Product::create($validatedData);

        // 3. Redirect the user back to a relevant page with a success message
        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }
}
