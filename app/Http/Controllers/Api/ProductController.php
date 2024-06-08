<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('ProductType')->get();

        $response = [
            'success'   => true,
            'message'   => 'Successfully getting list of Product Types',
            'data'      => $products
        ];

        return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => ['required', 'string'],
                'stock' => ['required', 'integer', 'min:0'],
                'product_type_id' => ['required', 'integer']
            ]);

            $product = Product::create($validated);

            $response = [
                'success'   => true,
                'message'   => 'Successfully create a new Product',
                'data'      => $product
            ];

            return response()->json($response, 201);
        } catch (\Throwable $th) {
            $response = [
                'success'   => false,
                'message'   => $th->getMessage(),
                'data'      => null
            ];

            return response()->json($response, 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $product = Product::with('ProductType')->findOrFail($id);

            $response = [
                'success'   => true,
                'message'   => 'Successfully getting details of Product',
                'data'      => $product
            ];

            return response()->json($response);
        } catch (\Throwable $th) {
            $response = [
                'success'   => false,
                'message'   => $th->getMessage(),
                'data'      => null
            ];

            return response()->json($response, 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $product = Product::with('ProductType')->findOrFail($id);

            $validated = $request->validate([
                'name' => ['required', 'string'],
                'stock' => ['required', 'integer', 'min:0'],
                'product_type_id' => ['required', 'integer']
            ]);

            $product->update($validated);

            $response = [
                'success'   => true,
                'message'   => 'Successfully update a new Product',
                'data'      => $product
            ];

            return response()->json($response, 200);
        } catch (\Throwable $th) {
            $response = [
                'success'   => false,
                'message'   => $th->getMessage(),
                'data'      => null
            ];

            return response()->json($response, 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $product = Product::findOrFail($id);

            $product->delete();

            $response = [
                'success'   => true,
                'message'   => 'Successfully delete the Product',
                'data'      => $product
            ];

            return response()->json($response);
        } catch (\Throwable $th) {
            $response = [
                'success'   => false,
                'message'   => $th->getMessage(),
                'data'      => null
            ];

            return response()->json($response, 400);
        }
    }
}
