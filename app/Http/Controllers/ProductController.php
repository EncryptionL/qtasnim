<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::with('ProductType')->get();

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', fn ($row) => view('components.table-action',
                        [
                            'routeView' => route('products.show', $row->id),
                            'routeEdit' => route('products.edit', $row->id),
                            'routeDelete' => route('products.destroy', $row->id)
                        ]))
                    ->rawColumns(['action'])
                    ->make();
        }

        return view('pages.products-index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productsTypes = ProductType::all();

        return view('pages.products-create', compact('productsTypes'));
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
                'product_type_id' => ['required']
            ]);

            Product::create($validated);

            return redirect()->route('products.index')->with('success', true);
        } catch (\Throwable $th) {
            return redirect()->route('products.index')->with('success', false);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $product = Product::with('ProductType')->findOrFail($id);

            return view('pages.products-show', compact('product'));
        } catch (\Throwable $th) {
            return redirect()->route('products.index')->with('success', false);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $product = Product::with('ProductType')->findOrFail($id);
            $productsTypes = ProductType::all();

            return view('pages.products-edit', compact('product', 'productsTypes'));
        } catch (\Throwable $th) {
            return redirect()->route('products.index')->with('success', false);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $productType = Product::findOrFail($id);

            $validated = $request->validate([
                'name' => ['required', 'string'],
                'stock' => ['required', 'integer', 'min:0'],
                'product_type_id' => ['required']
            ]);

            $productType->update($validated);

            return redirect()->route('products.index')->with('success', true);
        } catch (\Throwable $th) {
            return redirect()->route('products.index')->with('success', false);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $productType = Product::findOrFail($id);

            $productType->delete();

            return redirect()->route('products.index')->with('success', true);
        } catch (\Throwable $th) {
            return redirect()->route('products.index')->with('success', false);
        }
    }
}
