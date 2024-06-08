<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductType;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productTypes = ProductType::all();

        $response = [
            'success'   => true,
            'message'   => 'Successfully getting list of Product Types',
            'data'      => $productTypes
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
                'name' => ['required', 'unique:product_types', 'string', 'alpha'],
                'desc' => ['string', 'nullable']
            ]);

            $productType = ProductType::create($validated);

            $response = [
                'success'   => true,
                'message'   => 'Successfully create a new Product Type',
                'data'      => $productType
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
            $productType = ProductType::findOrFail($id);

            $response = [
                'success'   => true,
                'message'   => 'Successfully getting details of Product Type',
                'data'      => $productType
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
            $productType = ProductType::findOrFail($id);

            $validated = $request->validate([
                'name' => ['required', 'string', 'alpha'],
                'desc' => ['string', 'nullable']
            ]);

            $productType->update($validated);

            $response = [
                'success'   => true,
                'message'   => 'Successfully update a new Product Type',
                'data'      => $productType
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
            $productType = ProductType::findOrFail($id);

            $productType->delete();

            $response = [
                'success'   => true,
                'message'   => 'Successfully delete the Product Type',
                'data'      => $productType
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
