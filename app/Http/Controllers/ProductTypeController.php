<?php

namespace App\Http\Controllers;

use App\Models\ProductType;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ProductType::all();

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', fn ($row) => view('components.table-action',
                        [
                            'routeView' => route('products.types.show', $row->id),
                            'routeEdit' => route('products.types.edit', $row->id),
                            'routeDelete' => route('products.types.destroy', $row->id)
                        ]))
                    ->rawColumns(['action'])
                    ->make();
        }

        return view('pages.products-types-index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.products-types-create');
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

            ProductType::create($validated);

            return redirect()->route('products.types.index')->with('success', true);
        } catch (\Throwable $th) {
            return redirect()->route('products.types.index')->with('success', false);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $productType = ProductType::findOrFail($id);

            return view('pages.products-types-show', compact('productType'));
        } catch (\Throwable $th) {
            return redirect()->route('products.types.index')->with('success', false);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $productType = ProductType::findOrFail($id);

            return view('pages.products-types-edit', compact('productType'));
        } catch (\Throwable $th) {
            return redirect()->route('products.types.index')->with('success', false);
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

            return redirect()->route('products.types.index')->with('success', true);
        } catch (\Throwable $th) {
            return redirect()->route('products.types.index')->with('success', false);
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

            return redirect()->route('products.types.index')->with('success', true);
        } catch (\Throwable $th) {
            return redirect()->route('products.types.index')->with('success', false);
        }
    }
}
